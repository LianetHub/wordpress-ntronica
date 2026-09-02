/**
 * Page hero title/tagline: scroll-scrubbed reduct clip wipe.
 */
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export class PageHero {
	constructor(el) {
		this.section = el;

		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}

		this.bindWipe(el.querySelector(".page-hero__title[data-title]"), "40%");
		this.bindWipe(
			el.querySelector(".page-hero__tagline[data-title]"),
			"2%",
		);
	}

	bindWipe(target, end) {
		if (!target) return;

		ScrollTrigger.create({
			trigger: this.section,
			start: "0% top",
			end: `${end} top`,
			scrub: true,
			onUpdate: (self) => {
				target.style.setProperty(
					"--hero-wipe",
					`${self.progress * 100}%`,
				);
			},
		});
	}
}
