// Popover
(function( $ ) {

	'use strict';

	if ( $.isFunction( $.fn['popover'] ) ) {
		$( '[data-toggle=popover]' ).popover();
	}

}).apply( this, [ jQuery ]);

// Tooltip
(function( $ ) {

	'use strict';

	if ( $.isFunction( $.fn['tooltip'] ) ) {
		$( '[data-toggle=tooltip],[rel=tooltip]' ).tooltip({ container: 'body' });
	}

}).apply( this, [ jQuery ]);

// Sidebar Widgets
(function( $ ) {

	'use strict';

	function expand( content ) {
		content.children( '.widget-content' ).slideDown( 'fast', function() {
			$(this).css( 'display', '' );
			content.removeClass( 'widget-collapsed' );
		});
	}

	function collapse( content ) {
		content.children('.widget-content' ).slideUp( 'fast', function() {
			content.addClass( 'widget-collapsed' );
			$(this).css( 'display', '' );
		});
	}

	var $widgets = $( '.sidebar-widget' );

	$widgets.each( function() {

		var $widget = $( this ),
			$toggler = $widget.find( '.widget-toggle' );

		$toggler.on('click.widget-toggler', function() {
			$widget.hasClass('widget-collapsed') ? expand($widget) : collapse($widget);
		});
	});

}).apply( this, [ jQuery ]);

// Codemirror
(function( $ ) {

	'use strict';

	if ( typeof CodeMirror !== 'undefined' ) {

		$(function() {
			$('[data-plugin-codemirror]').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginCodeMirror(opts);
			});
		});

	}

}).apply(this, [ jQuery ]);

// iosSwitcher
(function( $ ) {

	'use strict';

	if ( typeof Switch !== 'undefined' && $.isFunction( Switch ) ) {

		$(function() {
			$('[data-plugin-ios-switch]').each(function() {
				var $this = $( this );

				$this.themePluginIOS7Switch();
			});
		});

	}

}).apply(this, [ jQuery ]);



// MaxLength
(function( $ ) {

	'use strict';

	if ( $.isFunction( $.fn[ 'maxlength' ]) ) {

		$(function() {
			$('[data-plugin-maxlength]').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginMaxLength(opts);
			});
		});

	}

}).apply(this, [ jQuery ]);

// Select2
(function( $ ) {

	'use strict';

	if ( $.isFunction($.fn[ 'select2' ]) ) {

		$(function() {
			$('[data-plugin-selectTwo]').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginSelect2(opts);
			});
		});

	}

}).apply(this, [ jQuery ]);

// Animate
(function( $ ) {

	'use strict';

	if ( $.isFunction($.fn[ 'appear' ]) ) {

		$(function() {
			$('[data-plugin-animate], [data-appear-animation]').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginAnimate(opts);
			});
		});

	}

}).apply(this, [ jQuery ]);

// Portlets
(function( $ ) {

	'use strict';

	$(function() {
		$('[data-plugin-portlet]').each(function() {
			var $this = $( this ),
				opts = {};

			var pluginOptions = $this.data('plugin-options');
			if (pluginOptions)
				opts = pluginOptions;

			$this.themePluginPortlet(opts);
		});
	});

}).apply(this, [ jQuery ]);

// Toggle
(function( $ ) {

	'use strict';

	$(function() {
		$('[data-plugin-toggle]').each(function() {
			var $this = $( this ),
				opts = {};

			var pluginOptions = $this.data('plugin-options');
			if (pluginOptions)
				opts = pluginOptions;

			$this.themePluginToggle(opts);
		});
	});

}).apply(this, [ jQuery ]);

// Widget - Todo
(function( $ ) {

	'use strict';

	if ( $.isFunction($.fn[ 'themePluginWidgetTodoList' ]) ) {

		$(function() {
			$('[data-plugin-todo-list], ul.widget-todo-list').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginWidgetTodoList(opts);
			});
		});

	}

}).apply(this, [ jQuery ]);

// Widget - Toggle
(function( $ ) {

	'use strict';

	if ( $.isFunction($.fn[ 'themePluginWidgetToggleExpand' ]) ) {

		$(function() {
			$('[data-plugin-toggle-expand], .widget-toggle-expand').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginWidgetToggleExpand(opts);
			});
		});
	}

}).apply(this, [ jQuery ]);

// Word Rotate
(function( $ ) {

	'use strict';

	if ( $.isFunction($.fn[ 'themePluginWordRotate' ]) ) {

		$(function() {
			$('[data-plugin-word-rotate], .word-rotate:not(.manual)').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginWordRotate(opts);
			});
		});

	}

}).apply(this, [ jQuery ]);