/**
 * Load performance analytics after consent without a full page reload.
 * IDs come from wp_localize_script (`ntronicaAnalytics`).
 */

function config() {
	return typeof window.ntronicaAnalytics === "object" &&
		window.ntronicaAnalytics
		? window.ntronicaAnalytics
		: null;
}

function hasScript(src) {
	return Boolean(document.querySelector(`script[src="${src}"]`));
}

function appendScript(src, { async = true } = {}) {
	if (hasScript(src)) return null;
	const el = document.createElement("script");
	el.src = src;
	el.async = async;
	document.head.appendChild(el);
	return el;
}

function loadGtm(id) {
	if (!id || window.__ntronicaGtmLoaded) return;
	window.__ntronicaGtmLoaded = true;
	window.dataLayer = window.dataLayer || [];
	window.dataLayer.push({
		"gtm.start": new Date().getTime(),
		event: "gtm.js",
	});
	appendScript(
		`https://www.googletagmanager.com/gtm.js?id=${encodeURIComponent(id)}`,
	);
}

function loadGa(id) {
	if (!id || window.__ntronicaGaLoaded) return;
	window.__ntronicaGaLoaded = true;
	window.dataLayer = window.dataLayer || [];
	window.gtag =
		window.gtag ||
		function gtag() {
			window.dataLayer.push(arguments);
		};
	appendScript(
		`https://www.googletagmanager.com/gtag/js?id=${encodeURIComponent(id)}`,
	);
	window.gtag("js", new Date());
	window.gtag("config", id);
}

function loadYm(id) {
	if (!id || window.__ntronicaYmLoaded) return;
	window.__ntronicaYmLoaded = true;
	const counter = Number(id);
	if (!counter) return;

	window.ym =
		window.ym ||
		function ym() {
			(window.ym.a = window.ym.a || []).push(arguments);
		};
	window.ym.l = Date.now();
	appendScript("https://mc.yandex.ru/metrika/tag.js");
	window.ym(counter, "init", {
		clickmap: true,
		accurateTrackBounce: true,
		trackLinks: true,
	});
}

/**
 * @param {{ performance?: boolean }} consent
 */
export function applyAnalyticsConsent(consent) {
	if (!consent?.performance) return;

	const cfg = config();
	if (!cfg || cfg.performanceLoaded) return;

	loadGtm(cfg.gtm || "");
	loadGa(cfg.ga || "");
	loadYm(cfg.ym || "");
	cfg.performanceLoaded = true;
}
