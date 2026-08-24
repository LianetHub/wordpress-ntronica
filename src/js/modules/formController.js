import IMask from 'imask';
import { codeArray } from './codes.js';

export class FormController {
	constructor(el) {
		this.form = el;
		this.selectors = {
			controlWrap: '.form__control-wrap',
			control: '.form__control',
			clearBtn: '.form__clear',
			phoneInput: 'input[type="tel"]',
			fileInput: 'input[type="file"]',
			fileWrap: '.form__file-wrap',
			fileList: '.form__file-list',
			fileRemove: '.form__file-remove'
		};
		this.init();
	}

	init() {
		this.initPhoneMask();
		this.initClearableInputs();
		this.initFileInputs();
		this.initCf7Events();
	}

	initPhoneMask() {
		const phoneInputs = this.form.querySelectorAll(this.selectors.phoneInput);
		if (!phoneInputs.length || typeof IMask === 'undefined') return;

		phoneInputs.forEach(input => {
			IMask(input, {
				mask: codeArray,
				lazy: true,
				dispatch: (appended, dynamicMasked) => {
					const number = (dynamicMasked.value + appended).replace(/\D/g, '');
					return dynamicMasked.compiledMasks.find(m => number.indexOf(m.startsWith) === 0);
				}
			});
		});
	}

	initClearableInputs() {
		this.form.querySelectorAll(this.selectors.control).forEach(input => {
			this.toggleClearBtn(input);
			input.addEventListener('input', () => this.toggleClearBtn(input));
		});

		this.form.addEventListener('click', (e) => {
			const clearBtn = e.target.closest(this.selectors.clearBtn);
			if (!clearBtn) return;
			const wrap = clearBtn.closest(this.selectors.controlWrap);
			if (!wrap) return;
			const input = wrap.querySelector(this.selectors.control);
			if (input) {
				input.value = '';
				input.dispatchEvent(new Event('input', { bubbles: true }));
				input.focus();
				clearBtn.hidden = true;
			}
		});
	}

	toggleClearBtn(input) {
		const wrap = input.closest(this.selectors.controlWrap);
		if (!wrap) return;
		const clearBtn = wrap.querySelector(this.selectors.clearBtn);
		if (clearBtn) {
			clearBtn.hidden = input.value.trim() === '';
		}
	}

	initFileInputs() {
		const fileInputs = this.form.querySelectorAll(this.selectors.fileInput);
		fileInputs.forEach(input => {
			const wrap = input.closest(this.selectors.fileWrap);
			if (!wrap) return;

			input.setAttribute('multiple', 'multiple');

			let listContainer = wrap.querySelector(this.selectors.fileList);
			if (!listContainer) {
				listContainer = document.createElement('div');
				listContainer.className = 'form__file-list';
				wrap.appendChild(listContainer);
			}

			input.addEventListener('change', (e) => {
				const files = Array.from(e.target.files);
				this.renderFiles(files, listContainer, input);
			});

			listContainer.addEventListener('click', (e) => {
				const removeBtn = e.target.closest(this.selectors.fileRemove);
				if (!removeBtn) return;
				e.preventDefault();
				e.stopPropagation();

				const index = parseInt(removeBtn.dataset.index, 10);
				const dt = new DataTransfer();
				const { files } = input;

				for (let i = 0; i < files.length; i++) {
					if (i !== index) {
						dt.items.add(files[i]);
					}
				}

				input.files = dt.files;
				this.renderFiles(Array.from(input.files), listContainer, input);
			});
		});
	}

	renderFiles(files, listContainer, input) {
		listContainer.innerHTML = '';
		const wrap = input.closest(this.selectors.fileWrap);
		const removeLabel = wrap?.dataset.removeLabel || this.form.dataset.removeLabel || '';

		files.forEach((file, index) => {
			const item = document.createElement('div');
			item.className = 'form__file-item';

			item.innerHTML = `
                <span class="form__file-name text-block">${file.name}</span>
                <button type="button" class="form__file-remove" data-index="${index}" aria-label="${removeLabel}">
                    <svg class="form__clear-icon" aria-hidden="true">
                        <use href="#icon-clear"></use>
                    </svg>
                </button>
            `;
			listContainer.appendChild(item);
		});

		if (wrap) {
			wrap.classList.toggle('uploaded', files.length > 0);
		}
	}

	initCf7Events() {
		this.form.addEventListener('wpcf7mailsent', (e) => {
			this.onSuccess(e);
		});
		this.form.addEventListener('wpcf7mailfailed', () => {
			this.onError();
		});
		this.form.addEventListener('wpcf7invalid', () => {
			this.onError();
		});
	}

	onSuccess() {
		this.form.reset();
		this.form.querySelectorAll(this.selectors.fileList).forEach(el => el.innerHTML = '');
		this.form.querySelectorAll(this.selectors.fileWrap).forEach(el => el.classList.remove('uploaded'));
		this.form.querySelectorAll(this.selectors.control).forEach(input => this.toggleClearBtn(input));

		if (typeof Fancybox !== 'undefined') {
			const instance = Fancybox.getInstance();
			if (instance) instance.destroy();

			// Fancybox.show([{
			// 	src: "#success-submitting",
			// 	type: "inline"
			// }]);
		}

		if (typeof ym === 'function') {
			// метрики потом вставить при необходимости
		}
	}

	onError() {
		if (typeof Fancybox !== 'undefined') {
			const instance = Fancybox.getInstance();
			if (instance) instance.destroy();

			// Fancybox.show([{
			// 	src: "#error-submitting",
			// 	type: "inline"
			// }]);
		}
	}
}