/**
 * Page hero title: scroll-scrubbed reduct clip wipe.
 */
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export class PageHero {
	constructor(el) {
		this.section = el;
		this.title = el.querySelector(".page-hero__title[data-title]");

		if (!this.title) return;
		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}

		ScrollTrigger.create({
			trigger: el,
			start: "20% top",
			end: "50% top",
			scrub: true,
			// markers: true,
			onUpdate: (self) => {
				this.title.style.setProperty(
					"--hero-wipe",
					`${self.progress * 100}%`
				);
			},
		});
	}
}
