/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

var Anologue = {
	/**
	 * Local container for the current document dataset
	 *
	 * @type Object
	 */
	db: {},

	/**
	 * Default Config
	 *  - `id`: id of the current anologue
	 *  - `seq`: current sequence to limit _changes requests by
	 *  - `base`: regular domain name of the application. (i.e. `localhost`, `Anologue.com`)
	 *  - `line`: last message rendered
	 *  - `icon`: default gravatar image url
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

		var self = this;
		$('img.gravatar').error(function () {
			$(this).unbind("error").attr("src", self._config.icon);
		});

		return this;
	},

	start: function(config) {
		this.config(config);
		this.toolbar.init();
		this.input.init();
		this.sound.init();
		this.time.init();
		this.markdown();
		this.ping.init();
		this.poll();
		return this;
	},

	toolbar: {
		init: function() {
			$('command.viewers').toggle(
				function() {
					$('#viewers').hide();
					$(this).removeClass('on');
				},
				function() {
					$(this).addClass('on');
					$('#viewers').show();
				}
			);

			$('command.user-settings').toggle(
				function() {
					$('#user-settings').hide();
					$(this).removeClass('on');
				},
				function() {
					$(this).addClass('on');
					$('#user-settings').show();
				}
			)
			$('#user-settings command').click(function() {
				Anologue.setOption(this);
			});
			$(window).focusin(function() {
				Anologue.title.reset();
			});
		}
	},

	input: {
		/**
		 * Setup the textarea input and related events
		 */
		init: function() {
			$(document).keyup(function(key) {
				if (key.which == 16) {
					Anologue.shiftDown = false;
				}
			});
			$(document).keydown(function(key) {
				if (key.which == 16) {
					Anologue.shiftDown = true;
				}
			});
			$("footer .message").keypress(function(key) {
				if (key.which == 13) {
					if (!Anologue.shiftDown) {
						Anologue.say($(this).val());
						return false;
					}
				}
			});
			$('#user-settings input').change(function() {
				Anologue.ping.send();
			});
			$('footer .message').focus();
		}
	},

	poll: function() {
		var url = this._config.base
				+ '/changes/' + this._config.id + '?since=' + this._config.seq;
		$.getJSON(url, function(response) {
			if (response.status != "success") {
				Anologue.poll();
				return Anologue.log(response.status);
			}
			if (response.data.changes.length > 0) {
				if (response.data.changes[0].rev != Anologue.db.rev) {
					Anologue.update();
				}
			}
			Anologue._config.seq = response.data.seq;
			Anologue.poll();
		});
	},

	ping: {
		timeout: null,
		init: function() {
			this.send();
		},
		send: function() {
			clearTimeout(this.timeout);
			$.post(Anologue._config.base + '/ping/' + Anologue._config.id, Anologue.user());
			this.timeout = setTimeout(function() {
				Anologue.ping.send();
			}, 90000);
		},
	},

	update: function() {
		var url = this._config.base + '/' + this._config.id + '.json?_=' + (new Date().getTime());
		$.getJSON(url, function(response) {
			if (response.status != "success") {
				return Anologue.log(response.status);
			}
			Anologue.db = response.data;
			if (Anologue.db.messages != null) {
				for (var i = Anologue._config.line; i < Anologue.db.messages.length; i++) {
					Anologue.render(Anologue.db.messages[i]);
					Anologue._config.line++;
				}
			}

			var viewers = $.makeArray(Anologue.db.viewers);
			$('#viewers ul').html('');
			$.each(Anologue.db.viewers, function(k, v) {
				$('#viewers ul').append(Anologue.viewer(v));
			});
			var sorted = $('#viewers ul li').sort(function(a,b) {
				var a = $(a).attr('data-name');
				var b = $(b).attr('data-name');
				return (a < b) ? -1 : (a > b) ? 1 : 0;
			});
			$('#viewers ul').html(sorted);

			Anologue.markdown();
		});
	},

	viewer: function(viewer) {
		var content = $('<div/>'),
			name = $('<div/>').text(viewer.name).html(),
		    now = new Date(),
		    cutoff = now.getTime() - 60000,
		    date = new Date(viewer.timestamp * 1000),
		    classes = ['viewer'];

		if (date < cutoff) {
			classes.push('away');
		}

		var img = $('<img/>'),
		    source = this._config.icon;

		if (viewer.email) {
			source = 'http://gravatar.com/avatar/'+ $('<div/>').text(viewer.email).html() +'?s=64&d=404';
		}

		img.attr({src: source, title: name})
			.addClass('gravatar')
			.appendTo(content);

		if (name == 'anonymous') {
			classes.push('anonymous');
		}

		content.append('<span>' + name + '</span>');

		return '<li class="' + classes.join(' ') + '" data-name="' + $('<div/>').text(viewer.name).html() + '">' 
		       + content.html() 
		       + '</li>';
	},

	render: function(message) {
		var id = 'message-' + $.md5(message.timestamp + message.name),
		    date = new Date(message.timestamp * 1000),
		    template = $('.message.template').clone();

		template.attr('id', id);
		template.find('.ip')
			.text(message.ip);
		template.find('time')
			.attr('datetime', this.time.iso(date));
		template.find('time span')
			.attr("data-timestamp", message.timestamp);
		template.find('.gravatar')
			.attr('src', 'http://gravatar.com/avatar/'+$('<div/>').text(message.email).html()+'?s=64&d='+this._config.icon);
		template.find('.author')
			.html($('<div/>').text(message.name).html());
		template.find('.text')
			.html('<pre>' + $('<div/>').text(message.text).html() + '</pre>')
			.addClass('markdown');

		template
			.removeClass('template')
			.hide()
			.appendTo('#anologue')
			.fadeIn();

		var docTitle = message.name + ' posted a new message';

		var soundDisabled = this.getOption('#user-settings command.sound');

		var user = this.user();

		if (!soundDisabled) {
			// lazy check to not trigger sound on your message
			if (user.name != '' && message.name != user.name) {
				if (RegExp(user.toLowerCase(), 'i').test(message.text)) {
					this.sound.play();
					var docTitle = message.name + ' mentioned you in a new message';
				}
			}
		}

		if (message.name != user.name) {
			this.newMessages++;
			this.title.blink(this.newMessages + ' new message(s)');
		}

		if (this.getOption('#user-settings command.scroll')) {
			$('.messages').animate({
				scrollTop: $('.messages ul').height()
			}, 'normal');
		}
	},

	say: function(message) {
		
		if (message == '') {
			return false;
		}

		var data = $.extend(this.user(), {text: message}),
		    url = this._config.base + "/say/" + this._config.id;

		$('footer .message').val('');
		$.post(url, data, function(response) {
			if (response.status != 'success') {
				// this might occur if someone sends an update at the same time...
				return Anologue.log(response);
			}
		}, "json");
	},

	user: function() {
		return {
			name:      $('#user-settings .user.name').val(),
			email:     $('#user-settings .user.email').val(),
			url:       $('#user-settings .user.url').val(),
			scrolling: this.getOption('#user-settings command.scroll'),
			sounds:    this.getOption('#user-settings command.sound'),
			cookies:   this.getOption('#user-settings command.cookie')
		};
	},

	sound: {
		speaker: null,
		enabled: false,
		init: function() {
			if (!$.browser.msie) {
				var speaker = this.speaker = $("#anologue-speaker"),
				    source = Anologue._config.base + '/media/hey.mp3';

				if ($.browser.mozilla) {
					source = Anologue._config.base + '/media/hey.ogg';
				}

				speaker.attr({
					controls: false,
					autobuffer: true,
					src: source
				});
				this.enabled = true;
				this.play();
			} else {
				// no ie sound :(
				$('.sound').hide();
			}
		},

		play: function() {
			if (this.enabled && this.speaker.get(0)) {
				this.speaker.get(0).play();
			}
		},
	},

	log: function(msg) {
		console.log(msg);
		return true;
	},

	getOption: function(e) {
		return $(e).hasClass('on');
	},

	setOption: function(e) {
		$(e).toggleClass('on');
	},

	markdown: function() {
		var markdown = new Markdown.getSanitizingConverter().makeHtml;
		$('.markdown').each(function() {
			if (!$(this).hasClass('marked')) {
				var unmarked = $(this).children('pre').html(),
				    marked = markdown(unmarked);

				$(this).html(marked).addClass('marked');
				$(this).find("a").oembed(null, {
					embedMethod: 'auto',
					maxHeight: 425
				});
			}
		});
	},

	time: {
		timeout: null,
		init: function() {
			this.timer();
		},
		timer: function() {
			clearTimeout(this.timeout);
			this.humanize();
			this.timeout = setTimeout(function() {
				Anologue.time.timer();
			}, 15000);
		},
		humanize: function() {
			$('span.time').each(function() {
				var time = $(this).attr('data-timestamp'),
				    prettyTime = PrettyDate.convert(time);
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
			Anologue.newMessages = 0;
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
				Anologue.title.blink(msg);
			}, 2000);
		}
	},
}