/**
 * Theme frontend entry (ntronica).
 */
document.addEventListener('DOMContentLoaded', () => {
	initSidebar();
	initVacanciesSlider();
});

const initSidebar = () => {
	const sidebar = document.querySelector('.site-sidebar');

	if (!sidebar) {
		return;
	}

	const logoBtn = sidebar.querySelector('.site-sidebar__logo');
	const mqWide = window.matchMedia('(min-width: 1199.98px)');

	const isOpen = () =>
		mqWide.matches ? !sidebar.classList.contains('is-collapsed') : sidebar.classList.contains('is-open');

	const syncAria = () => {
		if (logoBtn) {
			logoBtn.setAttribute('aria-expanded', isOpen() ? 'true' : 'false');
		}
	};

	const toggle = () => {
		if (mqWide.matches) {
			sidebar.classList.toggle('is-collapsed');
			sidebar.classList.remove('is-open');
		} else {
			sidebar.classList.toggle('is-open');
			sidebar.classList.remove('is-collapsed');
		}

		syncAria();
	};

	sidebar.addEventListener('click', (event) => {
		if (event.target.closest('.site-sidebar__link')) {
			return;
		}

		toggle();
	});

	const onBreakpointChange = () => {
		sidebar.classList.remove('is-open', 'is-collapsed');
		syncAria();
	};

	if (typeof mqWide.addEventListener === 'function') {
		mqWide.addEventListener('change', onBreakpointChange);
	} else if (typeof mqWide.addListener === 'function') {
		mqWide.addListener(onBreakpointChange);
	}

	syncAria();
};

const initVacanciesSlider = () => {
	const vacanciesEl = document.querySelector('.vacancies-slider');

	if (!vacanciesEl || typeof Swiper === 'undefined') {
		return;
	}

	const mqDesktop = window.matchMedia('(min-width: 767.98px)');
	const nav = vacanciesEl.querySelector('.section-vacancies__nav');
	const wrapper = vacanciesEl.querySelector('.swiper-wrapper');
	let vacancies = [];

	try {
		vacancies = JSON.parse(vacanciesEl.getAttribute('data-vacancies') || '[]');
	} catch (e) {
		vacancies = [];
	}

	if (!Array.isArray(vacancies) || !vacancies.length || !wrapper) {
		return;
	}

	let swiperInstance = null;

	const chunk = (items, size) => {
		const pages = [];
		for (let i = 0; i < items.length; i += size) {
			pages.push(items.slice(i, i + size));
		}
		return pages;
	};

	const escapeHtml = (value) =>
		String(value)
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&#39;');

	const buildSlides = (perPage) => {
		const pages = chunk(vacancies, perPage);
		wrapper.innerHTML = pages
			.map(
				(page) => `
			<div class="swiper-slide">
				<div class="row section-vacancies__grid">
					${page
						.map(
							(item) => `
						<div class="col-12 col-md-4">
							<article class="vacancy-card">
								<h3 class="vacancy-card__title">${escapeHtml(item.title || '')}</h3>
								<p class="vacancy-card__dept">${escapeHtml(item.dept || '')}</p>
							</article>
						</div>`
						)
						.join('')}
				</div>
			</div>`
			)
			.join('');
		return pages.length;
	};

	const initVacancies = () => {
		const perPage = mqDesktop.matches ? 6 : 4;
		const pageCount = buildSlides(perPage);
		const hasMultiplePages = pageCount > 1;

		if (nav) {
			nav.classList.toggle('section-vacancies__nav--hidden', !hasMultiplePages);
		}

		if (swiperInstance) {
			swiperInstance.destroy(true, true);
			swiperInstance = null;
		}

		swiperInstance = new Swiper(vacanciesEl, {
			slidesPerView: 1,
			spaceBetween: 0,
			speed: 450,
			allowTouchMove: hasMultiplePages,
			navigation: hasMultiplePages
				? {
						prevEl: vacanciesEl.querySelector('.section-vacancies__arrow--prev'),
						nextEl: vacanciesEl.querySelector('.section-vacancies__arrow--next'),
					}
				: undefined,
		});
	};

	initVacancies();

	const onBreakpointChange = () => initVacancies();
	if (typeof mqDesktop.addEventListener === 'function') {
		mqDesktop.addEventListener('change', onBreakpointChange);
	} else if (typeof mqDesktop.addListener === 'function') {
		mqDesktop.addListener(onBreakpointChange);
	}
};
