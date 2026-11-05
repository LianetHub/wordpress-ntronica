/**
 * Product specs table: keep label column and machine slides row-aligned.
 */

function measureCellHeight(cell) {
	const style = getComputedStyle(cell);
	const contentHeight = cell.firstElementChild.getBoundingClientRect().height;
	const padding =
		(parseFloat(style.paddingTop) || 0) +
		(parseFloat(style.paddingBottom) || 0);

	return Math.max(parseFloat(style.minHeight) || 0, contentHeight + padding);
}

export function initProductSpecs(el) {
	const section = el.closest(".product-specs");
	const columns = [
		...section.querySelectorAll(".product-specs__labels, .swiper-slide"),
	];
	const rows = columns.map((column) => [
		...column.querySelectorAll(".product-specs__col-title, .product-specs__cell"),
	]);

	let frame = 0;
	let destroyed = false;

	const syncRows = () => {
		frame = 0;
		if (destroyed) return;

		const tableWidth =
			el.getBoundingClientRect().right -
			rows[0][0].getBoundingClientRect().left;

		if (tableWidth > 0) {
			section.style.setProperty("--spec-table-width", `${tableWidth}px`);
		}

		const heights = rows[0].map((_, index) => {
			const maxHeight = Math.max(
				...rows.map((column) => measureCellHeight(column[index])),
			);
			return Math.ceil(maxHeight);
		});

		rows.forEach((column) => {
			column.forEach((cell, index) => {
				const height = `${heights[index]}px`;
				if (cell.style.height !== height) {
					cell.style.height = height;
				}
			});
		});
	};

	const schedule = () => {
		if (!frame && !destroyed) {
			frame = requestAnimationFrame(syncRows);
		}
	};

	const observer =
		typeof ResizeObserver !== "undefined"
			? new ResizeObserver(schedule)
			: null;

	// Observe content nodes so setting row height cannot loop via ResizeObserver.
	rows.flat().forEach((cell) => {
		observer?.observe(cell.firstElementChild);
	});

	window.addEventListener("resize", schedule);
	document.fonts?.ready.then(schedule);

	const swiper = new Swiper(el, {
		watchOverflow: true,
		slidesPerView: "auto",
		spaceBetween: 14,
		speed: 100,
		allowTouchMove: true,
		// Trailing space so the last machine can reach the left edge.
		slidesOffsetAfter() {
			const slide = el.querySelector(".swiper-slide");
			return Math.max(0, this.size - slide.getBoundingClientRect().width);
		},
		breakpoints: {
			767.98: {
				spaceBetween: 24,
			},
		},
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
