/**
 * Swiper wrappers for theme sliders.
 * Supports vacancies grid + nav arrows and paged fraction nav.
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
		const padFraction = (n) => String(n).padStart(2, "0");

		if (el.classList.contains("vacancies-slider")) {
			new Swiper(el, {
				watchOverflow: true,
				slidesPerView: 1,
				slidesPerGroup: 1,
				spaceBetween: 40,
				speed: 450,
				watchOverflow: true,
				allowTouchMove: true,
				grid: {
					rows: 4,
					fill: "row",
				},
				breakpoints: {
					567.98: {
						slidesPerView: 2,
						slidesPerGroup: 2,
						spaceBetween: 24,
						grid: {
							rows: 2,
							fill: "row",
						},
					},
					767.98: {
						slidesPerView: 3,
						slidesPerGroup: 3,
						spaceBetween: 24,
						grid: {
							rows: 2,
							fill: "row",
						},
					},
				},
				navigation: {
					prevEl,
					nextEl,
				},
			});
			return;
		}

		if (el.classList.contains("js-paged-slider")) {
			new Swiper(el, {
				slidesPerView: 1,
				speed: 450,
				watchOverflow: true,
				allowTouchMove: true,
				navigation: {
					prevEl,
					nextEl,
				},
				pagination: {
					el: fractionEl,
					type: "fraction",
					formatFractionCurrent: padFraction,
					formatFractionTotal: padFraction,
					renderFraction: (currentClass, totalClass) =>
						`<span class="${currentClass}"></span>/<span class="${totalClass}"></span>`,
				},
			});
		}
	}
}
