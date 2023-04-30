/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
(function () {
	window.onload = () => {
		const mobile = document.getElementById('leoraw-button');
		const menu = document.getElementById('mobile-menu');

		if (mobile) {

			mobile.onclick = function () {
				console.log('mobile clicked')
				if (menu.style.display === 'flex') {
					menu.style.display = 'none';
				}
				else {
					menu.style.display = 'flex';
				}

			};
		}

	}
})();
