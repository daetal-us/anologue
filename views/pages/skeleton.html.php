<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * This view is provided as an html/js skeleton for building out an anologue theme. It has all
 * standard UI elements in place as well as sample content.
 */
?>
<?php echo $this->html->style('anologue-2'); ?>

<article class="anologue">
	<header>
		<h1 class="title">04713d29463623248f252c7702094439</h1>
		<div class="description">Some custom description.</div>
	</header>

	<section class="body">

		<section id="viewers">
			<ul>
				<li class="viewer">
					<a href="http://example.com"><img title="Sample User" class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=64"></a>
				</li>
				<li class="viewer anonymous">
					<a href="http://example.com"><img title="Sample User" class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=64"></a>
				</li>
				<li class="viewer away">
					<a href="http://example.com"><img title="Sample User" class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=64"></a>
				</li>
				<li class="viewer anonymous away">
					<a href="http://example.com"><img title="Sample User" class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=64"></a>
				</li>
				<li class="viewer">
					<img title="Sample User" class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=64">
				</li>
				<li class="viewer anonymous">
					<img title="Sample User" class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=64">
				</li>
				<li class="viewer away">
					<img title="Sample User" class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=64">
				</li>
				<li class="viewer anonymous away">
					<img title="Sample User" class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=64">
				</li>
			</ul>
		</section>

		<section class="messages">
			<ul id="anologue">
				<li class="message">
					<span class="meta">
						<span class="ip">2001:0db8:85a3:0042:0000:8a2e:0370:7334</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1280087742" class="time"></span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	
	```code```

{{{

	/**
	 * Internal method to create or delete data in cookie.
	 *
	 * This method is currently intended to be called from within `AnologueController::say()`.
	 *
	 * @param array $data associative array of user data and options to be saved
	 * @see anologue\controllers\AnologueController::say()
	 */
	private function _manageCookie($id = null, $data = array()) {
		$cookieKeys = array('author','email','url','scrolling','sounds', 'cookies');
		if (isset($data['cookies']) && $data['cookies'] == 'true') {
			$user = array();

			array_walk($cookieKeys, function($key) use (&$data, &$user) {
				if (!empty($data[$key])) {
					$user[$key] = $data[$key];
					if ($key == 'author' && $data[$key] == 'anonymous') {
						unset($user[$key]);
					}
				}
			});

			Session::write($id, serialize($user));
		} else {
			Session::write($id, null);
		}
	}

}}}

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1282026742" class="time"></span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time"></span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	code

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=64">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	code

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	code

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	code

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Super Long USer Name WooooOOO</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	code

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	code

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	code

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	code

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>#my content
	code

* bullet
* list

[http://vimeo.com/10697309](http://vimeo.com/10697309)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?=20">
						<span class="author">Jon</span>
						<span class="separator"></span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
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
				<input type="text" name="user[name]" class="text user name" placeholder="name..." title="Your name" value="" />
				<input type="email" name="user[email]" class="text user email" placeholder="e-mail..." title="Your e-mail" value="" />
				<input type="url" name="user[url]" class="text user url" placeholder="http://" title="Your website" value="" />
			</fieldset>
			<menu type="toolbar">
				<command type="checkbox" class="command icon sound" title="Toggle sound effects">
				<command type="checkbox" class="command icon scroll" title="Toggle auto-scrolling window when a new message is posted">
				<command type="checkbox" class="command icon cookie" title="Toggle saving your user data">
			</menu>
		</aside>
	</footer>
</article>

<audio id="anologue-speaker"></audio>


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
			db: {},
			id: '0',
			base: '<?php echo $this->_request->env('base') ?>',
			line: 0,
			icon: '',
			intro: true,
		});
	});
</script>
