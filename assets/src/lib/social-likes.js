'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _deepmerge = require('deepmerge');

var _deepmerge2 = _interopRequireDefault(_deepmerge);

var _button = require('./button');

var _button2 = _interopRequireDefault(_button);

var _util = require('./util');

var _config = require('./config');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// Default options
var defaults = {
	url: window.location.href.replace(window.location.hash, ''),
	title: document.title
};

/**
 * Social Likes.
 *
 * @param {HTMLElement} container HTML container element.
 * @param {Object} [options] Options.
 */

var SocialLikes = function () {
	function SocialLikes(container) {
		var options = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];

		_classCallCheck(this, SocialLikes);

		container.classList.add(_config.prefix);

		// Options: default < constructor < container data-attributes
		options = (0, _deepmerge2.default)((0, _deepmerge2.default)(defaults, options), (0, _util.dataset)(container));
		this.url = options.url;

		this.buttons = (0, _util.toArray)(container.children).map(function (elem) {
			return new _button2.default(elem, options);
		});

		container.classList.add(_config.prefix + '_visible');
	}

	/**
  * Update options.
  *
  * @param {Object} options New options.
  */


	_createClass(SocialLikes, [{
		key: 'update',
		value: function update(options) {
			if (options.url === this.url) {
				return;
			}

			// Update each button
			this.buttons.forEach(function (button) {
				return button.update(options);
			});
		}
	}]);

	return SocialLikes;
}();

exports.default = SocialLikes;