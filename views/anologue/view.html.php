<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

	$base = $this->_request->env('base');
	if ((!empty($base)) && !preg_match('/^\//', $base)) {
		$base = '/' . $base;
	}
	$avatar = 'http://' . $_SERVER['HTTP_HOST'] . $base . '/img/icons/user-anonymous-black.png';
	$alternate = 'http://' . $_SERVER['HTTP_HOST'] . $base . '/img/icons/user-anonymous.png';

	extract($user);
?>
<?php echo $this->html->style('anologue.theme.default'); ?>

<div class="anologue article admin">
<article>
	<div class="header anologue-title">
		<header>
			<h1 class="title">
				<?php
					echo $this->html->link(
						($data->title) ?: $data->id,
						array('controller' => 'anologue', 'action' => 'view', 'id' => $data->id),
						array('title' => 'Direct link to this anologue')
					);
				?>
			</h1>
			<div class="description markdown">
				<pre><?php echo $h($data->description); ?></pre>
			</div>
		</header>
	</div>

	<div class="section messages">
		<section>
			<ul id="anologue">
				<?php if (!empty($data->messages)) { ?>
					<?php foreach ($data->messages as $key => $message) { ?>
						<li class="message">
							<span class="meta">
								<span class="ip"><?php echo $message->ip; ?></span>
								<time datetime="<?php echo date('c', $message->timestamp); ?>"><span data-timestamp="<?php echo $message->timestamp;?>" class="time"></span></time>
								<span class="author gravatar" style="background-image:url(http://gravatar.com/avatar/<?php echo $message->email; ?>?s=20&d=<?php echo $avatar; ?>);"><?php echo !empty($message->url) ? $this->html->link($h($message->name), $message->url) : $h($message->name); ?></span>
								<span class="separator">: </span>
							</span>
							<div class="text markdown">
								<pre><?php echo $h($message->text); ?></pre>
							</div>
						</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</section>
	</div>

	<div class="aside overlay" id="viewers">
	<aside>
		<header>
			<h1><span class="count">0</span> <span class="noun">viewers</span></h1>
			<ul>
				<li class="loading">loading...</li>
			</ul>
		</header>
	</aside>
	</div>

	<div class="aside overlay" id="oembed">
		<aside>
			<div class="display" id="oembed-display"></div>
			<div class="source" id="oembed-source"></div>
			<div class="menu toolbar close">
				<menu type="toolbar">
					<span class="command icon close" title="Close this multimedia overlay">
						<command type="checkbox">
					</span>
				</menu>
			</div>
		</aside>
	</div>

	<div class="aside overlay" id="markdown-help">
		<aside>
			<h1>Markdown Syntax</h1>
			<div class="content">
				<p># header 1 &nbsp;  &nbsp; ## header 2 &nbsp;  &nbsp; <em>*italic*</em> &nbsp;  &nbsp; <strong>**bold**</strong> &nbsp;  &nbsp; 	- unordered list &nbsp;  &nbsp; 1. ordered list &nbsp;  &nbsp; [a link](http://example.com/) &nbsp;  &nbsp; ![image alt text](http://example.com/image.jpg)</p>
			</div>
		</aside>
	</div>

	<div class="aside overlay" id="user-settings">
		<div class="menu toolbar fieldset">
			<fieldset name="">
				<label for="user[name]">Name</label>
				<input type="text" name="user[name]" class="text user name" placeholder="your name" title="Your name" value="<?=$name; ?>" />
				<label for="user[email]">Email</label>
				<input type="email" name="user[email]" class="text user email" placeholder="your email" title="Your e-mail" value="<?=$email; ?>" />
				<label for="user[url]">Website</label>
				<input type="url" name="user[url]" class="text user url" placeholder="your website" title="Your website" value="<?=$url; ?>" />
			</fieldset>
			<menu type="toolbar">
				<span class="command icon sound <?php echo ($user['sounds'] == 'false') ? 'disabled' : ''; ?>" title="Toggle sound effects">
					<command type="checkbox">
				</span>
				<span class="command icon scroll <?php echo ($user['scrolling'] == 'false') ? 'disabled' : ''; ?>" title="Toggle auto-scrolling window when a new message is posted">
					<command type="checkbox">
				</span>
				<span class="command icon cookie <?php echo ($user['cookies'] == 'false') ? 'disabled' : ''; ?>" title="Toggle saving your user data">
					<command type="checkbox">
				</span>
			</menu>
		</div>
	</div>

	<div class="footer">
		<footer>
			<menu type="toolbar">
				<span class="command icon viewers" title="Toggle viewer list">
					<command type="checkbox" data-overlay="#viewers">
				</span>
				<span class="command icon user-settings" title="Toggle my user settings">
					<command type="checkbox" data-overlay="#user-settings">
				</span>
				<span class="command icon markdown-help" title="Toggle markdown help">
					<command type="checkbox" data-overlay="#markdown-help">
				</span>
				<label for="text">Text</label>
				<input type="text" name="message" value="" class="text message" data-alternate=".footer textarea.message" />
				<textarea name="message" class="message" data-alternate=".footer input.message"></textarea>
				<span class="command icon expand-text" title="Toggle expanded text input">
					<command type="checkbox">
				</span>
				<?php
					echo $this->html->link(
						'this is anologue.',
						array('controller' => 'anologue', 'action' => 'index'),
						array('class' => 'about')
					);
				?>
			</menu>
		</footer>
	</div>
</article>
</div>

<div class="sound">
	<audio id="anologue-speaker"></audio>
</div>

<?php echo $this->html->script(array(
	'http://code.jquery.com/jquery-1.4.2.min.js',
	'md5.jquery', 'showdown', 'pretty', 'jquery.oembed', 'anologue-2',
)); ?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		anologue.start({
			db: <?php echo json_encode($data->to('array')); ?>,
			id: '<?=$data->id?>',
			base: '<?php echo $this->_request->env('base') ?>',
			line: <?php echo count($data->messages); ?>,
			icon: '<?php echo $avatar; ?>',
			intro: <?php echo (!empty($user['email']) || !empty($user['author'])) ? 'false' : 'true'; ?>,
			admin: <?php echo (!empty($user['admin'])) ? 'true' : 'false'; ?>
		});
	});
</script>
