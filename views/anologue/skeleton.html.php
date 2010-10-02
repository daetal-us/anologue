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
<?php echo $this->html->style('anologue.theme.default'); ?>

<div class="anologue article admin">
<article>
	<div class="header anologue-title">
		<header>
			<h1 class="title">04713d29463623248f252c7702094439</h1>
			<div class="description markdown"><pre>Some custom description.</pre></div>
		</header>
	</div>

	<div class="section messages">
		<section>
			<ul id="anologue">
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1280087742" class="time"></span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time"></span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
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
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.youtube.com/watch?v=_K97ITEkd8g](http://www.youtube.com/watch?v=_K97ITEkd8g)
					</pre></div>
				</li>
				<li class="message">
					<span class="meta">
						<span class="ip">localhost</span>
						<time datetime="1979-10-14T12:00:00.001-04:00"><span data-timestamp="1284016742" class="time">3 minutes ago</span></time>
						<span class="author gravatar" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=20);">Jon</span>
						<span class="separator">: </span>
					</span>
					<div class="text markdown"><pre>[http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks](http://www.slideshare.net/nateabele/lithium-the-framework-for-people-who-hate-frameworks)
					</pre></div>
				</li>
			</ul>
		</section>
	</div>

	<div class="aside overlay" id="viewers">
	<aside>
		<header>
			<h1>viewers</h1>
			<ul>
				<li class="viewer"><a href="http://example.com" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=16)">Sample User</a></li>
				<li class="viewer"><span>Bob Dole aSd faSD faS f sdF asDFas dfASDF fds </span></li>
				<li class="viewer anonymous"><span>anonymous</span></li>
				<li class="viewer away"><a href="http://example.com" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=16)">Steven</a></li>
				<li class="viewer"><a href="http://example.com" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=16)">Sample User</a></li>
				<li class="viewer"><span>Bob Dole</span></li>
				<li class="viewer anonymous"><span>anonymous</span></li>
				<li class="viewer away"><a href="http://example.com" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=16)">Steven</a></li>
				<li class="viewer"><a href="http://example.com" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=16)">Sample User</a></li>
				<li class="viewer"><span>Bob Dole</span></li>
				<li class="viewer anonymous"><span>anonymous</span></li>
				<li class="viewer away"><a href="http://example.com" style="background-image:url(http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=16)">Steven</a></li>
			</ul>
		</header>
	</aside>
	</div>

	<div class="aside overlay" id="oembed">
		<aside>
			<div class="display" id="oembed-display">
				<object width="425" height="264"><param name="movie" value="http://www.youtube.com/v/vXjnEM_Kp_4?fs=1"><param name="allowFullScreen" value="true"><param name="allowscriptaccess" value="always"><embed src="http://www.youtube.com/v/vXjnEM_Kp_4?fs=1" type="application/x-shockwave-flash" width="425" height="264" allowscriptaccess="always" allowfullscreen="true"></object>
			</div>
			<div class="source" id="oembed-source">
				<a href="http://www.youtube.com/watch?v=vXjnEM_Kp_4&amp;feature=popular" class="open" target="_blank">http://www.youtube.com/watch?v=vXjnEM<em>Kp</em>4&amp;feature=popular</a>
			</div>
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

<audio id="anologue-speaker"></audio>

<?php echo $this->html->script(array(
	'http://code.jquery.com/jquery-1.4.2.min.js',
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
