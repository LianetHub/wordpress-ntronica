/**
 * Page hero: reduct wipe on scroll.
 * Homepage also reveals sticky nav after the hero leaves the viewport.
 */
export class PageHero {
	constructor(el) {
		this.targets = [
			el.querySelector(".page-hero__title[data-title]"),
			el.querySelector(".page-hero__tagline[data-title]"),
		].filter(Boolean);

		if (this.targets.length) {
			this.updateWipe = () => {
				const wipe = window.scrollY > 0 ? "100%" : "0%";
				this.targets.forEach((t) => {
					t.style.setProperty("--hero-wipe", wipe);
				});
			};

			this.updateWipe();
			window.addEventListener("scroll", this.updateWipe, { passive: true });
		}

		if (el.classList.contains("page-hero--home")) {
			this.initHomeNavbar(el);
		}
	}

	initHomeNavbar(hero) {
		const navbar = document.querySelector(".sticky-navbar[data-reveal-after-hero]");
		if (!navbar) return;

		this.updateNavbar = () => {
			navbar.classList.toggle(
				"is-visible",
				hero.getBoundingClientRect().bottom <= 0,
			);
		};

		this.updateNavbar();
		window.addEventListener("scroll", this.updateNavbar, { passive: true });
		window.addEventListener("resize", this.updateNavbar);
		window.addEventListener("pageshow", this.updateNavbar);
		this.resizeObserver = new ResizeObserver(this.updateNavbar);
		this.resizeObserver.observe(hero);
	}
}
