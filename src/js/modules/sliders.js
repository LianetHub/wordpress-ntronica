/**
 * Swiper wrappers for theme sliders.
 * Supports vacancies nav arrows and paged fraction nav.
 */
export class Slider {
	constructor(el) {
		if (typeof Swiper === "undefined") return;

		const slideCount = el.querySelectorAll(".swiper-slide").length;
		if (!slideCount) return;

		const prevEl =
			el.querySelector(".slider-nav__prev") ||
			el.querySelector(".vacancies__arrow--prev");
		const nextEl =
			el.querySelector(".slider-nav__next") ||
			el.querySelector(".vacancies__arrow--next");
		const fractionEl = el.querySelector(".slider-nav__fraction");
		const hasNav = slideCount > 1 && prevEl && nextEl;
		const padFraction = (n) => String(n).padStart(2, "0");
		const isVacancies = !fractionEl;

		const options = {
			slidesPerView: 1,
			spaceBetween: 0,
			speed: 450,
			allowTouchMove: slideCount > 1,
		};

		if (isVacancies) {
			options.watchOverflow = true;
			options.autoHeight = true;
		}

		if (hasNav) {
			options.navigation = { prevEl, nextEl };
		}

		if (fractionEl) {
			options.pagination = {
				el: fractionEl,
				type: "fraction",
				formatFractionCurrent: padFraction,
				formatFractionTotal: padFraction,
				renderFraction: (currentClass, totalClass) =>
					`<span class="${currentClass}"></span>/<span class="${totalClass}"></span>`,
			};
		}

		new Swiper(el, options);
	}
}
