var anologue = {
	/**
	 * Local container for the current document dataset
	 *
	 * @type Object
	 */
	db: {},

	/**
	 * Default Config
	 * 		- `id`: id of the current anologue
	 * 		- `seq`: current sequence to limit _changes requests by
	 * 		- `base`: regular domain name of the application. (i.e. `localhost`, `anologue.com`)
	 * 		- `line`: last message rendered
	 * 		- `icon`: default gravatar image url
	 *
	 * @type Object
	 */
	_config: {
		id: 0,
		seq: 0,
		base : null,
		line: 0,
		icon: null
	},

	/**
	 * New messages assumed not yet viewed
	 */
	newMessages: 0,

	/**
	 * Is shift currently pressed down?
	 *
	 * @todo move to _config?
	 * @type Boolean
	 */
	shiftDown: false,

	/**
	 * Configure Anologue by setting the database and merging all other options
	 *
	 * @param Object config merged into default config.
	 * @see this._config
	 */
	config: function(config) {
		if (config) {
			if (config.db) {
				this.db = config.db;
				config.db = undefined;
			}
			this._config = $.extend(this._config, config);
		}
		return this;
	},

	start: function(config) {
		this.config(config);
		this.overlay.setup();
		this.setupToolbars();
		this.setupInputs();
		this.sound.setup();
		this.update();
		this.time.setup();
		this.markdown();
		this.ping.run();
		this.poll();
		return this;
	},

	setupToolbars: function() {
		$('.command.viewers command').bind('click.overlay', function() {
			var overlay = $(this).attr('data-overlay');
			if ($(overlay).hasClass('on')) {
				anologue.overlay.hide(overlay, {left: '-100%'});
				$('.anologue').removeClass('display-viewers');
			} else {
				anologue.overlay.show(overlay, {left: 0});
				$('.anologue').addClass('display-viewers');
			}
		});
		$('.command.user-settings command, .command.markdown-help command').bind(
			'click.overlay',
			function() {
				var overlay = $(this).attr('data-overlay');
				anologue.overlay.toggle(overlay, {
					show: {bottom: 0},
					hide: {bottom: '-100%'}
				});
			}
		);
		$('#user-settings command').click(function() {
			var parent = $(this).parents('.command');
			anologue.setOption(parent);
		});
		$('.command.expand-text command').toggle(function() {
			$('.anologue').addClass('textarea');
			$('.footer textarea.message').focus();
		}, function() {
			$('.anologue').removeClass('textarea');
			$('.footer input.message').focus();
		});
		$('.command.customize command').bind('click.overlay', function() {
			var overlay = $(this).attr('data-overlay');
			anologue.overlay.toggle(overlay, {
				show: {top: 0},
				hide: {top: '-100%'}
			});
		});
		$('#oembed .close command').click(function() {
			anologue.overlay.hide('#oembed', {top: '-100%'});
			$('#oembed').removeClass('open');
		});
		$('body').focusin(function() {
			anologue.title.reset();
		});
		$('body').click(function() {
			anologue.title.reset();
		});
	},

	/**
	 * Setup the Input/Textarea message input and related events
	 */
	setupInputs: function() {
		$(document).keyup(function(key) {
			if (key.which == 16) {
				anologue.shiftDown = false;
			}
		});
		$(document).keydown(function(key) {
			if (key.which == 16) {
				anologue.shiftDown = true;
			}
		});
		$(".footer .message").keypress(function(key) {
			if (key.which == 13) {
				if (!anologue.shiftDown) {
					anologue.say($(this).val());
					return false;
				} else {
					if (!$('.anologue').hasClass('textarea')) {
						var pos = $('.footer input.message')[0].selectionStart,
							textarea = $('.footer textarea.message');
						$('.command.expand-text command').click();
						textarea.focus();
						textarea.val(textarea.val() + "\n");
						textarea[0].setSelectionRange(pos+1, pos+1);
					}
				}
			}
		});
		$('.footer textarea.message').keyup(function(key) {
			var e = $(this).attr('data-alternate');
			$(e).val($(this).val());
		});
		$('.footer input.message').keyup(function(key) {
			if (key.which != 91) {
				var e = $(this).attr('data-alternate');
				$(e).val($(this).val());
			}
		});
		$('#user-settings input').change(function() {
			anologue.ping.send();
		});

		$('.footer input.message').bind('paste', function(e) {
			if (e.originalEvent.clipboardData) {
				e.preventDefault();
				var pasteData = e.originalEvent.clipboardData.getData('text/plain');
				var value = pasteData;
				if ($(this).val() != '') {
					var current = $(this).val(),
						split = $(this)[0].selectionStart;
					var start = current.substr(0, split),
						end = current.substring(split);
					var value = start + value + end;
				}
				$('.footer .message').val(value);
				if (pasteData.match(/(\r|\n)+/)) {
					if (!$('.anologue').hasClass('textarea')) {
						$('.command.expand-text command').click();
						$('.footer textarea.message')[0].setSelectionRange(
							value.length, value.length
						);
					}
				}
			} else {
				$(this).keyup({which: 0});
			}
		});
	},

	poll: function() {
		var url = this._config.base
				+ '/changes/' + this._config.id + '?since=' + this._config.seq;
		$.getJSON(url, function(response) {
			if (response.status != "success") {
				anologue.poll();
				return anologue.alert(response.status);
			}
			if (response.data.changes.length > 0) {
				if (response.data.changes[0].rev != anologue.db.rev) {
					anologue.update();
				}
			}
			anologue._config.seq = response.data.seq;
			anologue.poll();
		});
	},

	ping: {
		timeout: null,
		run: function() {
			this.send();
		},
		send: function() {
			clearTimeout(this.timeout);
			$.post(anologue._config.base + '/ping/' + anologue._config.id, anologue.user());
			this.timeout = setTimeout(function() {
				anologue.ping.send();
			}, 90000);
		},
	},

	update: function() {
		var url = this._config.base + '/' + this._config.id + '.json?_=' + (new Date().getTime());
		$.getJSON(url, function(response) {
			if (response.status != "success") {
				return anologue.alert(response.status);
			}
			anologue.db = response.data;
			if (anologue.db.messages != null) {
				for (var i = anologue._config.line; i < anologue.db.messages.length; i++) {
					anologue.render(anologue.db.messages[i]);
					anologue._config.line++;
				}
				anologue.time.timer();
				anologue.markdown();
			}

			var viewers = $.makeArray(anologue.db.viewers);
			$('#viewers ul').html('');
			$.each(anologue.db.viewers, function(k, v) {
				$('#viewers ul').append(anologue.viewer(v));
			});
			var sorted = $('#viewers ul li').sort(function(a,b) {
				var a = $(a).attr('data-name');
				var b = $(b).attr('data-name');
				return (a < b) ? -1 : (a > b) ? 1 : 0;
			});
			$('#viewers ul').html(sorted);

			var count = $('#viewers ul li').length;
			$('#viewers .noun').text((count === 1) ? 'viewer' : 'viewers');
			$('#viewers .count').text(count);

		});
	},

	viewer: function(viewer) {
		var html, background;
		var cutoff = new Date();
		cutoff = cutoff.getTime() - 60000;
		var date = new Date(viewer.timestamp * 1000);

		var away = '';
		if (date < cutoff) {
			var away = ' away';
		}

		if (viewer.email) {
			background = 'style="background-image: url(http://gravatar.com/avatar/'+viewer.email+'?s=16&d='+this._config.icon+')"';
		}
		if (viewer.url) {
			html = '<a href="' + viewer.url + '"' + background + '>' + viewer.name + '</a>';
		} else {
			html = '<span ' + background + '>' + viewer.name + '</span>';
		}
		return '<li class="viewer' + away + '" data-name="' + viewer.name + '">' + html + '</li>';
	},

	render: function(message) {
		var id = 'message-' + $.md5(message.timestamp + message.name);
		var date = new Date(message.timestamp * 1000);

		var html =
			'<li class="message" id="'+id+'">'
				+ '<span class="meta">'
					+ '<span class="ip">'+message.ip+'</span>'
					+ '<time datetime="'+this.time.iso(date)+'">'
						+ '<span data-timestamp="'+message.timestamp+'" class="time"></span>'
					+ '</time>'
					+ '<span class="author gravatar" style="background-image:url(http://gravatar.com/avatar/'+message.email+'?s=20&d='+this._config.icon+');">'
						+ $('<div/>').text(message.name).html()
					+ '</span>'
					+ '<span class="separator">: </span>'
				+ '</span>'
				+ '<div class="text markdown">'
					+ '<pre>'+$('<div/>').text(message.text).html()+'</pre>'
				+ '</div>'
			+ '</li>';

		$("#anologue").append(html);

		var docTitle = message.name + ' posted a new message';

		var soundDisabled = this.getOption('#user-settings .command.sound');

		var user = this.user();

		if (!soundDisabled) {
			// lazy check to not trigger sound on your message
			if (user.name != '' && message.name != user.name) {
				var userRegex = new RegExp(user.toLowerCase(), 'i');
				if (userRegex.test(message.text)) {
					this.sound.play();
					var docTitle = message.name + ' mentioned you in a new message';
				}
			}
		}

		if (message.name != user.name) {
			this.newMessages++;
			this.title.blink(this.newMessages + ' new message(s)');
		}

		$('#'+id).animate({
			opacity: 'show'
		}, 650);
		var scrollEnabled = this.getOption('#user-settings .command.auto-scroll');
		if (scrollEnabled) {
			$('html, body').animate({
				scrollTop: $('#'+id).offset().top
			}, 'normal');
		}
	},

	say: function(message) {

		if (message == '') {
			return false;
		}

		var data = this.user();

		data.text = message;

		if (data.name == '') {
			data.name = 'anonymous';
		}

		if ($('.command.user-settings').hasClass('on')) {
			$('.command.user-settings command').click();
		}

		$('.footer .message').attr('disabled', 'disabled');
		$.post(this._config.base + "/say/" + this._config.id, data, function(response) {
			$('.footer .message').removeAttr('disabled');
			if (response.status != 'success') {
				// this might occur if someone sends an update at the same time...
				anologue.alert( 'Hold your horses, Spammy McSpamsky. Wait until your last message'
				 				+ 'goes through and try sending your message again.');
			} else {
				$('.footer .message').val('');
			}
		}, "json");
	},

	user: function() {
		return {
			name: $('#user-settings .user.name').val(),
			email: $('#user-settings .user.email').val(),
			url: $('#user-settings .user.url').val(),
			scrolling: this.getOption('#user-settings .command.auto-scroll'),
			sounds: this.getOption('#user-settings .command.sound'),
			cookies: this.getOption('#user-settings .command.cookie')
		};
	},

	sound: {
		setup: function() {
			if (!$.browser.msie) {
				var speaker = $("#anologue-speaker");
				speaker.attr('controls', false);
				speaker.attr('autobuffer', true);
				var tape = anologue._config.base + '/media/hey.mp3';
				if ($.browser.mozilla) {
					tape = anologue._config.base + '/media/hey.ogg';
				}
				speaker.attr('src', tape);
				this.play();
			} else {
				$('.sound').hide();
			}
		},

		play: function() {
			if (!$.browser.msie) {
				$('#anologue-speaker').get(0).play();
			}
		},
	},

	alert: function(msg) {
		console.log('error n stuff:');
		console.log(msg);
		// do something with the message
	},

	getOption: function(e) {
		return !$(e).hasClass('disabled');
	},

	setOption: function(e) {
		$(e).toggleClass('disabled');
	},

	markdown: function() {
		$('.markdown').each(function() {
			if (!$(this).hasClass('marked')) {
				var showdown = new Showdown.converter();
				var text = showdown.makeHtml($(this).children('pre').html());
				$(this).html(text).addClass('marked');
				$(this).find("a").oembed(null, {
					embedMethod: 'player',
					maxWidth: 425,
					maxHeight: 425
				});
			}
		});
	},

	overlay: {
		setup: function() {
			$('#markdown-help, #user-settings').css({bottom: '-100%'});
			$('#oembed').css({top: '-100%'});
			$('#viewers').css({left: '-100%'});
		},

		toggle: function(e, options) {
			options = $.extend({show: {}, hide: {}}, options);
			if ($(e).hasClass('on')) {
				this.hide(e, options.hide);
			} else {
				this.show(e, options.show);
			}
		},

		hide: function(e, options) {
			$(e).stop();
			$(e).animate(options, 250, function() {
				$(this).removeClass('on');
				$('.command.'+this.id).removeClass('on');
			});
		},

		show: function(e, options) {
			$(e).stop();
			$(e).animate(options, 250, function() {
				$(this).addClass('on');
				$('.command.'+this.id).addClass('on');
			});
		}
	},

	time: {
		timeout: null,
		setup: function() {
			this.timer();
		},
		timer: function() {
			clearTimeout(this.timeout);
			this.humanize();
			this.timeout = setTimeout(function() {
				anologue.time.timer();
			}, 15000);
		},
		humanize: function() {
			$('span.time').each(function() {
				var time = $(this).attr('data-timestamp');
				var prettyTime = PrettyDate.convert(time);
				$(this).text(prettyTime);
			});
		},
		iso: function(d) {
			function pad(n){
				return n<10 ? '0'+n : n;
			}
			return d.getUTCFullYear()+'-'
				+ pad(d.getUTCMonth()+1)+'-'
				+ pad(d.getUTCDate())+'T'
				+ pad(d.getUTCHours())+':'
				+ pad(d.getUTCMinutes())+':'
				+ pad(d.getUTCSeconds());
		}
	},

	title: {
		timeout: null,
		_default: 'anologue',
		reset: function() {
			clearTimeout(this.timeout);
			anologue.newMessages = 0;
			document.title = this._default;
		},

		update: function(msg) {
			document.title = msg;
		},

		get: function() {
			return document.title;
		},

		blink: function(msg) {
			clearTimeout(this.timeout);
			if (this.get() == msg) {
				this.update(this._default);
			} else {
				this.update(msg);
			}
			this.timeout = setTimeout(function() {
				anologue.title.blink(msg);
			}, 2000);
		}
	},
}