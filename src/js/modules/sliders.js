/**
 * Swiper wrappers for theme sliders.
 * One card per slide; grid layout via Swiper (news / media).
 */
import { initProductSpecs } from "./productSpecs.js";
import { initProgressSlider } from "./progressSlider.js";

export class Slider {
	constructor(el) {
		if (typeof Swiper === "undefined") return;

		const slideCount = el.querySelectorAll(".swiper-slide").length;
		if (!slideCount) return;

		const prevEl = el.querySelector(".swiper-button-prev");
		const nextEl = el.querySelector(".swiper-button-next");
		const fractionEl = el.querySelector(".slider-nav__fraction");
		const padFraction = (n) => String(n).padStart(2, "0");

		// Swiper shares spaceBetween between axes; the design uses a separate row gap.
		const updateGridRows = (swiper) => {
			swiper.slides.forEach((slide) => {
				slide.style.marginTop = slide.row > 0 ? "var(--slider-row-gap)" : "";
			});
		};

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
				on: { slidesUpdated: updateGridRows },
				watchOverflow: true,
				slidesPerView: 2,
				slidesPerGroup: 6,
				spaceBetween: 24,
				speed: 0,
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

		if (
			el.classList.contains("progress-slider__slider") ||
			el.classList.contains("progress-slider")
		) {
			initProgressSlider(el);
			return;
		}

		if (
			el.classList.contains("news-article-slider") ||
			el.classList.contains("product-gallery")
		) {
			const caption = el.querySelector(".product-gallery__caption");

			const updateCaption = (swiper) => {
				if (!caption) return;
				caption.textContent =
					swiper.slides[swiper.activeIndex]?.dataset.caption || "";
			};

			new Swiper(el, {
				loop: el.classList.contains("product-gallery") && slideCount > 1,
				watchOverflow: true,
				slidesPerView: 1,
				spaceBetween: 0,
				speed: 0,
				allowTouchMove: true,
				navigation: {
					prevEl,
					nextEl,
				},
				pagination: fractionPagination,
				on: {
					init: updateCaption,
					slideChange: updateCaption,
				},
			});
			return;
		}

		if (el.classList.contains("product-specs__slider")) {
			initProductSpecs(el);
			return;
		}

		if (el.classList.contains("media-publications-slider")) {
			new Swiper(el, {
				on: { slidesUpdated: updateGridRows },
				watchOverflow: true,
				slidesPerView: 1,
				slidesPerGroup: 3,
				spaceBetween: 24,
				speed: 0,
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
					2559.98: {
						slidesPerView: 3,
						slidesPerGroup: 6,
						spaceBetween: 43,
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
