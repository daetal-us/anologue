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
	$avatar = 'http://' . $_SERVER['HTTP_HOST'] . $base . '/media/user.svg';

	extract($user);
?>

<article class="anologue">
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
		<div class="description"><?php echo $h($data->description); ?></div>
	</header>

	<section class="body">

		<section id="viewers">
			<ul>
				<li class="loading">loading...</li>
			</ul>
		</section>

		<section class="messages">
			<ul id="anologue">
				<?php if (!empty($data->messages)) { ?>
					<li class="message template">
						<span class="meta">
							<span class="ip"></span>
							<time><span data-timestamp="" class="time"></span></time>
							<img class="gravatar">
							<span class="author"></span>
						</span>
						<div class="text"></div>
					</li>
					<?php foreach ($data->messages as $key => $message) { ?>
						<li class="message" id="message-<?php echo md5($message['timestamp'] . $message['name']); ?>">
							<span class="meta">
								<span class="ip"><?php echo $message['ip']; ?></span>
								<time datetime="<?php echo date('c', $message['timestamp']);  ?>"><span data-timestamp="<?php echo $message['timestamp']; ?>" class="time"></span></time>
								<?php
									$image = $avatar;
									if (!empty($message['email'])) {
										$image = 'http://gravatar.com/avatar/' . $message['email'] . '?s=64&d=404';
									}
								?>
								<img class="gravatar" src="<?php echo $image; ?>">
								<span class="author"><?php echo !empty($message['url']) ? $this->html->link($h($message['name']), $message['url']) : $h($message['name']); ?></span>
							</span>
							<div class="text markdown">
								
								<pre><?php echo $h($message['text']); ?></pre>
							</div>
						</li>
					<?php } ?>
						
				<?php } ?>
			</ul>
		</section>

	</section>

	<footer>
		<menu type="toolbar">
			<command class="viewers on" title="Toggle viewer list" type="checkbox">
			<command class="user-settings on" title="Toggle my user settings" type="checkbox" data-overlay="#user-settings">
			<textarea name="message" class="message"></textarea>
			<?php echo $this->html->link('this is anologue.', '/'); ?>
		</menu>
		<aside class="overlay" id="user-settings">
			<fieldset>
				<input type="text" name="user[name]" class="text user name" placeholder="name..." title="Your name" value="<?php echo $user['name']; ?>" />
				<input type="email" name="user[email]" class="text user email" placeholder="e-mail..." title="Your e-mail" value="<?php echo $user['email']; ?>" />
				<input type="url" name="user[url]" class="text user url" placeholder="http://" title="Your website" value="<?php echo $user['url']; ?>" />
			</fieldset>
			<menu type="toolbar">
				<command type="checkbox" class="command icon sound <?php echo !$user['sounds'] ? null : 'on'; ?>" title="Toggle sound effects">
				<command type="checkbox" class="command icon scroll <?php echo !$user['scrolling'] ? null : 'on'; ?>" title="Toggle auto-scrolling window when a new message is posted">
				<command type="checkbox" class="command icon cookie <?php echo !$user['cookies'] ? null : 'on'; ?>" title="Toggle saving your user data">
			</menu>
		</aside>
	</footer>
</article>

<div class="sound">
	<audio id="anologue-speaker"></audio>
</div>

<?php echo $this->html->script(array(
	'http://code.jquery.com/jquery-1.8.2.min.js',
	'/lib/md5.jquery',
	'/lib/showdown',
	'/lib/pretty',
	'/lib/jquery.oembed',
	'anologue',
)); ?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		Anologue.start({
			db: <?php echo json_encode($data->to('array')); ?>,
			id: '<?php echo $data->id; ?>',
			base: '<?php echo $this->_request->env('base') ?>',
			line: <?php echo count($data->messages); ?>,
			icon: '<?php echo $avatar; ?>',
			intro: <?php echo (!empty($user['email']) || !empty($user['author'])) ? 'false' : 'true'; ?>,
			admin: <?php echo (!empty($user['admin'])) ? 'true' : 'false'; ?>
		});
	});
</script>
