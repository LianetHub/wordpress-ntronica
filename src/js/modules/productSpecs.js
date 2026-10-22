/** Keep the fixed labels and every machine aligned, including offscreen slides. */
export function initProductSpecs(el) {
	const section = el.closest(".product-specs");
	const columns = [...section.querySelectorAll(".product-specs__labels, .swiper-slide")];
	const rows = columns.map(column => [...column.querySelectorAll(".product-specs__col-title, .product-specs__cell")]);
	let frame = 0;
	let destroyed = false;
	const syncRows = () => {
		frame = 0;
		if (destroyed) return;
		const tableWidth = el.getBoundingClientRect().right - rows[0][0].getBoundingClientRect().left;
		if (tableWidth > 0) section.style.setProperty("--spec-table-width", `${tableWidth}px`);
		const heights = rows[0].map((_, index) => Math.ceil(Math.max(...rows.map(column => {
			const cell = column[index];
			const style = getComputedStyle(cell);
			return Math.max(parseFloat(style.minHeight) || 0,
				cell.firstElementChild.getBoundingClientRect().height +
				(parseFloat(style.paddingTop) || 0) + (parseFloat(style.paddingBottom) || 0));
		}))));
		rows.forEach(column => column.forEach((cell, index) => {
			const height = `${heights[index]}px`;
			if (cell.style.height !== height) cell.style.height = height;
		}));
	};
	const schedule = () => {
		if (!frame && !destroyed) frame = requestAnimationFrame(syncRows);
	};
	const observer = typeof ResizeObserver !== "undefined" ? new ResizeObserver(schedule) : null;
	// Observe natural content sizes, so setting the row height cannot cause a loop.
	rows.flat().forEach(cell => observer?.observe(cell.firstElementChild));
	window.addEventListener("resize", schedule);
	document.fonts?.ready.then(schedule);

	const swiper = new Swiper(el, {
		watchOverflow: true,
		slidesPerView: "auto",
		spaceBetween: 14,
		speed: 100,
		allowTouchMove: true,
		// Leave enough trailing space for the last machine to reach the left edge.
		slidesOffsetAfter() {
			return Math.max(0, this.size - el.querySelector(".swiper-slide").getBoundingClientRect().width);
		},
		breakpoints: { 767.98: { spaceBetween: 24 } },
		navigation: {
			prevEl: el.querySelector(".swiper-button-prev"),
			nextEl: el.querySelector(".swiper-button-next"),
		},
		on: {
			init: schedule,
			resize: schedule,
			beforeDestroy() {
				destroyed = true;
				observer?.disconnect();
				window.removeEventListener("resize", schedule);
				cancelAnimationFrame(frame);
			},
		},
	});
	syncRows();
	return swiper;
}
