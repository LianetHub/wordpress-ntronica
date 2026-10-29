/**
 * Swiper wrappers for theme sliders.
 * One card per slide; grid layout via Swiper (news / media).
 */
import { initProductSpecs } from "./productSpecs.js";

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
			const section = el.closest(".progress-slider") || el;
			const indexEl = section.querySelector(".progress-slider__index");
			const backgrounds = new Map();
			let requestedBackground;
			const loadBackground = (url) => {
				if (backgrounds.has(url)) return backgrounds.get(url);
				const image = new Image();
				image.decoding = "async";
				image.fetchPriority = "low";
				const entry = { image, ready: false };
				backgrounds.set(url, entry);
				entry.promise = new Promise((resolve, reject) => {
					image.onerror = reject;
					if (typeof image.decode !== "function") image.onload = resolve;
					image.src = url;
					if (typeof image.decode === "function") image.decode().then(resolve, reject);
				}).then(() => {
					entry.ready = true;
					return true;
				}).catch(() => {
					backgrounds.delete(url);
					return false;
				});
				return entry;
			};
			const preloadBackgrounds = () => {
				const urls = [...new Set(Array.from(el.querySelectorAll("[data-background]"), slide => slide.dataset.background))];
				const preloadNext = async () => {
					while (urls.length) await loadBackground(urls.shift()).promise;
				};
				const start = () => {
					void preloadNext();
					void preloadNext();
				};
				if ("requestIdleCallback" in window) window.requestIdleCallback(start, { timeout: 2000 });
				else window.setTimeout(start, 0);
			};
			if (document.readyState === "complete") preloadBackgrounds();
			else window.addEventListener("load", preloadBackgrounds, { once: true });
			const updateBackground = (swiper) => {
				const image = swiper.slides[swiper.activeIndex]?.dataset.background;
				requestedBackground = image;
				if (!image) return;
				const entry = loadBackground(image);
				const apply = () => {
					if (requestedBackground === image && section.isConnected) {
						section.style.backgroundImage = `url(${JSON.stringify(image)})`;
					}
				};
				if (entry.ready) apply();
				else void entry.promise.then(loaded => { if (loaded) apply(); });
			};
			new Swiper(el, {
				watchOverflow: true,
				autoHeight: false,
				slidesPerView: 1,
				spaceBetween: 24,
				speed: 0,
				allowTouchMove: true,
				simulateTouch: false,
				grabCursor: false,
				navigation: {
					prevEl: section.querySelector(".swiper-button-prev"),
					nextEl: section.querySelector(".swiper-button-next"),
				},
				pagination: {
					el: indexEl,
					type: "fraction",
					renderFraction: (currentClass) => `<span class="${currentClass}"></span>`,
				},
				on: {
					init: updateBackground,
					slideChange: updateBackground,
				},
			});
			return;
		}

		if (
			el.classList.contains("news-article-slider") ||
			el.classList.contains("product-gallery")
		) {
			const caption = el.querySelector(".product-gallery__caption");
			const updateCaption = (swiper) => {
				if (caption) caption.textContent = swiper.slides[swiper.activeIndex]?.dataset.caption || "";
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
				on: { init: updateCaption, slideChange: updateCaption },
			});
			return;
		}

		if (el.classList.contains("product-specs__slider")) {
			initProductSpecs(el);
			return;
		}

		if (el.classList.contains("media-publications-slider")) {
			new Swiper(el, {
				watchOverflow: true,
				slidesPerView: 1,
				slidesPerGroup: 3,
				spaceBetween: 30,
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
