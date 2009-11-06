<?php
	$avatar = 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->_request->env('base').'/img/anonymous.png';
?>
<form id="anologue-form">

<div class="anologue-settings">
	<div>
		<label for="anologue-author">Name</label>
		<input type="text" name="anologue-author" id="anologue-author" />
	</div>
	<div>
		<label for="anologue-email">Email</label>
		<input type="text" name="anologue-email" id="anologue-email" />
	</div>
	<div>
		<label for="anologue-scroll">disable auto-scroll </label><input name="anologue-scroll" id="anologue-scroll" type="checkbox" value="disable" />
	</div>
	<div class="sound">
		<label for="anologue-sound">disable sounds </label><input name="anologue-sound" id="anologue-sound" type="checkbox" value="disable" />
	</div>
</div>

<h1 class="smaller-title"><?php echo $this->html->link('anologue', array('controller' => 'anologue', 'action' => 'index')); ?></h1>
<h3 class="hash"><?php echo $this->html->link($data->_id, array('action' => 'view', 'id' => $data->_id), array('title' => 'Copy this url and give it to others')); ?></h3>


<div class="anologue-help">
	<p><strong>hello.</strong></p>
	<p>to get started, type your text in the box at the very bottom and press &lt;enter&gt;. <br />markdown is supported, to an extent.</p>
	<p><strong>for your privacy,</strong> your email is only used to generate your <?php echo $this->html->link('gravatar', 'http://gravatar.com'); ?> and is stored in an unreadable, encoded format.</p>
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
					<span title="<?php echo $this->html->escape($message->author);?>">&laquo; <?php echo $this->html->escape($message->author);?> &raquo;</span>
				</li>
				<li class="text"><div class="markdown"><?php echo $this->html->escape($message->text); ?></div></li>
			</ul>
		</li>
	<?php } ?>
<?php } ?>
</ul>

<div class="anologue-speak">
		<span class="label">
			<label for="anologue-text">you say: </label>
		</span>
		<span class="label about">
			<?php echo $this->html->link('what is anologue?', array('controller' => 'anologue', 'action' => 'index')); ?>
		</span>
		<div class="text">
			<textarea name="anologue-text" id="anologue-text"></textarea>
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
			id: '<?=$data->_id?>',
			base: '<?php echo $this->_request->env('base') ?>',
			line: <?php echo count($data->messages); ?>,
			icon: '<?php echo $avatar; ?>'
		});
	});
</script>