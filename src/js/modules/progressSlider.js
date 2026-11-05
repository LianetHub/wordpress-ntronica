/**
 * Progress timeline slider: preload slide backgrounds and swap on change.
 */

function loadBackground(url, backgrounds) {
	if (backgrounds.has(url)) {
		return backgrounds.get(url);
	}

	const image = new Image();
	image.decoding = "async";
	image.fetchPriority = "low";

	const entry = {
		image,
		ready: false,
	};

	backgrounds.set(url, entry);

	entry.promise = new Promise((resolve, reject) => {
		image.onerror = reject;

		if (typeof image.decode !== "function") {
			image.onload = resolve;
		}

		image.src = url;

		if (typeof image.decode === "function") {
			image.decode().then(resolve, reject);
		}
	})
		.then(() => {
			entry.ready = true;
			return true;
		})
		.catch(() => {
			backgrounds.delete(url);
			return false;
		});

	return entry;
}

function collectBackgroundUrls(el) {
	const slides = el.querySelectorAll("[data-background]");
	return [...new Set(Array.from(slides, (slide) => slide.dataset.background))];
}

function preloadBackgrounds(el, backgrounds) {
	const urls = collectBackgroundUrls(el);

	const preloadNext = async () => {
		while (urls.length) {
			const url = urls.shift();
			await loadBackground(url, backgrounds).promise;
		}
	};

	const start = () => {
		void preloadNext();
		void preloadNext();
	};

	if ("requestIdleCallback" in window) {
		window.requestIdleCallback(start, { timeout: 2000 });
		return;
	}

	window.setTimeout(start, 0);
}

function schedulePreload(el, backgrounds) {
	if (document.readyState === "complete") {
		preloadBackgrounds(el, backgrounds);
		return;
	}

	window.addEventListener(
		"load",
		() => preloadBackgrounds(el, backgrounds),
		{ once: true },
	);
}

export function initProgressSlider(el) {
	const section = el.closest(".progress-slider") || el;
	const indexEl = section.querySelector(".progress-slider__index");
	const backgrounds = new Map();
	let requestedBackground;

	schedulePreload(el, backgrounds);

	const updateBackground = (swiper) => {
		const image = swiper.slides[swiper.activeIndex]?.dataset.background;
		requestedBackground = image;

		if (!image) return;

		const entry = loadBackground(image, backgrounds);

		const apply = () => {
			if (requestedBackground === image && section.isConnected) {
				section.style.backgroundImage = `url(${JSON.stringify(image)})`;
			}
		};

		if (entry.ready) {
			apply();
			return;
		}

		void entry.promise.then((loaded) => {
			if (loaded) apply();
		});
	};

	return new Swiper(el, {
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
			renderFraction: (currentClass) =>
				`<span class="${currentClass}"></span>`,
		},
		on: {
			init: updateBackground,
			slideChange: updateBackground,
		},
	});
}
