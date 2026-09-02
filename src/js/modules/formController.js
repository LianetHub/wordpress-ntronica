import IMask from "imask";
import { codeArray } from "./codes.js";

export class FormController {
	constructor(el) {
		this.form = el;
		this.root = el.querySelector(".form");
		this.success = el.querySelector(".form__success");
		this.againBtn = el.querySelector(".form__again");
		this.submitWrap = el.querySelector(".form__submit");
		this.submitBtn = el.querySelector('input[type="submit"]');
		this.selectors = {
			controlWrap: ".form__control-wrap",
			control: ".form__control",
			clearBtn: ".form__clear",
			phoneInput: 'input[type="tel"]',
			fileInput: 'input[type="file"]',
			fileWrap: ".form__file-wrap",
			fileList: ".form__file-list",
			fileRemove: ".form__file-remove",
			fileLabel: ".form__file-label",
			attachments: ".form__attachments",
		};
		this.phoneMasks = new Map();
		this.pendingSent = false;
		this.snapshot = [];
		this.init();
	}

	init() {
		this.initSubmitLabels();
		this.initPhoneMask();
		this.initClearableInputs();
		this.initFileInputs();
		this.initCf7Events();
		this.initAgainButton();
	}

	initSubmitLabels() {
		if (!this.submitBtn) return;

		const fromWrap = this.submitWrap?.dataset ?? {};
		if (!this.submitBtn.dataset.defaultText) {
			this.submitBtn.dataset.defaultText =
				fromWrap.defaultText || this.submitBtn.value;
		}
		if (!this.submitBtn.dataset.sendingText && fromWrap.sendingText) {
			this.submitBtn.dataset.sendingText = fromWrap.sendingText;
		}
	}

	initPhoneMask() {
		const phoneInputs = this.form.querySelectorAll(
			this.selectors.phoneInput,
		);
		if (!phoneInputs.length || typeof IMask === "undefined") return;

		phoneInputs.forEach((input) => {
			const mask = IMask(input, {
				mask: codeArray,
				lazy: true,
				dispatch: (appended, dynamicMasked) => {
					const number = (dynamicMasked.value + appended).replace(
						/\D/g,
						"",
					);
					return dynamicMasked.compiledMasks.find(
						(m) => number.indexOf(m.startsWith) === 0,
					);
				},
			});
			this.phoneMasks.set(input, mask);
		});
	}

	initClearableInputs() {
		this.form.querySelectorAll(this.selectors.control).forEach((input) => {
			this.toggleClearBtn(input);
			input.addEventListener("input", () => this.toggleClearBtn(input));
		});

		this.form.addEventListener("click", (e) => {
			const clearBtn = e.target.closest(this.selectors.clearBtn);
			if (!clearBtn) return;
			if (
				this.root?.classList.contains("is-sent") ||
				this.root?.classList.contains("is-sending")
			) {
				return;
			}
			const wrap = clearBtn.closest(this.selectors.controlWrap);
			if (!wrap) return;
			const input = wrap.querySelector(this.selectors.control);
			if (input) {
				input.value = "";
				input.dispatchEvent(new Event("input", { bubbles: true }));
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
			clearBtn.hidden = input.value.trim() === "";
		}
	}

	initFileInputs() {
		const fileInputs = this.form.querySelectorAll(this.selectors.fileInput);
		fileInputs.forEach((input) => {
			const wrap = input.closest(this.selectors.fileWrap);
			if (!wrap) return;

			input.setAttribute("multiple", "multiple");

			const listContainer = this.getFileListContainer(wrap);

			input.addEventListener("change", (e) => {
				const files = Array.from(e.target.files);
				this.renderFiles(files, listContainer, input);
			});

			listContainer.addEventListener("click", (e) => {
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

	getFileListContainer(wrap) {
		const attachments =
			this.root?.querySelector(this.selectors.attachments) ||
			this.form.querySelector(this.selectors.attachments);
		const host = attachments || wrap;

		let listContainer = host.querySelector(this.selectors.fileList);
		if (!listContainer) {
			listContainer = document.createElement("div");
			listContainer.className = "form__file-list";
			host.appendChild(listContainer);
		}

		return listContainer;
	}

	renderFiles(files, listContainer, input) {
		listContainer.innerHTML = "";
		const wrap = input.closest(this.selectors.fileWrap);
		const removeLabel =
			wrap?.dataset.removeLabel || this.form.dataset.removeLabel || "";

		files.forEach((file, index) => {
			const item = document.createElement("div");
			item.className = "form__file-item";

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
			wrap.classList.toggle("uploaded", files.length > 0);
			this.updateFileButtonLabel(wrap, files.length > 0);
		}
	}

	updateFileButtonLabel(wrap, hasFiles) {
		const label = wrap.querySelector(this.selectors.fileLabel);
		if (!label) return;

		const addLabel = wrap.dataset.addLabel || "ADD FILE";
		const replaceLabel = wrap.dataset.replaceLabel || "REPLACE FILE";
		label.textContent = hasFiles ? replaceLabel : addLabel;
	}

	initCf7Events() {
		// Immediate lock — before CF7 ajax; fields stay enabled so FormData is complete.
		this.form.addEventListener(
			"submit",
			() => {
				this.startSending();
			},
			true,
		);

		this.form.addEventListener("wpcf7beforesubmit", () => {
			this.startSending();
		});

		this.form.addEventListener("wpcf7mailsent", () => {
			this.onSuccess();
		});
		this.form.addEventListener("wpcf7reset", () => {
			this.onCf7Reset();
		});
		this.form.addEventListener("wpcf7mailfailed", () => {
			this.onError();
		});
		this.form.addEventListener("wpcf7invalid", () => {
			this.onError();
		});
		this.form.addEventListener("wpcf7spam", () => {
			this.onError();
		});
	}

	initAgainButton() {
		if (!this.againBtn) return;
		this.againBtn.addEventListener("click", () => this.resetToIdle());
	}

	startSending() {
		if (
			this.root?.classList.contains("is-sending") ||
			this.root?.classList.contains("is-sent")
		) {
			return;
		}

		this.root?.classList.add("is-sending");
		this.form.setAttribute("aria-busy", "true");

		if (this.submitBtn) {
			const sendingText = this.submitBtn.dataset.sendingText;
			if (sendingText) {
				this.submitBtn.value = sendingText;
			}
		}
	}

	stopSending() {
		this.root?.classList.remove("is-sending");
		this.form.removeAttribute("aria-busy");

		if (this.submitBtn) {
			const defaultText = this.submitBtn.dataset.defaultText;
			if (defaultText) {
				this.submitBtn.value = defaultText;
			}
		}
	}

	collectValues() {
		const values = [];
		this.form.querySelectorAll(this.selectors.control).forEach((input) => {
			const mask = this.phoneMasks.get(input);
			values.push({
				input,
				value: mask ? mask.value : input.value,
			});
		});
		return values;
	}

	restoreValues(values) {
		values.forEach(({ input, value }) => {
			const mask = this.phoneMasks.get(input);
			if (!mask) {
				input.value = value;
				return;
			}

			// IMask ignores updates while the input is disabled / after native reset.
			const wasDisabled = input.disabled;
			input.disabled = false;
			mask.value = value;

			if (!mask.value && value) {
				mask.unmaskedValue = String(value).replace(/\D/g, "");
			}

			if (!input.value && value) {
				input.value = value;
			}

			input.disabled = wasDisabled;
		});
	}

	setDisabled(disabled) {
		const selector = `${this.selectors.control}, ${this.selectors.fileInput}, input[type="checkbox"], input[type="submit"]`;
		this.form.querySelectorAll(selector).forEach((el) => {
			el.disabled = disabled;
		});
	}

	clearFiles() {
		this.form.querySelectorAll(this.selectors.fileList).forEach((el) => {
			el.innerHTML = "";
		});
		this.form.querySelectorAll(this.selectors.fileWrap).forEach((el) => {
			el.classList.remove("uploaded");
			this.updateFileButtonLabel(el, false);
		});
	}

	enterSentUi() {
		this.stopSending();
		this.root?.classList.add("is-sent");
		if (this.success) {
			this.success.hidden = false;
			this.success.focus();
		}
		this.form
			.querySelectorAll(this.selectors.control)
			.forEach((input) => this.toggleClearBtn(input));
		this.clearFiles();
	}

	applySentState() {
		if (!this.pendingSent) return;

		// Enable before restore: IMask will not rewrite a disabled tel input.
		this.setDisabled(false);
		this.restoreValues(this.snapshot);
		this.setDisabled(true);
		this.enterSentUi();
	}

	onSuccess() {
		this.snapshot = this.collectValues();
		this.pendingSent = true;

		// CF7 resets after mailsent; re-apply after both reset and the next frame.
		this.applySentState();
		requestAnimationFrame(() => {
			this.applySentState();
			setTimeout(() => this.applySentState(), 0);
		});

		if (typeof Fancybox !== "undefined") {
			const instance = Fancybox.getInstance();
			if (instance) instance.destroy();
		}

		if (typeof ym === "function") {
			// метрики потом вставить при необходимости
		}
	}

	onCf7Reset() {
		this.applySentState();
	}

	resetToIdle() {
		this.pendingSent = false;
		this.snapshot = [];
		this.setDisabled(false);
		this.stopSending();
		this.root?.classList.remove("is-sent");
		if (this.success) this.success.hidden = true;

		this.form.reset();
		this.phoneMasks.forEach((mask) => {
			mask.value = "";
		});

		this.form.classList.remove("sent", "invalid", "failed", "submitting");
		this.form.classList.add("init");
		this.form.setAttribute("data-status", "init");

		this.clearFiles();
		this.form
			.querySelectorAll(this.selectors.control)
			.forEach((input) => this.toggleClearBtn(input));

		const first = this.form.querySelector(this.selectors.control);
		first?.focus();
	}

	onError() {
		this.stopSending();

		if (typeof Fancybox !== "undefined") {
			const instance = Fancybox.getInstance();
			if (instance) instance.destroy();
		}
	}
}
