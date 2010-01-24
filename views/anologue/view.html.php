<?php
	$base = $this->_request->env('base');
	if ((!empty($base)) && !preg_match('/^\//', $base)) {
		$base = '/' . $base;
	}
	$avatar = 'http://'.$_SERVER['HTTP_HOST'].$base.'/img/anonymous.png';
?>
<form id="anologue-form">

<div class="anologue-titling">
	<h1 class="smaller-title">
		<?php
			echo $this->html->link(
				'anologue', 
				array('controller' => 'anologue', 'action' => 'index')
			);
		?>
	</h1>
	<h3 class="hash">
		<?php
			echo $this->html->link(
				$data->id, 
				array('action' => 'view', 'id' => $data->_id), 
				array('title' => 'Copy this url and give it to others')
			);
		?>
	</h3>
</div>
<div id="anologue-help">
	<div class="padding">
	<h2>hello.</h2>
	<p>to get started type your name, then your message in the appropriate boxes below. <br /><?php echo $this->html->link('markdown', 'http://daringfireball.net/projects/markdown/syntax'); ?> is supported, to an extent.</p>
	<p><strong>for your privacy,</strong> your email is only used to generate your <?php echo $this->html->link('gravatar', 'http://gravatar.com'); ?> and is stored in an unreadable, encoded format.</p>
	</div>
	<button id="anologue-close-help" class="close" title="Close this help window"><span>close</span></button>
</div>


<ul id="anologue" class="anologue">
<?php if (!empty($data->messages)) { ?>
	<?php foreach ($data->messages as $key => $message) { ?>
		<li class="message" id="message-<?php echo md5($message->timestamp . $message->author);?>">
			<ul class="data">
				<li class="time"><?php echo date('G:i:s', $message->timestamp);?></li>
				<li class="ip"><?php echo $message->ip;?></li>
				<li class="author">
					<?php echo $this->html->image(
						"http://gravatar.com/avatar/{$message->email}?s=16&d={$avatar}"); ?>
					<span title="<?php echo $this->html->escape($message->author);?>">
						&laquo; <?php echo $this->html->escape($message->author);?> &raquo;
					</span>
				</li>
				<li class="text">
					<div class="markdown">
						<pre><?php echo $this->html->escape($message->text); ?></pre>
					</div>
				</li>
			</ul>
		</li>
	<?php } ?>
<?php } ?>
</ul>

<div id="anologue-speech-bar">
	<div class="purple-background">
		<div class="twenty-percent">
			<div class="anologue-settings">
				<div class="input name">
					<label class="icon" for="anologue-author" title="Your name"><span>Your name</span></label>
					<input type="text" name="anologue-author" id="anologue-author" value="<?php echo ($user['author']) ?: ''; ?>" />
				</div>
				<div class="input email">
					<label class="icon" for="anologue-email" title="Your e-mail address"><span>Your e-mail</span></label>
					<input type="text" name="anologue-email" id="anologue-email" value="<?php echo ($user['email']) ?: ''; ?>" />
				</div>
				<div class="checkbox first sound">
					<label class="icon <?php echo ($user['sounds'] == 'false') ? 'disabled' : ''; ?>" title="Toggle sounds"><span>Toggle sounds</span></label>
				</div>
				<div class="checkbox auto-scroll">
					<label class="icon <?php echo ($user['scrolling'] == 'false') ? 'disabled' : ''; ?>" title="Toggle auto-scrolling"><span>Toggle auto-scrolling</span></label>
				</div>
				<div class="checkbox cookie">
					<label class="icon" title="Toggle cookies"><span>Toggle cookies</span></label>
				</div>
				<div class="about">
					<?php
						echo $this->html->link(
							'what is anologue?', 
							array('controller' => 'anologue', 'action' => 'index')
						);
					?>
				</div>
			</div>
		</div>
		<div class="eighty-percent">
			<div class="anologue-speak">
				<div class="input textarea">
					<label class="icon" for="anologue-text" title="Type what you want to say and press enter"><span>you say:</span></label>
					<textarea name="anologue-text" id="anologue-text"></textarea>
				</div>
				<div class="submit">
					<button id="anologue-submit"><span>send</span></button>
				</div>
			</div>
		</div>
	</div>
</div>

</form>

<audio id="anologue-speaker"></audio>

<?php echo $this->html->script(array(
	'http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js',
	'md5.jquery.js', 'showdown.js', 'anologue.js',
)); ?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		anologue.setup({
			id: '<?=$data->id?>',
			base: '<?php echo $this->_request->env('base') ?>',
			line: <?php echo count($data->messages); ?>,
			icon: '<?php echo $avatar; ?>'
		});
	});
</script>
