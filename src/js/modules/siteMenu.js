/**
 * Site chrome: left sidebar + sticky top navbar.
 */
export class SiteMenu {
	constructor(el) {
		this.sidebar = el;
		this.logoBtn = el.querySelector(".sidebar__logo");
		this.navbar = document.querySelector(".sticky-navbar");
		this.mqWide = window.matchMedia("(min-width: 1023.98px)");
		this.mqAccordion = window.matchMedia("(min-width: 767.98px)");

		this.mqWide.addEventListener("change", () => this.onBreakpointChange());
		this.sidebar.addEventListener("click", (e) => this.onClick(e));

		if (
			this.mqWide.matches &&
			!this.sidebar.classList.contains("is-open")
		) {
			this.sidebar.classList.add("is-collapsed");
		}

		this.syncAria();
		this.syncLock();
		this.initNavbar();
	}

	initNavbar() {
		if (!this.navbar) return;

		this.isBreadcrumbs =
			this.navbar.getAttribute("data-variant") === "breadcrumbs";
		this.syncScrollOffset = this.syncScrollOffset.bind(this);
		this.syncScrollOffset();
		window.addEventListener("resize", this.syncScrollOffset);

		// Utility pages: absolute header — no sticky / is-scrolled
		if (this.isBreadcrumbs) return;

		this.setScrolledState = this.setScrolledState.bind(this);
		this.setScrolledState();
		window.addEventListener("scroll", this.setScrolledState, {
			passive: true,
		});
	}

	syncScrollOffset() {
		if (!this.navbar) return;
		document.documentElement.style.setProperty(
			"--sticky-navbar-offset",
			`${this.navbar.offsetHeight}px`,
		);
	}

	setScrolledState() {
		if (!this.navbar) return;
		this.navbar.classList.toggle("is-scrolled", window.scrollY > 0);
	}

	isOpen() {
		return this.mqWide.matches
			? !this.sidebar.classList.contains("is-collapsed")
			: this.sidebar.classList.contains("is-open");
	}

	syncLock() {
		document.body.classList.toggle(
			"lock",
			this.sidebar.classList.contains("is-open") && !this.mqWide.matches,
		);
	}

	syncAria() {
		if (this.logoBtn) {
			this.logoBtn.setAttribute(
				"aria-expanded",
				this.isOpen() ? "true" : "false",
			);
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
