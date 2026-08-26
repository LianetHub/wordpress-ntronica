/**
 * Search form: page states (arrow / clear) and footer clear button.
 */
export class SearchForm {
	constructor(el) {
		this.form = el;
		this.isPage = el.classList.contains("search-form--page");
		this.input = el.querySelector(".search-form__input");
		this.clear = el.querySelector(".search-form__clear");
		this.submit = this.isPage ? el.querySelector(".search-form__submit") : null;

		if (!this.input || !this.clear) return;

		// Clear (×) only for the pristine query from page load — not after edit/clear.
		this.loadedQuery = this.input.value;
		this.allowClear = this.isPage && this.loadedQuery.length > 0;

		this.input.addEventListener("input", () => this.onInput());
		this.form.addEventListener("focusin", () => this.syncActions());
		this.form.addEventListener("focusout", () => {
			requestAnimationFrame(() => this.syncActions());
		});
		this.clear.addEventListener("click", () => this.onClear());
		this.syncActions();
	}

	onInput() {
		if (this.isPage && this.input.value !== this.loadedQuery) {
			this.allowClear = false;
		}
		this.syncActions();
	}

	syncActions() {
		const hasValue = this.input.value.length > 0;
		const active = document.activeElement;
		const inputFocused = active === this.input;

		if (this.isPage) {
			const submitFocused = active === this.submit;
			const showSubmit = inputFocused || submitFocused;
			const showClear =
				this.allowClear &&
				hasValue &&
				this.input.value === this.loadedQuery &&
				!showSubmit;

			if (this.submit) {
				this.submit.hidden = !showSubmit;
			}
			this.clear.hidden = !showClear;
			return;
		}

		this.clear.hidden = !hasValue;
	}

	onClear() {
		this.input.value = "";
		this.allowClear = false;
		this.syncActions();
		this.input.focus();
	}
}
