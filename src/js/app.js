import { Microchips } from "./modules/microchips.js";
/**
 * Theme frontend entry (ntronica).
 */

import { CookieNotice } from "./modules/cookieNotice.js";
import { FormController } from "./modules/formController.js";
import { PageHero } from "./modules/pageHero.js";
import { SearchForm } from "./modules/searchForm.js";
import { ShareArticle } from "./modules/shareArticle.js";
import { SiteMenu } from "./modules/siteMenu.js";
import { Slider } from "./modules/sliders.js";

const components = {
	".tech-microchips": Microchips,
	".sidebar": SiteMenu,
	".page-hero": PageHero,
	".progress-slider__slider": Slider,
	".news-feed-slider": Slider,
	".news-article-slider": Slider,
	".media-publications-slider": Slider,
	".product-gallery": Slider,
	".product-specs__slider": Slider,
	".news-article__share": ShareArticle,
	".search-form": SearchForm,
	".wpcf7 form": FormController,
	".cookie-notice": CookieNotice,
};

document.addEventListener("DOMContentLoaded", () => {
	if (typeof Fancybox !== "undefined") {
		Fancybox.bind('.product [data-fancybox]', {});
	}
	for (const [selector, Component] of Object.entries(components)) {
		document.querySelectorAll(selector).forEach((el) => new Component(el));
	}
});
