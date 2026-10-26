export class Microchips {
	constructor(el) {
		const button = el.querySelector('.tech-microchips__more');
		if (!button) return;
		button.hidden = false;
		button.addEventListener('click', () => {
			const expanded = el.classList.toggle('is-expanded');
			button.setAttribute('aria-expanded', String(expanded));
			const text = expanded ? button.dataset.expandedText : button.dataset.defaultText;
			button.querySelector('span').textContent = text;
			button.dataset.title = text;
		});
	}
}
