<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<div class="home article">
<article>
	<div class="header">
		<header>
			<div class="width-constraint">
				<?php echo $this->html->image('anologue.png', array('id' => 'anologue-logo')); ?>
				<h1 class="title">anologue</h1>
			</div>
		</header>
	</div>

	<div id="anologue-new"><?php echo $this->html->link('new &nbsp;anologue &raquo;', array(
		'controller' => 'anologue', 'action' => 'add'
	), array('escape' => false)); ?></div>

	<div class="width-constraint">

		<p class="large center"><strong>anonymous, linear dialogue</strong></p>

		<h2>a slightly different approach</h2>

		<div class="aside excellence">
			<aside>
				<?php echo $this->html->image('excellent.jpg', array(
					'alt' => 'sixty-nine, dudes!', 'id' => 'anologue-excellent'
				)); ?>
				<span>your future us's use anologue!</span>
			</aside>
		</div>

		<p><strong>anologue</strong> is like comments, meets im, meets irc, meets
		<?php echo $this->html->link('your favorite paste app', 'http://pastium.org'); ?>,
		meets instant coffee.</p>

		<p>actually, instant coffee sucks.</p>

		<p>with anologue you can quickly and easily engage in an anonymous (or not) linear dialogue
			with any number of people (within reason).</p>

		<p><strong>no accounts. no installations. no way?! <em>yes, way!</em></strong></p>

		<p><?php echo $this->html->link(
			'your "chat room" is created by the time this link loads',
			array('controller' => 'anologue', 'action' => 'add')
		); ?>. invite whomever you want by giving them your unique link, and chat away.</p>

		<h2>let's make this better, together</h2>

		<p>perhaps best of all:
		<?php echo $this->html->link('this is open source', 'http://rad-dev.org/lithium_anologue'); ?>
		. built with <?php echo $this->html->link('php 5.3+', 'http://php.net'); ?>, using the most
		non-heinous, totally rad framework <?php echo $this->html->link(
			'lithium', 'http://li3.rad-dev.org'
		); ?>, <?php echo $this->html->link('couchdb', 'http://couchdb.apache.org'); ?>,
		<?php echo $this->html->link('jquery', 'http://jquery.com'); ?>, a few other scripts as well
		as some classy, custom and established <?php echo $this->html->link(
			'iconography', 'http://www.pinvoke.com/'
		); ?> and <?php echo $this->html->link(
			'typefaces', 'http://www.theleagueofmoveabletype.com/'
		); ?>; all coming together for the
		conversational goodness you're about to experience.</p>

		<p><?php echo $this->html->link(
			'fork and contribute to the core', 'http://rad-dev.org/lithium_anologue/'
		); ?> or download the source and setup your own. this one's for
			you, internets.</p>
	</div>

	<div class="footer">
		<footer>
			<?php echo $this->html->link($this->html->image(
				'http://imgur.com/6eddU.gif',
				array('border' => 0, 'alt' => 'powered by lithium')
			), 'http://li3.rad-dev.org', array('escape' => false)); ?>
			<?php echo $this->html->script('http://www.ohloh.net/p/471008/widgets/project_users_logo.js'); ?>
		</footer>
	</div>
	<div class="aside overlay" id="anologue-settings" style="display:none;">
		<aside>
		<h1>start an anologue</h1>
		<div class="fieldset">
			<fieldset>
				<label for="AnolougeTitle">Title</label>
				<input type="text" id="AnologueTitle" name="anologue[title]" class="text anologue title" title="Anologue Title" value="" placeholder="Title" />
				<label for="AnologueDescription">Description</label>
				<textarea id="AnologueDescription" name="anologue[description]" placeholder="enter a description (markdown enabled) or leave blank for none... "></textarea>
				<label for="AnologueWebhook">Custom Webhook URI</label>
				<input type="url" id="AnologueWebhook" name="anologue[webhook]" class="text anologue webhook" title="Custom Webhook URI" value="" placeholder="Custom Webhook URI" />
				<p>note: none of these options are required. in a rush? just click start.</p>
				<div><button class="cancel"><span>cancel</span></button> <button class="start"><span>start</span></button></div>
			</fieldset>
		</div>
		</aside>
	</div>
</article>
</div>
<?php echo $this->html->script(array(
	'http://code.jquery.com/jquery-1.4.2.min.js',
)); ?>
<script type="text/javascript">
var anologue = {
	setup: function() {
		$('#anologue-settings').css({height: $('body').height()});
		$('#anologue-new a').click(function() {
			if ($('#anologue-settings').hasClass('on')) {
				return true;
			} else {
				$('#anologue-settings').fadeIn();
				$('#anologue-settings').addClass('on');
				return false;
			}
		});
		$('#anologue-settings button.cancel').click(function() {
			$('#anologue-settings').fadeOut().removeClass('on');
		});
		$('#anologue-settings button.start').click(function() {
			anologue.start();
		});
	},
	start: function() {
		var data = {
			title: $('#AnologueTitle').val(),
			description: $('#AnologueDescription').val(),
			webhook: $('#AnologueWebhook').val()
		}
		$.post('<?php echo $this->_request->env('base') ?>/add.json', data, function(response) {
			window.location = '<?php echo $this->_request->env('base'); ?>/'+response.data.id;
		});
	}
}

$(document).ready(function() {
	anologue.setup();
});
</script>