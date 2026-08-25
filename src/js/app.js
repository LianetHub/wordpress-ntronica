/**
 * Theme frontend entry (ntronica).
 */

import { FormController } from "./modules/formController.js";
import { SiteMenu } from "./modules/siteMenu.js";
import { Slider } from "./modules/sliders.js";

const components = {
	".sidebar": SiteMenu,
	".vacancies-slider": Slider,
	".js-paged-slider": Slider,
	".wpcf7form": FormController,
};

document.addEventListener("DOMContentLoaded", () => {
	for (const [selector, Component] of Object.entries(components)) {
		document.querySelectorAll(selector).forEach((el) => new Component(el));
	}
});
