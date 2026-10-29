/**
 * Homepage: static hero and navigation revealed after it scrolls out.
 * Other pages: instant reduct wipe on scroll.
 */
export class PageHero {
	constructor(el) {
		if (el.classList.contains("page-hero--home")) {
			this.initHomeNavbar(el);
			return;
		}

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

	initHomeNavbar(hero) {
		const navbar = document.querySelector(".sticky-navbar[data-reveal-after-hero]");
		if (!navbar) return;

		this.update = () => {
			navbar.classList.toggle("is-visible", hero.getBoundingClientRect().bottom <= 0);
		};

		this.update();
		window.addEventListener("scroll", this.update, { passive: true });
		window.addEventListener("resize", this.update);
		window.addEventListener("pageshow", this.update);
		this.resizeObserver = new ResizeObserver(this.update);
		this.resizeObserver.observe(hero);
	}
}
