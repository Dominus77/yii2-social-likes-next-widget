'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
exports.dataset = dataset;
exports.addParamsToUrl = addParamsToUrl;
exports.objectToQueryString = objectToQueryString;
exports.openPopup = openPopup;
exports.makeUrl = makeUrl;
exports.template = template;
exports.className = className;
exports.toArray = toArray;
exports.svg = svg;

var _config = require('./config');

/**
 * Return node.dataset as an object
 *
 * @param {Node} node DOM node.
 * @return {Object}
 */
function dataset(node) {
	var data = {};
	for (var key in node.dataset) {
		data[key] = node.dataset[key];
	}
	return data;
}

/**
 * Append params to the URL.
 *
 * @param {string} url Base URL.
 * @param {Object} params Params to append.
 * @param {string[]} [ignore] List of keys to ignore.
 * @return {string}
 */
function addParamsToUrl(url, params) {
	var ignore = arguments.length <= 2 || arguments[2] === undefined ? [] : arguments[2];

	params = objectToQueryString(params, ignore);
	if (!params) {
		return url;
	}

	var glue = url.indexOf('?') === -1 ? '?' : '&';
	return url + glue + params;
}

/**
 * Convert object to a query string: a=1&b=2.
 *
 * @param {Object} params Parameters.
 * @param {string[]} [ignore] List of keys to ignore.
 * @return {string}
 */
function objectToQueryString(params) {
	var ignore = arguments.length <= 1 || arguments[1] === undefined ? [] : arguments[1];

	return Object.keys(params).reduce(function (pairs, key) {
		var value = params[key];
		if (value !== null && value !== '' && ignore.indexOf(key) === -1) {
			pairs.push(key + '=' + encodeURIComponent(value));
		}
		return pairs;
	}, []).join('&');
}

/**
 * Open popup window.
 *
 * @param {String} url URL.
 * @param {Number} options.width Width.
 * @param {Number} options.height Height.
 * @param {String} options.name Window name.
 * @return {Object}
 */
function openPopup(url, _ref) {
	var width = _ref.width;
	var height = _ref.height;
	var name = _ref.name;

	var left = Math.round(screen.width / 2 - width / 2);
	var top = 0;
	if (screen.height > height) {
		top = Math.round(screen.height / 3 - height / 2);
	}

	var win = window.open(url, name, '\n\t\tleft=' + left + ',\n\t\ttop=' + top + ',\n\t\twidth=' + width + ',\n\t\theight=' + height + ',\n\t\tpersonalbar=0,\n\t\ttoolbar=0,\n\t\tscrollbars=1,\n\t\tresizable=1\n\t');
	if (win) {
		win.focus();
		return win;
	}
	location.href = url;
	return null;
}

/**
 * Template with encodeURIComponent for URLs.
 *
 * @param {String} url URL template.
 * @param {Object} context Replacements object.
 * @return {String}
 */
function makeUrl(url, context) {
	return template(url, context, encodeURIComponent);
}

/**
 * Simple template.
 *
 * @param {string} tmpl Template.
 * @param {Object} context Replacements object.
 * @param {Function} [filter] Value filter function.
 * @return {string}
 */
function template(tmpl, context, filter) {
	return tmpl.replace(/\{([^}]+)}/g, function (m, key) {
		var value = filter ? filter(context[key]) : context[key];
		return value || '';
	});
}

/**
 * Generate BEM class names for a block or element.
 * Block name is fixed to the ${prefix} value.
 *
 * @param {string} [elem] Element name.
 * @param {string} [mod] Modifier.
 * @return {string}
 */
function className(elem, mod) {
	var base = _config.prefix + (elem ? '' + _config.elemDelimiter + elem : '');
	return base + (mod ? ' ' + base + _config.modDelimiter + mod : '');
}

/**
 * Convert array like object to array.
 *
 * @param {Object} list Array like object.
 * @returns {Array}
 */
function toArray(list) {
	return Array.prototype.slice.call(list);
}

/**
 * Return SVG code of an icon.
 *
 * @param {string|string[]} paths SVG path of an icon.
 * @param {string} cls CSS class name.
 * @return {string}
 */
function svg(paths, cls) {
	if (!Array.isArray(paths)) {
		paths = [paths];
	}
	paths = paths.map(function (p) {
		return '<path d="' + p + '"/>';
	});
	return '\n\t\t<svg class="' + cls + '" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">\n\t\t\t' + paths.join('\n') + '\n\t\t</svg>\n\t';
}