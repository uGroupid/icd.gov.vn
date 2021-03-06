/* global Handlebars, Gallery */
(function ($, OC, t, Gallery) {
	"use strict";

	var TEMPLATE =
		'{{#each crumbs}}' +
		'	<div class="crumb {{cssClass}}" data-dir="{{dir}}">' +
		'	{{#if link}}' +
		'		<a href="{{link}}">' +
		'		{{#if img}}' +
		'			{{#with img}}' +
		'			<img title="{{title}}" src="{{imageSrc}}">' +
		'			{{/with}}' +
		'		{{else}}' +
		'			{{name}}' +
		'		{{/if}}' +
		'		</a>' +
		'	{{else}}' +
		'		<span>{{name}}</span>' +
		'	{{/if}}' +
		'	</div>' +
		'{{/each}}';

	/**
	 * Breadcrumbs that represent the path to the current album
	 *
	 * @constructor
	 */
	var Breadcrumb = function () {
		this.breadcrumbsElement = $('#breadcrumbs');
	};

	Breadcrumb.prototype = {
		breadcrumbs: [],
		breadcrumbsElement: null,
		ellipsis: null,
		albumPath: null,
		availableWidth: 0,

		/**
		 * Initialises the breadcrumbs for the current album
		 *
		 * @param {string} albumPath
		 * @param {int} availableWidth
		 */
		init: function (albumPath, availableWidth) {
			this.albumPath = albumPath;
			this.availableWidth = availableWidth;
			this.breadcrumbs = [];
			if (!this._template) {
				this._template = Handlebars.compile(TEMPLATE);
			}
			this._build();
			this._resize(this.availableWidth);
		},

		/**
		 * Defines the maximum available width in which we can build the breadcrumb and resizes it
		 *
		 * @param {int} availableWidth
		 */
		setMaxWidth: function (availableWidth) {
			if (this.availableWidth > availableWidth || this.ellipsis.is(":visible")) {
				this.availableWidth = availableWidth;
				this._resize(this.availableWidth);
			}
		},

		/**
		 * Builds the breadcrumbs array
		 *
		 * @private
		 */
		_build: function () {
			var i, crumbs, name, path, currentAlbum;
			var albumName = $('#content').data('albumname');
			if (!albumName) {
				albumName = t('gallery', 'Gallery');
			}
			path = '';
			name = '';
			crumbs = this.albumPath.split('/');
			currentAlbum = crumbs.pop();

			// This adds the home button
			this._addHome(albumName, currentAlbum);
			// We always add a hidden ellipsis
			this._pushCrumb('...', '', null, 'ellipsis');

			if (currentAlbum) {
				// This builds the crumbs between home and the current folder
				var crumbsLength = crumbs.length;
				if (crumbsLength > 0) {
					// We add all albums to the breadcrumbs array
					for (i = 0; i < crumbsLength; i++) {
						if (crumbs[i]) {
							name = crumbs[i];
							if (path) {
								path += '/' + crumbs[i];
							} else {
								path += crumbs[i];
							}
							this._pushCrumb(name, path, null, '');
						}
					}
				}
				// We finally push the current folder
				this._pushCrumb(currentAlbum, '', null, 'last');
			}

			this._render();
		},

		/**
		 * Adds the Home button
		 *
		 * @param {string} albumName
		 * @param {string} currentAlbum
		 * @private
		 */
		_addHome: function (albumName, currentAlbum) {
			var crumbImg = {
				imageSrc: OC.imagePath('core', 'places/home'),
				title: albumName
			};
			var cssClass = 'home';
			if (!currentAlbum) {
				cssClass += ' last';
			}

			this._pushCrumb('', '', crumbImg, cssClass);
		},

		/**
		 * Pushes crumb objects to the breadcrumbs array
		 *
		 * @param {string} name
		 * @param {string|boolean} link
		 * @param {Object} img
		 * @param {string} cssClass
		 * @private
		 */
		_pushCrumb: function (name, link, img, cssClass) {
			this.breadcrumbs.push({
				name: name,
				dir: link,
				link: '#' + encodeURIComponent(link),
				img: img,
				cssClass: cssClass
			});
		},

		/**
		 * Renders the full breadcrumb based on crumbs we have collected
		 *
		 * @private
		 */
		_render: function () {
			this.breadcrumbsElement.children().remove();

			var breadcrumbs = this._template({
				crumbs: this.breadcrumbs
			});

			this.breadcrumbsElement.append(breadcrumbs);
		},

		/**
		 * Alters the breadcrumb to make it fit within the asked dimensions
		 *
		 * @param {int} availableWidth
		 *
		 * @private
		 */
		_resize: function (availableWidth) {
			var crumbs = this.breadcrumbsElement.children();
			var shorten = false;
			var ellipsisPath = '';
			var self = this;

			// Hide everything first, so that we can check the width after adding each crumb
			crumbs.hide();

			// We go through the array in reverse order
			var crumbsElement = crumbs.get().reverse();
			$(crumbsElement).each(function () {
				if ($(this).hasClass('home')) {
					$(this).show();
					return;
				}
				if ($(this).hasClass('ellipsis')) {
					self.ellipsis = $(this);
					return;
				}
				if (!shorten) {
					$(this).show();
				}

				// If we've reached the maximum width, we start hiding crumbs
				if (self.breadcrumbsElement.width() > availableWidth) {
					shorten = true;
					$(this).hide();
					ellipsisPath = $(this).data('dir');
				}
			});

			// If we had to hide crumbs, we add a way to go to the parent folder
			if (shorten) {
				this.ellipsis.show();

				if (!ellipsisPath) {
					ellipsisPath = OC.dirname(this.albumPath);
				}

				this.ellipsis.children('a').attr('href', '#' + encodeURIComponent(ellipsisPath));
				this.ellipsis.attr('data-original-title', ellipsisPath).tooltip({
					fade: true,
					placement: 'bottom',
					delay: {
						hide: 5
					}
				});
			}
		}
	};

	Gallery.Breadcrumb = Breadcrumb;
})(jQuery, OC, t, Gallery);
