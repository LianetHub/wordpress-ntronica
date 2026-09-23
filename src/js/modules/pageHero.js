/**
 * Page hero title/tagline: instant reduct wipe on any scroll.
 */
export class PageHero {
	constructor(el) {
		this.targets = [
			el.querySelector(".page-hero__title[data-title]"),
			el.querySelector(".page-hero__tagline[data-title]"),
		].filter(Boolean);

		if (!this.targets.length) return;

		this.update = () => {
			const wipe = window.scrollY > 0 ? "100%" : "0%";
			this.targets.forEach((t) =>
				t.style.setProperty("--hero-wipe", wipe),
			);
		};

		this.update();
		window.addEventListener("scroll", this.update, { passive: true });
	}
}
