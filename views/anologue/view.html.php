<h1 class="smaller-title"><a href="/">anologue</a></h1>

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

<div class="anologue-help">
	<p><strong>hello.</strong></p>
	<p>to get started, type your text in the grey box at the very bottom and press &lt;enter&gt;. <br />markdown is supported, to an extent.</p>
	<p><strong>for your privacy,</strong> your email is only used to generate your <a href="http://gravatar.com" target="_gravatar">gravatar</a> and is stored in an unreadable, encoded format.</p>
</div>

<h3 class="hash"><?php echo $this->html->link($anologue->_id, array('action' => 'view', 'id' => $anologue->_id), array('title' => 'Copy this url and give it to others')); ?></h3>

<ul id="anologue" class="anologue">
<?php if (!empty($anologue->messages)) { ?>
	<?php foreach ($anologue->messages as $key => $message) { ?>
		<li class="message" id="message-<?=md5($message->timestamp . $message->author);?>">
			<ul class="data">
				<li class="time"><?=date('G:i:s', $message->timestamp);?></li>
				<li class="ip"><?=$message->ip;?></li>
				<li class="author">
					<img class="gravatar" src="http://gravatar.com/avatar/<?=$message->email;?>?s=16&d=http://anologue.li3/img/anonymous.png" border="0" /> 
					&laquo; <?=$message->author;?> &raquo;
				</li>
				<li class="text"><div class="markdown"><?=$message->text;?></div></li>
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
			<a href="/">what is anologue?</a>
		</span>
		<div class="text">
			<textarea name="anologue-text" id="anologue-text"></textarea>
		</div>
</div>

</form>

<audio id="anologue-speaker"></audio>

<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/js/md5.jquery.js"></script>
<script type="text/javascript" src="/js/showdown.js"></script>
<script type="text/javascript" src="/js/anologue.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		anologue.setup({line: <?php echo count($anologue->messages); ?>, anologue: <?php echo json_encode($anologue); ?>});
	});
</script>

