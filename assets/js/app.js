/**
 * Theme frontend entry (ntronica).
 */

import { FormController } from "./modules/formController.js";
import { PageHero } from "./modules/pageHero.js";
import { SearchForm } from "./modules/searchForm.js";
import { SiteMenu } from "./modules/siteMenu.js";
import { Slider } from "./modules/sliders.js";

const components = {
	".sidebar": SiteMenu,
	".page-hero": PageHero,
	".vacancies-slider": Slider,
	".news-feed-slider": Slider,
	".media-publications-slider": Slider,
	".search-form": SearchForm,
	".wpcf7form": FormController,
};

document.addEventListener("DOMContentLoaded", () => {
	for (const [selector, Component] of Object.entries(components)) {
		document.querySelectorAll(selector).forEach((el) => new Component(el));
	}
});
