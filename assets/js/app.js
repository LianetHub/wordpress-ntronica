/**
 * Theme frontend entry (ntronica).
 */
document.addEventListener("DOMContentLoaded", () => {
	initSidebar();
	initVacanciesSlider();
	initPagedSliders();
	initSearchForms();
	initStickyNavbar();
});

const initSidebar = () => {
	const sidebar = document.querySelector(".sidebar");

	if (!sidebar) {
		return;
	}

	const logoBtn = sidebar.querySelector(".sidebar__logo");
	const mqWide = window.matchMedia("(min-width: 1199.98px)");
	const mqLock = window.matchMedia("(min-width: 1023.98px)");
	const mqAccordion = window.matchMedia("(min-width: 767.98px)");

	const isOpen = () =>
		mqWide.matches
			? !sidebar.classList.contains("is-collapsed")
			: sidebar.classList.contains("is-open");

	const syncLock = () => {
		document.body.classList.toggle(
			"lock",
			sidebar.classList.contains("is-open") && !mqLock.matches,
		);
	};

	const syncAria = () => {
		if (logoBtn) {
			logoBtn.setAttribute("aria-expanded", isOpen() ? "true" : "false");
		}
	};

	const closeOverlay = () => {
		sidebar.classList.remove("is-open");
		syncAria();
		syncLock();
	};

	const toggle = () => {
		if (mqWide.matches) {
			sidebar.classList.toggle("is-collapsed");
			sidebar.classList.remove("is-open");
		} else {
			sidebar.classList.toggle("is-open");
			sidebar.classList.remove("is-collapsed");
		}

		syncAria();
		syncLock();
	};

	const setItemExpanded = (item, expanded) => {
		item.classList.toggle("is-expanded", expanded);
		const link = item.querySelector(":scope > .sidebar__link");
		if (link && link.hasAttribute("aria-expanded")) {
			link.setAttribute("aria-expanded", expanded ? "true" : "false");
		}
	};

	sidebar.addEventListener("click", (event) => {
		if (event.target.closest(".sidebar__lang")) {
			return;
		}

		if (event.target.closest(".sidebar__sublink")) {
			if (!mqWide.matches) {
				closeOverlay();
			}
			return;
		}

		const parentLink = event.target.closest(".sidebar__link");
		if (parentLink) {
			const item = parentLink.closest(".sidebar__item");
			const hasSubmenu = item && item.querySelector(".sidebar__submenu");

			if (hasSubmenu && !mqAccordion.matches) {
				event.preventDefault();
				const willExpand = !item.classList.contains("is-expanded");

				sidebar
					.querySelectorAll(".sidebar__item.is-expanded")
					.forEach((el) => {
						if (el !== item) {
							setItemExpanded(el, false);
						}
					});

				setItemExpanded(item, willExpand);
			}

			return;
		}

		toggle();
	});

	const onBreakpointChange = () => {
		sidebar.classList.remove("is-open", "is-collapsed");
		syncAria();
		syncLock();
	};

	if (typeof mqWide.addEventListener === "function") {
		mqWide.addEventListener("change", onBreakpointChange);
		mqLock.addEventListener("change", syncLock);
	} else if (typeof mqWide.addListener === "function") {
		mqWide.addListener(onBreakpointChange);
		mqLock.addListener(syncLock);
	}

	syncAria();
	syncLock();
};

const initVacanciesSlider = () => {
	const vacanciesEl = document.querySelector(".vacancies-slider");

	if (!vacanciesEl || typeof Swiper === "undefined") {
		return;
	}

	const slideCount = vacanciesEl.querySelectorAll(".swiper-slide").length;

	if (slideCount < 2) {
		return;
	}

	new Swiper(vacanciesEl, {
		slidesPerView: 1,
		spaceBetween: 0,
		speed: 450,
		navigation: {
			prevEl: vacanciesEl.querySelector(".vacancies__arrow--prev"),
			nextEl: vacanciesEl.querySelector(".vacancies__arrow--next"),
		},
	});
};

const padFraction = (n) => String(n).padStart(2, "0");

const initPagedSliders = () => {
	if (typeof Swiper === "undefined") {
		return;
	}

	document.querySelectorAll(".js-paged-slider").forEach((sliderEl) => {
		const slideCount = sliderEl.querySelectorAll(".swiper-slide").length;
		const prevEl = sliderEl.querySelector(".slider-nav__prev");
		const nextEl = sliderEl.querySelector(".slider-nav__next");
		const fractionEl = sliderEl.querySelector(".slider-nav__fraction");
		const hasNav = slideCount > 1 && prevEl && nextEl;

		if (!slideCount) {
			return;
		}

		new Swiper(sliderEl, {
			slidesPerView: 1,
			spaceBetween: 0,
			speed: 450,
			allowTouchMove: slideCount > 1,
			navigation: hasNav
				? {
						prevEl,
						nextEl,
					}
				: undefined,
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
	});
};

const initSearchForms = () => {
	document.querySelectorAll(".search-form").forEach((form) => {
		const input = form.querySelector(".search-form__input");
		const clear = form.querySelector(".search-form__clear");

		if (!input || !clear) {
			return;
		}

		const syncClear = () => {
			clear.hidden = input.value.length === 0;
		};

		input.addEventListener("input", syncClear);
		clear.addEventListener("click", () => {
			input.value = "";
			syncClear();
			input.focus();
		});

		syncClear();
	});
};

const initStickyNavbar = () => {
	const navbars = Array.from(document.querySelectorAll(".sticky-navbar"));

	if (!navbars.length) {
		return;
	}

	const setScrolledState = (navbar) => {
		navbar.classList.toggle("is-scrolled", window.scrollY > 0);
	};

	const onScroll = () => {
		navbars.forEach((navbar) => setScrolledState(navbar));
	};

	navbars.forEach((navbar) => setScrolledState(navbar));

	window.addEventListener("scroll", onScroll, { passive: true });
};
