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
		this.mqSwipe = window.matchMedia("(max-width: 767.98px)");
		this.mqHover = window.matchMedia("(hover: hover) and (pointer: fine)");

		this.onPointerEnter = this.onPointerEnter.bind(this);
		this.onPointerLeave = this.onPointerLeave.bind(this);
		this.onFocusIn = this.onFocusIn.bind(this);
		this.onFocusOut = this.onFocusOut.bind(this);
		this.onSwipePointerDown = this.onSwipePointerDown.bind(this);
		this.onSwipePointerMove = this.onSwipePointerMove.bind(this);
		this.onSwipePointerUp = this.onSwipePointerUp.bind(this);

		this.swipe = null;
		this.suppressClick = false;
		this.isClosingSwipe = false;

		this.mqWide.addEventListener("change", () => this.onBreakpointChange());
		this.sidebar.addEventListener("click", (e) => this.onClick(e));
		this.sidebar.addEventListener("pointerenter", this.onPointerEnter);
		this.sidebar.addEventListener("pointerleave", this.onPointerLeave);
		this.sidebar.addEventListener("focusin", this.onFocusIn);
		this.sidebar.addEventListener("focusout", this.onFocusOut);

		if (
			this.mqWide.matches &&
			!this.sidebar.classList.contains("is-open")
		) {
			this.sidebar.classList.add("is-collapsed");
		}

		this.syncAria();
		this.syncLock();
		this.initNavbar();
		this.initSwipeClose();
	}

	canSwipeClose() {
		return (
			this.mqSwipe.matches && this.sidebar.classList.contains("is-open")
		);
	}

	initSwipeClose() {
		this.sidebar.addEventListener("pointerdown", this.onSwipePointerDown);
		this.sidebar.addEventListener("pointermove", this.onSwipePointerMove);
		this.sidebar.addEventListener("pointerup", this.onSwipePointerUp);
		this.sidebar.addEventListener("pointercancel", this.onSwipePointerUp);
	}

	clearSwipeStyles() {
		this.sidebar.classList.remove("is-swiping", "is-closing-swipe");
		this.sidebar.style.width = "";
		this.sidebar.style.transition = "";
		this.sidebar.style.removeProperty("--sidebar-close-progress");
	}

	getCollapsedWidth() {
		const probe = document.createElement("div");
		probe.style.cssText =
			"position:absolute;visibility:hidden;pointer-events:none;width:var(--sidebar-width);";
		document.body.appendChild(probe);
		const width = probe.getBoundingClientRect().width;
		probe.remove();
		return width;
	}

	getSwipeProgress(widthPx, openWidth, closedWidth) {
		const range = openWidth - closedWidth;
		if (range <= 0) return 0;
		return Math.min(1, Math.max(0, (openWidth - widthPx) / range));
	}

	updateSwipeVisuals(widthPx, openWidth, closedWidth) {
		this.sidebar.style.width = `${widthPx}px`;
		this.sidebar.style.setProperty(
			"--sidebar-close-progress",
			this.getSwipeProgress(widthPx, openWidth, closedWidth).toFixed(4),
		);
	}

	suppressClickBriefly(ms = 400) {
		this.suppressClick = true;
		window.clearTimeout(this.suppressClickTimer);
		this.suppressClickTimer = window.setTimeout(() => {
			this.suppressClick = false;
		}, ms);
	}

	finishSwipeClose() {
		if (!this.isClosingSwipe) return;

		this.suppressClickBriefly();
		this.sidebar.style.transition = "none";

		if (this.logoBtn) {
			this.logoBtn.style.transition = "none";
		}

		this.sidebar.classList.remove(
			"is-open",
			"is-swiping",
			"is-closing-swipe",
		);
		this.sidebar.classList.add("is-collapsed");
		this.sidebar.style.width = "";
		this.sidebar.style.removeProperty("--sidebar-close-progress");

		this.syncAria();
		this.syncLock();
		this.swipe = null;
		this.isClosingSwipe = false;

		requestAnimationFrame(() => {
			this.sidebar.style.transition = "";
			if (this.logoBtn) {
				this.logoBtn.style.transition = "";
			}
		});
	}

	resetSwipeWidth(openWidth, closedWidth) {
		this.sidebar.classList.remove("is-swiping");
		this.sidebar.classList.add("is-closing-swipe");
		this.sidebar.style.transition = "width 0.2s ease";

		requestAnimationFrame(() => {
			this.updateSwipeVisuals(openWidth, openWidth, closedWidth);
		});

		const onTransitionEnd = (event) => {
			if (event.propertyName !== "width") return;
			this.sidebar.removeEventListener("transitionend", onTransitionEnd);
			this.clearSwipeStyles();
		};

		this.sidebar.addEventListener("transitionend", onTransitionEnd);
	}

	completeSwipeClose(closedWidth, openWidth) {
		if (this.isClosingSwipe) return;

		this.isClosingSwipe = true;
		this.sidebar.classList.remove("is-swiping");
		this.sidebar.classList.add("is-closing-swipe");
		this.sidebar.style.transition = "width 0.25s ease";

		requestAnimationFrame(() => {
			this.updateSwipeVisuals(closedWidth, openWidth, closedWidth);
		});

		const onTransitionEnd = (event) => {
			if (event.propertyName !== "width") return;
			this.sidebar.removeEventListener("transitionend", onTransitionEnd);
			window.clearTimeout(fallbackTimer);
			this.finishSwipeClose();
		};

		const fallbackTimer = window.setTimeout(() => {
			this.sidebar.removeEventListener("transitionend", onTransitionEnd);
			this.finishSwipeClose();
		}, 350);

		this.sidebar.addEventListener("transitionend", onTransitionEnd);
	}

	onSwipePointerDown(event) {
		if (!this.canSwipeClose() || this.isClosingSwipe) return;
		if (event.pointerType === "mouse") return;

		this.swipe = {
			pointerId: event.pointerId,
			startX: event.clientX,
			startY: event.clientY,
			dragging: false,
		};
	}

	onSwipePointerMove(event) {
		if (!this.swipe || event.pointerId !== this.swipe.pointerId) return;

		const deltaX = event.clientX - this.swipe.startX;
		const deltaY = event.clientY - this.swipe.startY;

		if (!this.swipe.dragging) {
			if (Math.abs(deltaX) < 10 && Math.abs(deltaY) < 10) return;

			if (Math.abs(deltaY) > Math.abs(deltaX) || deltaX > 0) {
				this.swipe = null;
				return;
			}

			this.swipe.dragging = true;
			this.swipe.openWidth = this.sidebar.offsetWidth;
			this.swipe.closedWidth = this.getCollapsedWidth();
			this.sidebar.classList.add("is-swiping");
			this.sidebar.setPointerCapture(event.pointerId);
		}

		event.preventDefault();
		const nextWidth = Math.max(
			this.swipe.closedWidth,
			this.swipe.openWidth + deltaX,
		);
		this.updateSwipeVisuals(
			nextWidth,
			this.swipe.openWidth,
			this.swipe.closedWidth,
		);
	}

	onSwipePointerUp(event) {
		if (!this.swipe || event.pointerId !== this.swipe.pointerId) return;

		if (this.sidebar.hasPointerCapture(event.pointerId)) {
			this.sidebar.releasePointerCapture(event.pointerId);
		}

		if (!this.swipe.dragging) {
			this.swipe = null;
			return;
		}

		const deltaX = event.clientX - this.swipe.startX;
		const threshold = Math.min(80, this.swipe.openWidth * 0.25);
		const openWidth = this.swipe.openWidth;
		const closedWidth = this.swipe.closedWidth;

		this.swipe = null;
		this.suppressClickBriefly();

		if (deltaX <= -threshold) {
			this.completeSwipeClose(closedWidth, openWidth);
		} else {
			this.resetSwipeWidth(openWidth, closedWidth);
		}
	}

	usesHoverExpand() {
		return this.mqWide.matches && this.mqHover.matches;
	}

	expandWide() {
		this.sidebar.classList.remove("is-collapsed");
		this.sidebar.classList.remove("is-open");
		this.syncAria();
	}

	collapseWide() {
		this.sidebar.classList.add("is-collapsed");
		this.sidebar.classList.remove("is-open");
		this.syncAria();
	}

	onPointerEnter(event) {
		if (!this.usesHoverExpand()) return;
		if (event.pointerType === "touch") return;
		this.expandWide();
	}

	onPointerLeave(event) {
		if (!this.usesHoverExpand()) return;
		if (event.pointerType === "touch") return;
		if (this.sidebar.contains(document.activeElement)) return;
		this.collapseWide();
	}

	onFocusIn() {
		if (!this.usesHoverExpand()) return;
		this.expandWide();
	}

	onFocusOut(event) {
		if (!this.usesHoverExpand()) return;
		if (this.sidebar.contains(event.relatedTarget)) return;
		if (this.sidebar.matches(":hover")) return;
		this.collapseWide();
	}

	initNavbar() {
		if (!this.navbar) return;

		this.isBreadcrumbs =
			this.navbar.getAttribute("data-variant") === "breadcrumbs";

		// Utility pages: absolute header — CSS-only offset, no sticky / measure
		if (this.isBreadcrumbs) return;

		this.syncScrollOffset = this.syncScrollOffset.bind(this);
		this.setScrolledState = this.setScrolledState.bind(this);

		this.syncScrollOffset();
		this.setScrolledState();

		window.addEventListener("resize", this.syncScrollOffset);
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
		this.isClosingSwipe = false;
		this.swipe = null;
		this.clearSwipeStyles();
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
		if (this.suppressClick || this.isClosingSwipe) {
			event.preventDefault();
			return;
		}

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

		if (this.usesHoverExpand()) {
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
		this.isClosingSwipe = false;
		this.swipe = null;
		this.clearSwipeStyles();
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
