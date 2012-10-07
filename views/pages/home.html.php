<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

$base = $this->_request->env('base');
?>
<div class="home article">
<article>
	<header>
		<div class="width-constraint">
			<?php echo $this->html->image('/media/anologue.png', array('id' => 'anologue-logo')); ?>
			<h1 class="title">anologue</h1>
			<h2 class="subtitle">web-based, linear dialogue</h2>
		</div>
		<?php echo $this->html->link('start a new anologue', array(
			'controller' => 'anologue', 'action' => 'add'
		), array('escape' => false, 'id' => 'new')); ?>
	</header>

	<div class="width-constraint">

		<h2>a <em>slightly</em> different approach</h2>

		<aside class="excellence">
			<span>no accounts.</span>
			<span>no installations.</span>
			<span>no way?!</span>
			<?php echo $this->html->image('/media/excellent.jpg', array(
				'alt' => 'sixty-nine, dudes!', 'id' => 'anologue-excellent', 'width' => 250
			)); ?>
			<span>yes, way!</span>
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
		<p>built with <?php echo $this->html->link('php', 'http://php.net'); ?>, <?php echo $this->html->link(
			'lithium', 'http://github.com/unionofrad/lithium'
		); ?>, <?php echo $this->html->link('couchdb', 'http://couchdb.apache.org'); ?>,
		<?php echo $this->html->link('html 5', 'http://en.wikipedia.org/wiki/HTML5'); ?>,
		<?php echo $this->html->link('jquery', 'http://jquery.com'); ?> and a few other tools and technologies.</p>
	</div>
	<footer>
		Logo by <a href="http://daetal.us">Jon Adams</a> •
		Typography by <a href="http://www.theleagueofmoveabletype.com/members/sursly">Tyler Finck</a> •
		UI Iconography by 
		<a href="http://thenounproject.com/lynnthemac">Lynn Christensen</a>,
		<a href="http://thenounproject.com/somerandomdude">P.J. Onori</a>,
		<a href="http://thenounproject.com/a2015">Adrijan Karavdic</a> and
		<a href="http://thenounproject.com/hcokim">Harold Kim</a> from the Noun Project
	</footer>
	<aside class="overlay" id="new-anologue" style="display:none;">
		<h1>start a new anologue</h1>
		<form>
			<button class="cancel">nevermind</button>
			<input type="text" name="title" class="text anologue title" title="Enter a custom title for your Anologue" placeholder="title..." value="" />
			<textarea name="description" title="If specified, a topic (or description) will always be displayed at the top of your Anologue" placeholder="topic or description..."></textarea>
			<input type="url"name="webhook" class="text anologue webhook" title="Webhooks rule. Anologue will post updates to the URI you define here." placeholder="http://webhook/uri" value="" />
		</form>
		<p>none of these options are required.</p>
		<button class="start">create</button>
	</aside>
</article>
</div>
<?php echo $this->html->script(array(
	'http://code.jquery.com/jquery-1.8.2.min.js',
)); ?>
<script type="text/javascript">
$(document).ready(function() {
	$(document).on('click', '#new', function() {
		$('body').addClass('constrained');
		$('#new-anologue')
			.height($(window).height())
			.fadeIn()
			.addClass('on');
		return false;
	});
	$(document).on('click', '#new-anologue button.cancel', function() {
		$('#new-anologue')
			.fadeOut()
			.removeClass('on');
		$('body').removeClass('constrained');
	});
	$(document).on('click', '#new-anologue button.start', function() {
		var data = $('#new-anologue form').serialize();
		$.post('<?php echo $base ?>/add.json', data, function(response) {
			window.location = '<?php echo $base; ?>/'+response.data.id;
		});
	});
});
</script>