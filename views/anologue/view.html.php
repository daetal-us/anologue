<form id="anologue-form">

<div class="anologue-settings">
	<div>
		<label for="anologue-author">Name</label>
		<input type="text" name="anologue-author" id="anologue-author" value="anonymous" />
	</div>
	<div>
		<label for="anologue-email">Email</label>
		<input type="text" name="anologue-email" id="anologue-email" value="" />
	</div>
	<div>
		<label for="anologue-scroll">disable auto-scroll </label><input name="anologue-scroll" id="anologue-scroll" type="checkbox" value="disable" />
	</div>
</div>

<h1 class="smaller-title"><a href="/">anologue</a></h1>
<h3 class="hash"><?php echo $this->html->link($anologue->_id, array('action' => 'view', 'id' => $anologue->_id), array('title' => 'Copy this url and give it to others')); ?></h3>

<ul id="anologue" class="anologue">
<?php if (!empty($anologue->messages)) { ?>
	<?php foreach ($anologue->messages as $key => $message) { ?>
		<li class="message" id="message-<?=md5($message->timestamp . $message->author);?>">
			<ul class="data">
				<li class="time"><?=date('G:i:s', $message->timestamp);?></li>
				<li class="ip"><?=$message->ip;?></li>
				<li class="author">
					<img class="gravatar" src="http://gravatar.com/avatar/<?=@md5($message->email);?>?s=16&d=http://anologue.li3/img/anonymous.png" border="0" /> 
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
			<a href="http://spacialeffect.com" target="_spacial"><img src="http://spacialeffect.com/spacial-effect-w.png" alt="a spacial effect collaborative" border="0" /></a><br />
			<a href="http://li3.rad-dev.org" target="_li3"><img src="http://imgur.com/6eddU.gif" alt="powered by lithium" border="0" /></a>
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

