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
			<h1>viewers <span clas="count">(18)</span></h1>
			<ul>
				<li class="viewer"><a href="http://example.com"><img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=32">Sample User</a></li>
				<li class="viewer"><span>Bob Dole aSd faSD faS f sdF asDFas dfASDF fds </span></li>
				<li class="viewer anonymous"><span>anonymous</span></li>
				<li class="viewer away"><a href="http://example.com"><img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=32">Sample User</a></li>
				<li class="viewer"><a href="http://example.com"><img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=32">Sample User</a></li>
				<li class="viewer"><span>Bob Dole</span></li>
				<li class="viewer anonymous"><span>anonymous</span></li>
				<li class="viewer away"><a href="http://example.com"><img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=32">Sample User</a></li>
				<li class="viewer"><a href="http://example.com"><img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=32">Sample User</a></li>
				<li class="viewer"><span>Bob Dole</span></li>
				<li class="viewer anonymous"><span>anonymous</span></li>
				<li class="viewer"><a href="http://example.com"><img class="gravatar" src="http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=32">Sample User</a></li>
			</ul>
		</section>

		<section class="messages">
			<ul id="anologue">
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
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
			<span class="command icon viewers" title="Toggle viewer list">
				<command type="checkbox" data-overlay="#viewers">
			</span>
			<span class="command icon user-settings" title="Toggle my user settings">
				<command type="checkbox" data-overlay="#user-settings">
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
		<aside class="overlay" id="user-settings">
			<fieldset>
				<label for="user[name]">Name</label>
				<input type="text" name="user[name]" class="text user name" placeholder="your name" title="Your name" value="" />
				<label for="user[email]">Email</label>
				<input type="email" name="user[email]" class="text user email" placeholder="your email" title="Your e-mail" value="" />
				<label for="user[url]">Website</label>
				<input type="url" name="user[url]" class="text user url" placeholder="your website" title="Your website" value="" />
			</fieldset>
			<menu type="toolbar">
				<span class="command icon sound" title="Toggle sound effects">
					<command type="checkbox">
				</span>
				<span class="command icon scroll" title="Toggle auto-scrolling window when a new message is posted">
					<command type="checkbox">
				</span>
				<span class="command icon cookie disabled" title="Toggle saving your user data">
					<command type="checkbox">
				</span>
			</menu>
		</aside>
	</footer>
</article>

<audio id="anologue-speaker"></audio>

<?php echo $this->html->script(array(
	'http://code.jquery.com/jquery-1.8.2.js',
	'md5.jquery', 'showdown', 'pretty', 'jquery.oembed', 'anologue-2',
)); ?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		anologue.start({
			db: {},
			id: '0',
			base: '<?php echo $this->_request->env('base') ?>',
			line: 0,
			icon: '',
			intro: true,
		});
	});
</script>
