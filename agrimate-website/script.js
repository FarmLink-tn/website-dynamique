(function () {
    const body = document.body;
    const mobileMenu = document.getElementById('mobile-menu');
    const menuButton = document.getElementById('menu-btn');
    const languageSwitcher = document.getElementById('language-switcher');
    const themeToggle = document.getElementById('theme-toggle');
    const skipLink = document.querySelector('.skip-link');
    const contactForm = document.getElementById('contact-form');
    const contactFeedback = document.getElementById('contact-form-feedback');
    const contactSubmit = contactForm ? contactForm.querySelector('button[type="submit"]') : null;
    const csrfInput = contactForm ? contactForm.querySelector('input[name="csrf_token"]') : null;

    const STORAGE_THEME_KEY = 'fl-theme';

    function getPreferredTheme() {
        const stored = localStorage.getItem(STORAGE_THEME_KEY);
        if (stored === 'light' || stored === 'dark') {
            return stored;
        }
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        return systemPrefersDark ? 'dark' : 'light';
    }

    function applyTheme(theme) {
        body.dataset.theme = theme;
        if (themeToggle) {
            themeToggle.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
            themeToggle.classList.toggle('is-dark', theme === 'dark');
        }
    }

    function toggleTheme() {
        const current = body.dataset.theme || getPreferredTheme();
        const next = current === 'dark' ? 'light' : 'dark';
        localStorage.setItem(STORAGE_THEME_KEY, next);
        applyTheme(next);
    }

    function closeMobileMenu() {
        if (!mobileMenu || !menuButton) {
            return;
        }
        menuButton.setAttribute('aria-expanded', 'false');
        mobileMenu.classList.remove('is-open');
        body.classList.remove('menu-open');
    }

    function openMobileMenu() {
        if (!mobileMenu || !menuButton) {
            return;
        }
        menuButton.setAttribute('aria-expanded', 'true');
        mobileMenu.classList.add('is-open');
        body.classList.add('menu-open');
    }

    function toggleMobileMenu() {
        if (!mobileMenu || !menuButton) {
            return;
        }
        const isOpen = mobileMenu.classList.contains('is-open');
        if (isOpen) {
            closeMobileMenu();
        } else {
            openMobileMenu();
        }
    }

    function handleLanguageChange(event) {
        const select = event.currentTarget;
        const selected = select.options[select.selectedIndex];
        const href = selected.dataset.href;
        if (href) {
            window.location.href = href;
        }
    }

    function focusMainLandmark() {
        const main = document.getElementById('main-content');
        if (main) {
            main.setAttribute('tabindex', '-1');
            main.focus();
        }
    }

    function setSubmitting(isSubmitting) {
        if (!contactForm || !contactSubmit) {
            return;
        }
        contactSubmit.disabled = isSubmitting;
        contactSubmit.classList.toggle('is-loading', isSubmitting);
    }

    function showFeedback(message, type) {
        if (!contactFeedback) {
            return;
        }
        contactFeedback.textContent = message || '';
        contactFeedback.dataset.state = type || '';
    }

    function fetchCsrfToken() {
        return fetch('server/auth.php?action=check', { credentials: 'include' })
            .then((response) => response.ok ? response.json() : Promise.reject())
            .then((data) => {
                if (data && data.csrfToken && csrfInput) {
                    csrfInput.value = data.csrfToken;
                }
                return data ? data.csrfToken : null;
            })
            .catch(() => null);
    }

    function submitContactForm(event) {
        event.preventDefault();
        if (!contactForm) {
            return;
        }

        if (!contactForm.checkValidity()) {
            contactForm.reportValidity();
            return;
        }

        setSubmitting(true);
        showFeedback('', '');

        const submitRequest = (token) => {
            const formData = new FormData(contactForm);
            return fetch('server/contact.php', {
                method: 'POST',
                body: formData,
                headers: token ? { 'X-CSRF-Token': token } : {},
                credentials: 'include',
            });
        };

        const ensureToken = csrfInput && csrfInput.value ? Promise.resolve(csrfInput.value) : fetchCsrfToken();

        ensureToken
            .then(submitRequest)
            .then(async (response) => {
                if (response.status === 204) {
                    showFeedback('', 'success');
                    return;
                }
                const payload = await response.json().catch(() => ({}));
                if (response.ok && payload.success) {
                    contactForm.reset();
                    showFeedback(payload.message || contactForm.dataset.successMessage || '', 'success');
                } else {
                    showFeedback(payload.message || contactForm.dataset.errorMessage || '', 'error');
                }
            })
            .catch(() => {
                showFeedback(contactForm.dataset.errorMessage || '', 'error');
            })
            .finally(() => {
                setSubmitting(false);
            });
    }

    function init() {
        applyTheme(getPreferredTheme());

        if (themeToggle) {
            themeToggle.addEventListener('click', toggleTheme);
        }

        if (menuButton) {
            menuButton.addEventListener('click', toggleMobileMenu);
        }

        if (mobileMenu) {
            mobileMenu.querySelectorAll('a').forEach((link) => {
                link.addEventListener('click', closeMobileMenu);
            });
        }

        if (languageSwitcher) {
            languageSwitcher.addEventListener('change', handleLanguageChange);
        }

        if (skipLink) {
            skipLink.addEventListener('click', focusMainLandmark);
        }

        if (contactForm) {
            contactForm.addEventListener('submit', submitContactForm);
            if (contactForm.dataset.successMessage === undefined || contactForm.dataset.errorMessage === undefined) {
                contactForm.dataset.successMessage = contactForm.getAttribute('data-success-message') || '';
                contactForm.dataset.errorMessage = contactForm.getAttribute('data-error-message') || '';
            }
            if (csrfInput && !csrfInput.value) {
                fetchCsrfToken();
            }
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeMobileMenu();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
