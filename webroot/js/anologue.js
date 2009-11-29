var anologue = {
	_config: {
		id: 0,
		base : null,
		line: 0,
		icon: null
	},

	setup: function(config) {
		this._config = config;
		$("#anologue-form").submit(function() {
			anologue.say();
			return false;
		});
		$("#anologue-submit").click(function(e) {
			anologue.say();
			return false;
		});
		this.markdown();
		this.listener();
		$(".anologue-speak").css("bottom", '-200px').animate({ bottom: 0, opacity: 100}, 3000);
		$("#anologue-author").focus();
	},

	//the set time out method
	timeout: null,

	//setup the listener on a timeout
	run: function () {
		clearTimeout(this.timeout);
		this.timeout = setTimeout(function() {
			anologue.listener();
		}, 2000);
	},

	//get messages
	listener: function() {
		var url = this._config.base + '/' + this._config.id + '.json?_=' + (new Date().getTime());
		$.getJSON(url, function(response) {
			if (response.status != "success") {
				return anologue.alert(response.status);
			}
			if (response.data.messages != null) {
				for (var i = anologue._config.line; i < response.data.messages.length; i++) {
					anologue.render(response.data.messages[i]);
					anologue._config.line++;
				}
				anologue.markdown();
				anologue.run();
			}
		});
	},

	//add message
	say: function() {
		clearTimeout(this.timeout);
		var data = {
			author: $('#anologue-author').val(),
			email: $('#anologue-email').val(),
			text: $('#anologue-text').val()
		}
		if (data.author == '') {
			data.author = 'anonymous';
		}
		var input = $("#anologue-text").val();
		$("#anologue-text").val("");
		$.post(this._config.base + "/say/" + this._config.id, data, function(response) {
			if (response.status != 'success') {
				$("#anologue-text").val(input);
				// this might occur if someone sends an update at the same time...
				anologue.alert('Hold your horses, Spammy McSpamsky. Wait until your last message goes through and try sending your message again.');
			}
			anologue.listener();
		}, "json");

	},

	//output messages
	render: function(message) {
		var timeroo = new Date();
		var timestamp = timeroo.getHours() + ':' + timeroo.getMinutes() + ':' + timeroo.getSeconds();
		var id = 'message-' + $.md5(message.timestamp + message.author);
		var html = '<li class="message" id="' + id + '" style="display:none;"><ul class="data"><li class="time">' + timestamp + '</li><li class="ip">' + message.ip + '</li><li class="author"><img class="gravatar" src="http://gravatar.com/avatar/' + message.email + '?s=16&d=' + this._config.icon + '" border="0" /> <span title="' + $('<div/>').text(message.author).html() + '">&laquo; ' + $('<div/>').text(message.author).html() + ' &raquo;</span> </li><li class="text"><div class="markdown">' + $('<div/>').text(message.text).html() + '</div></li></ul></li>';
		$("#anologue").append(html);
		var soundDisabled = $('#anologue-sound:checked').val();
		if (!soundDisabled) {
			// lazy check to not trigger sound on your message
			var user = $('#anologue-author').val();
			if (message.author != user && user != '') {
				var userRegex = new RegExp(user.toLowerCase(), 'i');
				if (userRegex.test(message.text)) {
					this.hey();
				}
			}
		}
		$('#'+id).animate({
			opacity: 'show',
			height: 'show',
		}, 3000);
		var scrollDisabled = $('#anologue-scroll:checked').val();
		if (!scrollDisabled) {
			$('html, body').animate({
				scrollTop: $('#'+id).offset().top
			}, 'normal');
		}
	},

	setupSpeaker: function() {
		if (!$.browser.msie) {
			var speaker = $("#anologue-speaker");
			speaker.attr('controls', false);
			speaker.attr('autobuffer', true);
			var tape = this._config.base + '/media/hey.mp3';
			if ($.browser.mozilla) {
				tape = this._config.base + '/media/hey.ogg';
			}
			speaker.attr('src', tape);
			this.hey();
		} else {
			$('.sound').hide();
		}
	},

	hey: function() {
		if (!$.browser.msie) {
			$('#anologue-speaker').get(0).play();
		}
	},

	alert: function(message) {
		alert(message);
		return null;
	},

	markdown: function() {
		$('.markdown').each(function() {
			if (!$(this).hasClass('marked')) {
				var showdown = new Showdown.converter();
				var text = showdown.makeHtml($(this).html());
				$(this).html(text).addClass('marked');
			}
		});
	}
}
