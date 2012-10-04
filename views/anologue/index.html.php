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
	<header>
		<div class="width-constraint">
			<?php echo $this->html->image('anologue.png', array('id' => 'anologue-logo')); ?>
			<h1 class="title">anologue</h1>
			<h2 class="subtitle">web-based, linear dialogue</h2>
		</div>
		<?php echo $this->html->link('start a new anologue', array(
			'controller' => 'anologue', 'action' => 'add'
		), array('escape' => false, 'id' => 'anologue-new')); ?>
	</header>

	<div class="width-constraint">

		<h2>a <em>slightly</em> different approach</h2>

		<aside class="excellence">
			<?php echo $this->html->image('excellent.jpg', array(
				'alt' => 'sixty-nine, dudes!', 'id' => 'anologue-excellent'
			)); ?>
			<span>no accounts. &nbsp;no installations. <br> no way?! &nbsp;yes, way!</span>
		</aside>

		<p><strong>anologue</strong> is like comments with markdown + instant-messaging with oembed / irc meets web = 47.</p>

		<p>with anologue you can quickly and easily engage in a relatively anonymous (or not) linear dialogue
			with anyone else with a modern web browser.</p>

		<p><?php echo $this->html->link(
			'your "chat room" is created by the time this link loads',
			array('controller' => 'anologue', 'action' => 'add')
		); ?>. inviting someone is as simple as giving them the url.</p>

		<h2>let's make this better, together</h2>

		<p><?php echo $this->html->link('this is open source', 'http://github.com/pointlessjon/anologue'); ?>.</p>
		<p>built with <?php echo $this->html->link('php 5.3+', 'http://php.net'); ?>, <?php echo $this->html->link(
			'lithium', 'http://github.com/unionofrad/lithium'
		); ?>, <?php echo $this->html->link('couchdb', 'http://couchdb.apache.org'); ?>,
		<?php echo $this->html->link('jquery', 'http://jquery.com'); ?>, a few other scripts as well
		as some classy, custom and established <?php echo $this->html->link(
			'iconography', 'http://www.pinvoke.com/'
		); ?> and <?php echo $this->html->link(
			'typefaces', 'http://www.theleagueofmoveabletype.com/'
		); ?>; all coming together for the
		conversational goodness you're here to experience.</p>
	</div>
	<aside class="overlay" id="new-anologue" style="display:none;">
		<h1>start a new anologue</h1>
		<fieldset>
			<input type="text" id="AnologueTitle" name="anologue[title]" class="text anologue title" title="Anologue Title" value="" placeholder="title..." />
			<textarea id="AnologueDescription" name="anologue[description]" placeholder="description..."></textarea>
			<input type="url" id="AnologueWebhook" name="anologue[webhook]" class="text anologue webhook" title="Custom Webhook URI" value="" placeholder="http://webhook/uri" />
			<p>none of these options are required.</p>
			<div><button class="cancel"><span>cancel</span></button> <button class="start"><span>start</span></button></div>
		</fieldset>
	</aside>
</article>
</div>
<?php echo $this->html->script(array(
	'http://code.jquery.com/jquery-1.5.2.min.js',
)); ?>
<script type="text/javascript">
var anologue = {
	setup: function() {
		$('#anologue-new').click(function() {
			if ($('#new-anologue').hasClass('on')) {
				return true;
			} else {
				$('body').addClass('constrained');
				$('#new-anologue').css({height: $(window).height()});
				$('#new-anologue').fadeIn();
				$('#new-anologue').addClass('on');
				return false;
			}
		});
		$('#new-anologue button.cancel').click(function() {
			$('body').removeClass('constrained');
			$('#new-anologue').fadeOut().removeClass('on');
		});
		$('#new-anologue button.start').click(function() {
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