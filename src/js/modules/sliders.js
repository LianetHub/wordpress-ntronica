/**
 * Swiper wrappers for theme sliders.
 * One card per slide; grid layout via Swiper (news / media).
 */
export class Slider {
	constructor(el) {
		if (typeof Swiper === "undefined") return;

		const slideCount = el.querySelectorAll(".swiper-slide").length;
		if (!slideCount) return;

		const prevEl = el.querySelector(".swiper-button-prev");
		const nextEl = el.querySelector(".swiper-button-next");
		const fractionEl = el.querySelector(".slider-nav__fraction");
		const padFraction = (n) => String(n).padStart(2, "0");

		const fractionPagination = fractionEl
			? {
					el: fractionEl,
					type: "fraction",
					formatFractionCurrent: padFraction,
					formatFractionTotal: padFraction,
					renderFraction: (currentClass, totalClass) =>
						`<span class="${currentClass}"></span>/<span class="${totalClass}"></span>`,
				}
			: undefined;

		if (el.classList.contains("news-feed-slider")) {
			new Swiper(el, {
				watchOverflow: true,
				slidesPerView: 2,
				slidesPerGroup: 6,
				spaceBetween: 24,
				speed: 450,
				allowTouchMove: true,
				grid: {
					rows: 3,
					fill: "row",
				},
				breakpoints: {
					767.98: {
						slidesPerView: 4,
						slidesPerGroup: 8,
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
				pagination: fractionPagination,
			});
			return;
		}

		if (el.classList.contains("media-publications-slider")) {
			new Swiper(el, {
				watchOverflow: true,
				slidesPerView: 1,
				slidesPerGroup: 3,
				spaceBetween: 30,
				speed: 450,
				allowTouchMove: true,
				grid: {
					rows: 3,
					fill: "row",
				},
				breakpoints: {
					767.98: {
						slidesPerView: 3,
						slidesPerGroup: 6,
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
				pagination: fractionPagination,
			});
		}
	}
}
