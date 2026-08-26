/**
 * Search form: show/hide clear button and reset the query field.
 */
export class SearchForm {
	constructor(el) {
		this.form = el;
		this.input = el.querySelector(".search-form__input");
		this.clear = el.querySelector(".search-form__clear");

		if (!this.input || !this.clear) return;

		this.input.addEventListener("input", () => this.syncClear());
		this.clear.addEventListener("click", () => this.onClear());
		this.syncClear();
	}

	syncClear() {
		this.clear.hidden = this.input.value.length === 0;
	}

	onClear() {
		this.input.value = "";
		this.syncClear();
		this.input.focus();
	}
}
