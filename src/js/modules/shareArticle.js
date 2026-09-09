/**
 * Share current page URL (Web Share API, clipboard fallback).
 */

export class ShareArticle {
	constructor(el) {
		this.el = el;
		this.onClick = this.onClick.bind(this);
		el.addEventListener("click", this.onClick);
	}

	async onClick() {
		const url = window.location.href;
		const title = document.title;

		if (typeof navigator.share === "function") {
			try {
				await navigator.share({ title, url });
				return;
			} catch (error) {
				if (error && error.name === "AbortError") {
					return;
				}
			}
		}

		if (navigator.clipboard && typeof navigator.clipboard.writeText === "function") {
			try {
				await navigator.clipboard.writeText(url);
			} catch {
				// Ignore clipboard failures in mock share.
			}
		}
	}
}
