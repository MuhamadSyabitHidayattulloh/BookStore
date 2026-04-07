import './bootstrap';

const initAutoHideNavigation = () => {
	const headers = Array.from(document.querySelectorAll('.js-auto-hide-header'));
	const bottoms = Array.from(document.querySelectorAll('.js-auto-hide-bottom'));

	if (!headers.length && !bottoms.length) {
		return;
	}

	let lastScrollY = window.scrollY || 0;
	let idleTimer;

	const showNavigation = () => {
		headers.forEach((el) => el.classList.remove('auto-hide-header-hidden'));
		bottoms.forEach((el) => el.classList.remove('auto-hide-bottom-hidden'));
	};

	const hideNavigation = () => {
		headers.forEach((el) => el.classList.add('auto-hide-header-hidden'));
		bottoms.forEach((el) => el.classList.add('auto-hide-bottom-hidden'));
	};

	window.addEventListener(
		'scroll',
		() => {
			const currentY = window.scrollY || 0;
			const delta = currentY - lastScrollY;

			if (Math.abs(delta) < 6) {
				return;
			}

			if (currentY < 40 || delta < 0) {
				showNavigation();
			} else if (currentY > 80 && delta > 0) {
				hideNavigation();
			}

			lastScrollY = currentY;

			window.clearTimeout(idleTimer);
			idleTimer = window.setTimeout(() => {
				showNavigation();
			}, 800);
		},
		{ passive: true }
	);
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initAutoHideNavigation);
} else {
	initAutoHideNavigation();
}
