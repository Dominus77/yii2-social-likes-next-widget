'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _deepmerge = require('deepmerge');

var _deepmerge2 = _interopRequireDefault(_deepmerge);

var _config = require('./config');

var _util = require('./util');

var _services = require('./services');

var baseServices = _interopRequireWildcard(_services);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// Merge base services with user services
var services = window.socialLikesButtons ? (0, _deepmerge2.default)(baseServices, window.socialLikesButtons) : baseServices;

/**
 * A button.
 *
 * @param {HTMLElement} widget
 * @param {Object} options
 */

var Button = function () {
	function Button(widget, options) {
		_classCallCheck(this, Button);

		this.widget = widget;
		this.data = (0, _util.dataset)(widget);
		this.options = (0, _deepmerge2.default)(options, this.data);

		this.initService();
		if (this.service) {
			this.initHtml();
			this.initEvents();
		}
		if (!this.service && process.env.NODE_ENV === 'development') {
			/* eslint-disable no-console */
			console.error('Social Likes: service for widget "' + (widget.className || this.options.service) + '" not found.');
			/* eslint-enable no-console */
		}
	}

	/**
  * Update options.
  *
  * @param {Object} options New options.
  */


	_createClass(Button, [{
		key: 'update',
		value: function update(options) {
			this.options = (0, _deepmerge2.default)(this.options, options);
		}

		/**
   * Read service name and apply its options.
   * Service can be a class on the widget (.facebook) or `service` option.
   */

	}, {
		key: 'initService',
		value: function initService() {
			var service = this.options.service;
			if (!service) {
				// class="facebook"
				service = (0, _util.toArray)(this.widget.classList).reduce(function (_, cls) {
					if (services[cls]) {
						return cls;
					}
				}, null);
				if (!service) {
					return;
				}
			}
			this.service = service;
			if (services[service]) {
				this.options = (0, _deepmerge2.default)(this.options, services[service]);
			} else {
				this.service = null;
			}
		}

		/**
   * Initialize markup of a button.
   */

	}, {
		key: 'initHtml',
		value: function initHtml() {
			var _this = this;

			var cx = function cx(name) {
				return (0, _util.className)(name, _this.service);
			};
			var widget = this.widget;
			var options = this.options;

			// Remove existing class (.facebook) with a proper one
			widget.classList.remove(this.service);
			cx('widget').split(' ').forEach(function (cls) {
				return widget.classList.add(cls);
			});

			// Button:
			// 1. Normal button with <button> tag.
			// 2. Link <a> if the service has the clickUrl option.
			// 3. Link <a> with .social-likes__invisible-button class if has clickUrl option but widget markup has no text.
			// 4. No button if there’s no text in the markup and no clickUrl option.
			var buttonHtml = '';
			var oldHtml = widget.innerHTML.trim();
			if (options.clickUrl || oldHtml) {
				var buttonTag = 'div';
				var buttonHref = '';
				var buttonClasses = cx('button');
				if (options.clickUrl) {
					var url = this.makeUrl(options.clickUrl);
					buttonTag = 'a';
					buttonHref = 'href="' + url + '"';
					if (!oldHtml) {
						buttonClasses = cx('invisible-button');
					}
				}
				buttonHtml = '\n\t\t\t\t<' + buttonTag + ' ' + buttonHref + ' class="' + buttonClasses + '">\n\t\t\t\t\t' + oldHtml + '\n\t\t\t\t</' + buttonTag + '>\n\t\t\t';
			} else {
				widget.classList.add((0, _util.className)('widget_notext'));
			}

			// Icon
			var svgHtml = (0, _util.svg)(this.options.icon, cx('icon'));

			widget.innerHTML = svgHtml + buttonHtml;
		}

		/**
   * Attach event handlers.
   */

	}, {
		key: 'initEvents',
		value: function initEvents() {
			if (!this.options.clickUrl) {
				this.widget.addEventListener('click', this.onClick.bind(this));
				this.widget.addEventListener('keydown', this.onKeyDown.bind(this));
				this.widget.setAttribute('tabindex', '0');
				this.widget.setAttribute('role', 'button');
			}
		}

		/**
   * Replace URL and title in an URL template.
   *
   * @param {string} urlTemplate URL template.
   * @return {string}
   */

	}, {
		key: 'makeUrl',
		value: function makeUrl(urlTemplate) {
			return (0, _util.makeUrl)(urlTemplate, {
				url: this.options.url,
				title: this.options.title
			});
		}
	}, {
		key: 'makeUrlWithParams',
		value: function makeUrlWithParams(urlTemplate) {
			var url = this.makeUrl(urlTemplate);
			var params = (0, _deepmerge2.default)(this.data, this.options.data || {});
			return (0, _util.addParamsToUrl)(url, params, ['service', 'title', 'url']);
		}

		/**
   * Button click handler.
   *
   * @param {Event} event Event.
   */

	}, {
		key: 'onClick',
		value: function onClick(event) {
			var options = this.options;
			var ok = true;
			if (typeof options.click === 'function') {
				ok = options.click.call(this, event);
			}
			if (ok) {
				var url = this.makeUrlWithParams(options.popupUrl);
				(0, _util.openPopup)(url, {
					width: options.popupWidth,
					height: options.popupHeight,
					name: _config.prefix + '_' + this.service
				});
			}
		}
	}, {
		key: 'onKeyDown',
		value: function onKeyDown(event) {
			if (event.which === 13 || event.which === 32) {
				event.preventDefault();
				this.onClick(event);
			}
		}
	}]);

	return Button;
}();

exports.default = Button;