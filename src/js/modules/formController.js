import IMask from "imask";
import { codeArray } from "./codes.js";

const fieldMessages = {
	"your-name": "Enter your name",
	email: "Enter a valid e-mail",
	phone: "Enter a valid phone number",
};

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
			textarea: "textarea.form__control",
		};
		this.phoneMasks = new Map();
		this.pendingSent = false;
		this.allowSend = false;
		this.snapshot = [];
		this.textareas = [];
		this.form.__ntronicaForm = this;
		this.init();
	}

	init() {
		this.initSubmitLabels();
		this.initPhoneMask();
		this.initClearableInputs();
		this.initAutoResizeTextareas();
		this.initFileInputs();
		this.initCf7Events();
		this.initAgainButton();
		this.initSubmitGate();
		this.initSubmitValidation();
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

	initSubmitGate() {
		if (!this.submitBtn) return;

		this.syncSubmitState = this.syncSubmitState.bind(this);
		this.form.addEventListener("input", this.syncSubmitState);

		this.form.addEventListener("change", () => {
			this.syncSubmitState();
			queueMicrotask(this.syncSubmitState);
		});
		this.phoneMasks.forEach((mask) => {
			mask.on?.("accept", this.syncSubmitState);
		});
		this.syncSubmitState();
	}

	isControlFilled(el) {
		if (el.type === "checkbox" || el.type === "radio") {
			if (el.type === "radio" && el.name) {
				const group = this.form.querySelectorAll(
					`input[type="radio"][name="${CSS.escape(el.name)}"]`,
				);
				return Array.from(group).some((item) => item.checked);
			}
			return el.checked;
		}

		if (el.type === "file") {
			return el.files?.length > 0;
		}

		const mask = this.phoneMasks.get(el);
		const value = mask ? mask.unmaskedValue : el.value;
		return String(value ?? "").trim() !== "";
	}

	syncSubmitState() {
		if (!this.submitBtn) return;
		if (
			this.root?.classList.contains("is-sending") ||
			this.root?.classList.contains("is-sent")
		) {
			return;
		}

		const required = this.form.querySelectorAll(
			".wpcf7-validates-as-required, [aria-required='true']",
		);
		const requiredOk = Array.from(required).every((el) =>
			this.isControlFilled(el),
		);
		const acceptances = this.form.querySelectorAll(
			"input.wpcf7-acceptance:not(.optional), .wpcf7-acceptance:not(.optional) input[type='checkbox']",
		);
		const acceptanceOk = Array.from(acceptances).every((el) => el.checked);

		this.submitBtn.disabled = !(requiredOk && acceptanceOk);
	}

	initSubmitValidation() {
		this.form.addEventListener(
			"focusout",
			(event) => this.blockLiveValidation(event),
			true,
		);
		this.form.addEventListener(
			"change",
			(event) => this.blockLiveValidation(event),
			true,
		);
		this.form.addEventListener("input", (event) => {
			if (!this.isFormatField(event.target)) return;
			this.clearValidationTips();
		});
	}

	isFormatField(target) {
		const field =
			target instanceof Element
				? target.closest("input, textarea")
				: null;
		if (!field || !this.form.contains(field)) return false;
		if (field instanceof HTMLTextAreaElement) return true;
		if (!(field instanceof HTMLInputElement)) return false;
		return ["text", "email", "tel", "url", "number"].includes(field.type);
	}

	blockLiveValidation(event) {
		if (!this.isFormatField(event.target)) return;
		event.stopPropagation();
	}

	clearValidationTips() {
		const root = this.form.closest(".wpcf7") || this.form;
		root.querySelectorAll(".wpcf7-not-valid-tip").forEach((tip) => {
			tip.remove();
		});
		root.querySelectorAll(".screen-reader-response ul li").forEach(
			(item) => {
				item.remove();
			},
		);
		this.form.querySelectorAll(".wpcf7-form-control").forEach((el) => {
			el.classList.remove("wpcf7-not-valid");
			if ("true" === el.getAttribute("aria-invalid")) {
				el.setAttribute("aria-invalid", "false");
			}
			el.removeAttribute("aria-describedby");
			if (typeof el.setCustomValidity === "function") {
				el.setCustomValidity("");
			}
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

	initAutoResizeTextareas() {
		this.textareas = Array.from(
			this.form.querySelectorAll(this.selectors.textarea),
		);
		if (!this.textareas.length) return;

		this.resizeTextareas = this.resizeTextareas.bind(this);

		this.textareas.forEach((textarea) => {
			textarea.addEventListener("input", () =>
				this.resizeTextarea(textarea),
			);
		});

		window.addEventListener("resize", this.resizeTextareas);
	}

	textareaFloor(textarea) {
		const field = textarea.closest(".form__field");
		if (!field) return 0;

		const fieldMin = parseFloat(getComputedStyle(field).minHeight) || 0;
		const label = field.querySelector(".form__label");
		const labelHeight = label ? label.offsetHeight : 0;
		const styles = getComputedStyle(field);
		const gap = parseFloat(styles.rowGap) || parseFloat(styles.gap) || 0;

		return Math.max(0, fieldMin - labelHeight - gap);
	}

	resizeTextarea(textarea) {
		if (!textarea.value) {
			textarea.style.minHeight = "";
			textarea.style.height = "";
			return;
		}

		const floor = this.textareaFloor(textarea);
		textarea.style.minHeight = "0";
		textarea.style.height = "0";
		const borderHeight = textarea.offsetHeight - textarea.clientHeight;
		const contentHeight = textarea.scrollHeight + borderHeight;
		textarea.style.minHeight = "";

		if (contentHeight <= floor) {
			textarea.style.height = "";
			return;
		}

		textarea.style.height = `${contentHeight}px`;
	}

	resizeTextareas() {
		this.textareas.forEach((textarea) => this.resizeTextarea(textarea));
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
		// Window capture runs before any listener CF7 put on the form,
		// including one registered earlier in the capture phase.
		window.addEventListener(
			"submit",
			(event) => {
				if (event.target !== this.form) return;
				this.onSubmit(event);
			},
			true,
		);

		this.form.addEventListener("wpcf7beforesubmit", () => {
			if (!this.allowSend || this.hasValidationErrors()) return;
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

	onSubmit(event) {
		this.allowSend = false;
		this.guardCf7Submit();

		if (
			this.root?.classList.contains("is-sending") ||
			this.root?.classList.contains("is-sent")
		) {
			event.preventDefault();
			event.stopImmediatePropagation();
			return;
		}

		if (!this.canSubmit()) {
			event.preventDefault();
			event.stopImmediatePropagation();
			return;
		}

		this.allowSend = true;
	}

	canSubmit() {
		this.syncSubmitState();
		if (!this.validateLocally() || this.submitBtn?.disabled) return false;
		if (this.validateWithSchema() && this.hasValidationErrors())
			return false;
		return true;
	}

	guardCf7Submit() {
		if (
			typeof wpcf7 === "undefined" ||
			typeof wpcf7.submit !== "function"
		) {
			return;
		}
		if (wpcf7.submit.__ntronica) return;

		const original = wpcf7.submit.bind(wpcf7);
		const guarded = (form, options) => {
			if (form?.__ntronicaForm && !form.__ntronicaForm.allowSend) return;
			return original(form, options);
		};
		guarded.__ntronica = true;
		wpcf7.submit = guarded;
	}

	validateWithSchema() {
		if (
			typeof wpcf7 === "undefined" ||
			typeof wpcf7.validate !== "function"
		) {
			return false;
		}
		if (typeof swv === "undefined") return false;
		if (!this.form.wpcf7?.schema) return false;

		try {
			wpcf7.validate(this.form);
		} catch {
			return false;
		}

		return true;
	}

	validateLocally() {
		this.clearValidationTips();
		let valid = true;

		this.form
			.querySelectorAll(
				".wpcf7-validates-as-required, [aria-required='true']",
			)
			.forEach((field) => {
				if (this.isControlFilled(field)) return;
				valid = false;
				const message = fieldMessages[field.name];
				if (message) this.showFieldError(field, message);
			});

		this.form
			.querySelectorAll(
				'input[type="email"], input.wpcf7-validates-as-email',
			)
			.forEach((field) => {
				if (!this.isControlFilled(field) || this.isEmail(field.value))
					return;
				valid = false;
				this.showFieldError(
					field,
					fieldMessages[field.name] || fieldMessages.email,
				);
			});

		this.phoneMasks.forEach((mask, field) => {
			const shown = String(mask.value ?? "").trim();
			if (!shown || mask.masked?.isComplete) return;
			valid = false;
			this.showFieldError(field, fieldMessages.phone);
		});

		const acceptances = this.form.querySelectorAll(
			"input.wpcf7-acceptance:not(.optional), .wpcf7-acceptance:not(.optional) input[type='checkbox']",
		);
		if (!Array.from(acceptances).every((field) => field.checked)) {
			valid = false;
		}

		return valid;
	}

	isEmail(value) {
		return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(value ?? "").trim());
	}

	hasValidationErrors() {
		const root = this.form.closest(".wpcf7") || this.form;
		return Boolean(
			root.querySelector(".wpcf7-not-valid, .wpcf7-not-valid-tip"),
		);
	}

	showFieldError(field, message) {
		const wrap =
			field.closest(".wpcf7-form-control-wrap") || field.parentElement;
		if (!wrap) return;

		field.classList.add("wpcf7-not-valid");
		field.setAttribute("aria-invalid", "true");

		const tip = document.createElement("span");
		tip.className = "wpcf7-not-valid-tip";
		tip.setAttribute("aria-hidden", "true");
		tip.textContent = message;
		wrap.appendChild(tip);
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

		this.resizeTextareas();
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
		this.resizeTextareas();

		this.form.classList.remove("sent", "invalid", "failed", "submitting");
		this.form.classList.add("init");
		this.form.setAttribute("data-status", "init");

		this.clearFiles();
		this.form
			.querySelectorAll(this.selectors.control)
			.forEach((input) => this.toggleClearBtn(input));

		const first = this.form.querySelector(this.selectors.control);
		first?.focus();
		this.syncSubmitState();
	}

	onError() {
		this.stopSending();

		if (typeof Fancybox !== "undefined") {
			const instance = Fancybox.getInstance();
			if (instance) instance.destroy();
		}
	}
}
