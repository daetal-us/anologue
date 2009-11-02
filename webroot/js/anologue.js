var anologue = {
	_config: {
		timeout: null,
		line: 0,
		anologue: {},
		converter: {},
		lastInput: null
	},
	
	setup: function(config) {
		this._config = config;
		this._config.converter = new Showdown.converter();
		$("#anologue-form").submit(function() {
			anologue.say();
			return false;
		});
		$("#anologue-text").keypress(function(e) {
			if (e.which == 13) {
				anologue.say();
				return false;
			}
		});
		this.markdown();
		this.listener();
		this.setupSpeaker();
		$("#anologue-author").focus();
	},
	
	listener: function() {
		$.getJSON('/json/' + this._config.anologue._id + '?_='+(new Date().getTime()), null, function(response) {
			if (response.status != "success") {
				return anologue.alert(response.status);
			}
			anologue._config.anologue  = response.data.anologue;
			if (response.data.anologue.messages != null) {
				for (var i = anologue._config.line; i < response.data.anologue.messages.length; i++) {
					anologue.push(response.data.anologue.messages[i]);
					anologue._config.line++;
				}
				anologue.markdown();
			}
			anologue._config.timeout = setTimeout(function() { anologue.listener(); }, 2000);
		});
	},
	
	say: function() {
		var data = {
			author: $('#anologue-author').val(),
			email: $('#anologue-email').val(),
			text: $('#anologue-text').val()
		}
		if (data.author == '') {
			data.author = 'anonymous';
		}
		this._config.lastInput = $("#anologue-text").val();
		$("#anologue-text").val("");
		clearTimeout(this._config.timeout);
		$.post("/say/" + this._config.anologue._id, data, function(response) {
			
			if (response.status != 'success') {
				$("#anologue-text").val(anologue._config.lastInput);
				// this might occur if someone sends an update at the same time...
				anologue.alert('Hold your horses, Spammy McSpamsky. Wait until your last message goes through and try sending your message again.');
			}
			anologue.listener();
		}, "json");
	},
	
	push: function(message) {
		var timeroo = new Date();
		var timestamp = timeroo.getHours() + ':' + timeroo.getMinutes() + ':' + timeroo.getSeconds();
		var id = 'message-' + $.md5(message.timestamp + message.author);
		var html = '<li class="message" id="' + id + '" style="display:none;"><ul class="data"><li class="time">' + timestamp + '</li><li class="ip">' + message.ip + '</li><li class="author"><img class="gravatar" src="http://gravatar.com/avatar/' + message.email + '?s=16&d=http://anologue.li3/img/anonymous.png" border="0" /> &laquo; ' + $('<div/>').text(message.author).html() + ' &raquo; </li><li class="text"><div class="markdown">' + $('<div/>').text(message.text).html() + '</div></li></ul></li>';
		$("#anologue").append(html);
		var soundDisabled = $('#anologue-sound:checked').val();
		if (!soundDisabled) {
			// lazy check to not trigger sound on your message
			var user = $('#anologue-author').val();
			if (message.author != user) {
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
			var tape = '/media/hey.mp3';
			if ($.browser.mozilla) {
				tape = '/media/hey.ogg';
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
				var text = anologue._config.converter.makeHtml($(this).html());
				$(this).html(text).addClass('marked');
			}
		});
	}
}
