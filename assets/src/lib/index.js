'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
exports.default = init;
exports.autoInit = autoInit;

var _config = require('./config');

var _util = require('./util');

var _socialLikes = require('./social-likes');

var _socialLikes2 = _interopRequireDefault(_socialLikes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// Symbol to store an instance reference in a DOM node
var symbol = 'socialLikes';

/**
 * Initialize or update Social Likes on a DOM element.
 *
 * @param {HTMLElement} elem DOM element.
 * @param {Object} [options] Options.
 * @return {SocialLikes}
 */
function init(elem) {
	var options = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];

	var instance = elem[symbol];
	if (instance) {
		instance.update(options);
	} else {
		instance = elem[symbol] = new _socialLikes2.default(elem, options);
	}
	return instance;
}

/**
 * Init Social Likes on all elements with class .social-likes.
 *
 * @param {boolean} wait Wait for DOM ready if no elements found.
 */
function autoInit() {
	var wait = arguments.length <= 0 || arguments[0] === undefined ? false : arguments[0];

	var elements = document.querySelectorAll('.' + _config.prefix);
	if (elements) {
		(0, _util.toArray)(elements).forEach(function (elem) {
			return init(elem);
		});
	} else if (wait) {
		// No elements found. Wait for DOM content loaded to try again in case the script was included in the <head>
		document.addEventListener('DOMContentLoaded', autoInit);
	}
}

// Auto initialization
autoInit(true);