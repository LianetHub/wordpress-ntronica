/**
 * Theme frontend entry (ntronica).
 */

import { FormController } from "./modules/formController.js";


class Sidebar {
	constructor(el) {
		this.sidebar = el;
		this.logoBtn = el.querySelector(".sidebar__logo");
		this.mqWide = window.matchMedia("(min-width: 1023.98px)");
		this.mqAccordion = window.matchMedia("(min-width: 767.98px)");

		this.mqWide.addEventListener("change", () => this.onBreakpointChange());
		this.sidebar.addEventListener("click", (e) => this.onClick(e));

		if (this.mqWide.matches && !this.sidebar.classList.contains("is-open")) {
			this.sidebar.classList.add("is-collapsed");
		}

		this.syncAria();
		this.syncLock();
	}

	isOpen() {
		return this.mqWide.matches
			? !this.sidebar.classList.contains("is-collapsed")
			: this.sidebar.classList.contains("is-open");
	}

	syncLock() {
		document.body.classList.toggle(
			"lock",
			this.sidebar.classList.contains("is-open") && !this.mqWide.matches
		);
	}

	syncAria() {
		if (this.logoBtn) {
			this.logoBtn.setAttribute("aria-expanded", this.isOpen() ? "true" : "false");
		}
	}

	closeOverlay() {
		this.sidebar.classList.remove("is-open");
		this.syncAria();
		this.syncLock();
	}

	toggle() {
		if (this.mqWide.matches) {
			this.sidebar.classList.toggle("is-collapsed");
			this.sidebar.classList.remove("is-open");
		} else {
			this.sidebar.classList.toggle("is-open");
			this.sidebar.classList.remove("is-collapsed");
		}
		this.syncAria();
		this.syncLock();
	}

	setItemExpanded(item, expanded) {
		item.classList.toggle("is-expanded", expanded);
		const link = item.querySelector(":scope > .sidebar__link");
		if (link && link.hasAttribute("aria-expanded")) {
			link.setAttribute("aria-expanded", expanded ? "true" : "false");
		}
	}

	onClick(event) {
		if (event.target.closest(".sidebar__close")) {
			if (this.mqWide.matches) {
				this.sidebar.classList.add("is-collapsed");
				this.sidebar.classList.remove("is-open");
			} else {
				this.closeOverlay();
			}
			this.syncAria();
			this.syncLock();
			return;
		}

		if (event.target.closest(".sidebar__lang")) {
			return;
		}

		if (event.target.closest(".sidebar__sublink")) {
			if (!this.mqWide.matches) {
				this.closeOverlay();
			}
			return;
		}

		const parentLink = event.target.closest(".sidebar__link");
		if (parentLink) {
			const item = parentLink.closest(".sidebar__item");
			const hasSubmenu = item && item.querySelector(".sidebar__submenu");

			if (hasSubmenu && !this.mqAccordion.matches) {
				event.preventDefault();
				const willExpand = !item.classList.contains("is-expanded");

				this.sidebar
					.querySelectorAll(".sidebar__item.is-expanded")
					.forEach((el) => {
						if (el !== item) {
							this.setItemExpanded(el, false);
						}
					});

				this.setItemExpanded(item, willExpand);
			}
			return;
		}

		if (this.isOpen()) {
			if (this.mqWide.matches) {
				this.toggle();
			}
		} else {
			this.toggle();
		}
	}

	onBreakpointChange() {
		this.sidebar.classList.remove("is-open");
		if (this.mqWide.matches) {
			this.sidebar.classList.add("is-collapsed");
		} else {
			this.sidebar.classList.remove("is-collapsed");
		}
		this.syncAria();
		this.syncLock();
	}
}

class Sliders {
	constructor(el) {
		new Swiper(el, {
			slidesPerView: 1,
			spaceBetween: 0,
			speed: 450,
			watchOverflow: true,
			navigation: {
				prevEl: ".vacancies__arrow--prev",
				nextEl: ".vacancies__arrow--next",
			},
		});
	}
}

class PagedSlider {
	constructor(el) {
		if (typeof Swiper === "undefined") return;

		const slideCount = el.querySelectorAll(".swiper-slide").length;
		if (!slideCount) return;

		const prevEl = el.querySelector(".slider-nav__prev");
		const nextEl = el.querySelector(".slider-nav__next");
		const fractionEl = el.querySelector(".slider-nav__fraction");
		const hasNav = slideCount > 1 && prevEl && nextEl;
		const padFraction = (n) => String(n).padStart(2, "0");

		new Swiper(el, {
			slidesPerView: 1,
			spaceBetween: 0,
			speed: 450,
			allowTouchMove: slideCount > 1,
			navigation: hasNav ? { prevEl, nextEl } : undefined,
			pagination: fractionEl
				? {
					el: fractionEl,
					type: "fraction",
					formatFractionCurrent: padFraction,
					formatFractionTotal: padFraction,
					renderFraction: (currentClass, totalClass) =>
						`<span class="${currentClass}"></span>/<span class="${totalClass}"></span>`,
				}
				: undefined,
		});
	}
}

class StickyNavbar {
	constructor(el) {
		this.navbar = el;
		this.setScrolledState = this.setScrolledState.bind(this);
		this.syncScrollOffset = this.syncScrollOffset.bind(this);

		this.setScrolledState();
		this.syncScrollOffset();

		window.addEventListener("scroll", this.setScrolledState, { passive: true });
		window.addEventListener("resize", this.syncScrollOffset);
	}

	syncScrollOffset() {
		document.documentElement.style.setProperty(
			"--sticky-navbar-offset",
			`${this.navbar.offsetHeight}px`
		);
	}

	setScrolledState() {
		this.navbar.classList.toggle("is-scrolled", window.scrollY > 0);
	}
}

const components = {
	".sidebar": Sidebar,
	".vacancies-slider": Sliders,
	".js-paged-slider": PagedSlider,
	".sticky-navbar": StickyNavbar,
	".wpcf7 form": FormController,
};

document.addEventListener("DOMContentLoaded", () => {
	for (const [selector, Component] of Object.entries(components)) {
		document.querySelectorAll(selector).forEach((el) => new Component(el));
	}
});

