/**
 * Cookie consent banner: default / manage panels, consent cookie, reload for PHP metrics.
 */

const MAX_AGE = 60 * 60 * 24 * 183;

const ALL_ON = {
	v: 1,
	necessary: true,
	functional: true,
	performance: true,
	targeting: true,
};

export class CookieNotice {
	constructor(el) {
		this.root = el;
		this.cookieName = el.dataset.cookieName || "ntronica_cookie_consent";
		this.defaultPanel = el.querySelector(".cookie-notice__panel--default");
		this.managePanel = el.querySelector(".cookie-notice__panel--manage");
		this.manageBtn = el.querySelector("[data-cookie-manage]");
		this.acceptBtn = el.querySelector("[data-cookie-accept]");
		this.confirmBtn = el.querySelector("[data-cookie-confirm]");
		this.closeBtn = el.querySelector("[data-cookie-close]");
		this.inputs = el.querySelectorAll("[data-cookie-category]");
		this.settingsLinks = document.querySelectorAll(
			"[data-cookie-settings]",
		);
		this.titleId = "cookie-notice-title";

		this.onKeydown = this.onKeydown.bind(this);
		this.syncDock = this.syncDock.bind(this);
		this.mqWide = window.matchMedia("(min-width: 767.98px)");

		this.manageBtn?.addEventListener("click", () => this.openManage());
		this.acceptBtn?.addEventListener("click", () => this.acceptAll());
		this.confirmBtn?.addEventListener("click", () => this.confirm());
		this.closeBtn?.addEventListener("click", () => this.closeManage());
		this.mqWide.addEventListener("change", this.syncDock);

		this.settingsLinks.forEach((link) => {
			link.addEventListener("click", (event) => {
				event.preventDefault();
				this.openFromSettings();
			});
		});

		this.resizeObserver = new ResizeObserver(this.syncDock);
		this.resizeObserver.observe(this.root);
		this.syncDock();
	}

	readConsent() {
		const match = document.cookie.match(
			new RegExp(`(?:^|; )${this.cookieName}=([^;]*)`),
		);
		if (!match) return null;

		try {
			const data = JSON.parse(decodeURIComponent(match[1]));
			return data && typeof data === "object" ? data : null;
		} catch {
			return null;
		}
	}

	writeConsent(data) {
		const value = encodeURIComponent(JSON.stringify(data));
		const secure = location.protocol === "https:" ? "; Secure" : "";
		document.cookie = `${this.cookieName}=${value}; Path=/; Max-Age=${MAX_AGE}; SameSite=Lax${secure}`;
	}

	applyConsentToInputs(consent) {
		this.inputs.forEach((input) => {
			const key = input.dataset.cookieCategory;
			if (input.disabled) {
				input.checked = true;
				return;
			}
			input.checked = Boolean(consent && consent[key]);
		});
	}

	snapshot() {
		const data = {
			v: 1,
			necessary: true,
			functional: false,
			performance: false,
			targeting: false,
		};

		this.inputs.forEach((input) => {
			const key = input.dataset.cookieCategory;
			if (!key || key === "necessary") return;
			data[key] = input.checked;
		});

		return data;
	}

	save(data) {
		this.writeConsent(data);
		location.reload();
	}

	acceptAll() {
		this.save(ALL_ON);
	}

	confirm() {
		this.save(this.snapshot());
	}

	openManage() {
		this.root.hidden = false;
		this.root.classList.add("is-manage");
		if (this.defaultPanel) this.defaultPanel.hidden = true;
		if (this.managePanel) this.managePanel.hidden = false;
		this.root.setAttribute("aria-modal", "true");
		this.root.setAttribute("aria-labelledby", this.titleId);
		this.root.removeAttribute("aria-label");
		this.manageBtn?.setAttribute("aria-expanded", "true");
		if (!this.mqWide.matches) {
			document.body.classList.add("lock");
		}
		document.addEventListener("keydown", this.onKeydown);
		this.closeBtn?.focus();
		requestAnimationFrame(this.syncDock);
	}

	closeManage() {
		document.removeEventListener("keydown", this.onKeydown);
		document.body.classList.remove("lock");
		this.root.classList.remove("is-manage");
		this.root.setAttribute("aria-modal", "false");
		this.root.setAttribute("aria-label", "Cookie notice");
		this.root.removeAttribute("aria-labelledby");
		this.manageBtn?.setAttribute("aria-expanded", "false");

		if (this.readConsent()) {
			this.root.hidden = true;
			if (this.managePanel) this.managePanel.hidden = true;
			if (this.defaultPanel) this.defaultPanel.hidden = false;
			this.syncDock();
			return;
		}

		if (this.managePanel) this.managePanel.hidden = true;
		if (this.defaultPanel) this.defaultPanel.hidden = false;
		requestAnimationFrame(this.syncDock);
		this.manageBtn?.focus();
	}

	openFromSettings() {
		this.applyConsentToInputs(this.readConsent());
		this.openManage();
	}

	onKeydown(event) {
		if (event.key === "Escape") {
			this.closeManage();
		}
	}

	syncDock() {
		const visible = !this.root.hidden;
		const fullscreenManage =
			this.root.classList.contains("is-manage") && !this.mqWide.matches;

		if (!visible || fullscreenManage) {
			document.body.classList.remove("has-cookie-notice");
			document.body.style.removeProperty("--cookie-notice-height");
			return;
		}

		const height = Math.ceil(this.root.getBoundingClientRect().height);
		document.body.classList.add("has-cookie-notice");
		document.body.style.setProperty(
			"--cookie-notice-height",
			`${height}px`,
		);
	}
}
