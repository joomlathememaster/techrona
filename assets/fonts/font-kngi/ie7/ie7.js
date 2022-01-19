/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'techrona\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-paper-plane2': '&#xe916;',
		'icon-chevron-right': '&#xe914;',
		'icon-play': '&#xe913;',
		'icon-angle-double-right': '&#xe912;',
		'icon-pinterest': '&#xe911;',
		'icon-linkedin': '&#xe910;',
		'icon-instagram': '&#xe90f;',
		'icon-twitter': '&#xe90e;',
		'icon-facebook': '&#xe90d;',
		'icon-cloud': '&#xe915;',
		'icon-cyber-security': '&#xe917;',
		'icon-data-storage': '&#xe918;',
		'icon-pie-chart': '&#xe919;',
		'icon-machine-learning': '&#xe91a;',
		'icon-consulting': '&#xe91b;',
		'icon-user': '&#xe90a;',
		'icon-comments': '&#xe90b;',
		'icon-eye': '&#xe90c;',
		'icon-calendar': '&#xe909;',
		'icon-search1': '&#xe908;',
		'icon-map-marker': '&#xe907;',
		'icon-volume-control-phone': '&#xe901;',
		'icon-caret-down': '&#xe900;',
		'icon-full-screen': '&#xe91c;',
		'icon-paper-plane': '&#xe906;',
		'icon-email': '&#xe904;',
		'icon-phone-mes': '&#xe905;',
		'icon-shopping-bag': '&#xe903;',
		'icon-search': '&#xe902;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
