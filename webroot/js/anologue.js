var anologue = {
	_config: {
		line: 0,
		anologue: {},
		converter: {}
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
		$('html, body').animate({
			scrollTop: $('.message:last-child').offset().top
		}, 'slow', 'swing');
		$("#anologue-text").focus();
	},
	
	listener: function() {
		$.getJSON('/json/' + this._config.anologue._id, {}, function(response) {
			if (response.status != "success") {
				return anologue.alert(response.status);
			}
			if (response.data.anologue != anologue._config.anologue) {
				anologue._config.anologue  = response.data.anologue;
				if (response.data.anologue.messages != null) {
					for (var i = anologue._config.line; i < response.data.anologue.messages.length; i++) {
						anologue.push(response.data.anologue.messages[i]);
						anologue._config.line++;
					}
					anologue.markdown();
				}
			}
			setTimeout(function() { anologue.listener(); }, 1000);
		});
	},
	
	say: function() {
		var data = {
			author: $('#anologue-author').val(),
			email: $('#anologue-email').val(),
			text: $('#anologue-text').val()
		}
		$("#anologue-text").val("");
		$.post("/say/" + this._config.anologue._id, data, function(response) {
			// nada
		});
	},
	
	push: function(message) {
		var timeroo = new Date();
		var timestamp = timeroo.getHours() + ':' + timeroo.getMinutes() + ':' + timeroo.getSeconds();
		var id = 'message-' + $.md5(message.timestamp + message.author);
		var html = '<li class="message" id="' + id + '" style="display:none;"><ul class="data"><li class="time">' + timestamp + '</li><li class="ip">' + message.ip + '</li><li class="author"><img class="gravatar" src="http://gravatar.com/avatar/' + $.md5(message.email) + '?s=16&d=http://li3.rad-dev.org/img/icons/silk/shading.png" border="0" /> &laquo; ' + message.author + ' &raquo; </li><li class="text"><div class="markdown">' + message.text + '</div></li></ul></li>';
		$("#anologue").append(html)
		$('#'+id).animate({
			opacity: 'show',
			height: 'show',
		}, 'slow');
		var scrollDisabled = $('#anologue-scroll:checked').val();
		if (!scrollDisabled) {
			$('html, body').animate({
				scrollTop: $('#'+id).offset().top
			}, 'normal');
		}
	},
	
	alert: function(message) {
		alert(message);
		return null;
	},
	
	markdown: function() {
		$('.markdown').each(function() {
			if (!$(this).hasClass('marked')) {
				var text = anologue._config.converter.makeHtml($(this).text());
				$(this).replaceWith(text).addClass('marked');
			}
		});
	}
}
