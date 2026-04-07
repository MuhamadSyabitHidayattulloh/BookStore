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

const initLivewireToastBridge = () => {
	const container = document.getElementById('global-toast-container');

	if (!container) {
		return;
	}

	const styleByType = {
		success: {
			toast: 'toast-success',
			progress: 'toast-progress-success',
		},
		warning: {
			toast: 'toast-warning',
			progress: 'toast-progress-warning',
		},
		error: {
			toast: 'toast-error',
			progress: 'toast-progress-error',
		},
	};

	const timeoutByType = {
		success: 3200,
		warning: 3600,
		error: 3800,
	};

	window.addEventListener('toast', (event) => {
		const type = event.detail?.type ?? 'success';
		const message = event.detail?.message;

		if (!message) {
			return;
		}

		const toast = document.createElement('div');
		const scheme = styleByType[type] ?? styleByType.success;
		const duration = timeoutByType[type] ?? timeoutByType.success;
		toast.className = `toast-base ${scheme.toast} pointer-events-auto transition-opacity duration-300`;

		const messageNode = document.createElement('p');
		messageNode.textContent = message;
		toast.appendChild(messageNode);

		const progress = document.createElement('div');
		progress.className = `toast-progress ${scheme.progress}`;
		progress.style.animationDuration = `${duration}ms`;
		toast.appendChild(progress);

		container.appendChild(toast);

		window.setTimeout(() => {
			toast.classList.add('opacity-0');
			window.setTimeout(() => toast.remove(), 280);
		}, duration);
	});
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', () => {
		initAutoHideNavigation();
		initLivewireToastBridge();
	});
} else {
	initAutoHideNavigation();
	initLivewireToastBridge();
}
