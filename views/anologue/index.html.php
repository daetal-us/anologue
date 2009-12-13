<div id="anologue-new"><?php echo $this->html->link('start an anologue &raquo;', array('controller' => 'anologue', 'action' => 'add'), array('escape' => false)); ?></div>

<div class="header">
	<header>
		<div class="width-constraint">
			<?php echo $this->html->image('anologue.png', array('id' => 'anologue-logo')); ?>
			<h1 class="title">anologue</h1>
		</div>
	</header>
</div>

<div class="article width-constraint">
	<article>
	
	<p>i need to have a conversation with a couple people.</p>
	<p>there's <strong>email</strong>, but i get pretty sick of the copied text that quickly gets out of control, the unnecessary repetition of everyone's signuatures... overlapping responses. and, i get so much crap in my inbox as-is--it can be cumbersome to try and isolate relevant emails and then the important parts of them.</p>
	<p>i don't like <strong>instant messaging</strong>. there are so many clients out there, and, sure there are tools to help them come together, but there are some people that will never use <em>im</em> (i don't blame them, i just haven't had the choice.)</p>
	<p><strong>twitter</strong> is right out.</p>
	<p>then, there's one of my favorites: <strong>irc</strong>. but, let's face it: it's mostly for nerds.</p>
	<p><strong>google wave</strong> may be an option... someday. even so, in my experience with the beta so far i'd have to argue that multi-threaded chats are actually less productive.</p> 
	<p>so, i needed something different.</p>
	
	<h2 class="sub">a slightly different approach to an old problem</h2>

	<div class="aside excellence">
		<aside>
			<?php echo $this->html->image('excellent.jpg', array('alt' => 'sixty-nine, dudes!', 'id' => 'anologue-excellent')); ?>
		<span>your future us's use anologue!</span>
		</aside>
	</div>

	<p><strong>anologue</strong> is like comments, meets im, meets irc, meets <?php echo $this->html->link('your favorite paste app', 'http://pastium.org'); ?>, meets instant coffee.</p>
	<p>actually, instant coffee sucks.</p>
	<p>with anologue you can quickly and easily engage in an anonymous (or not) linear dialogue with any number of people (within reason).</p>
	<p><strong>no accounts. no installations. no way?! <em>yes, way!</em></strong></p>
	<p><?php echo $this->html->link('your "chat room" is created by the time this link loads', array('controller' => 'anologue', 'action' => 'add')); ?>. invite whoever you want by giving them your unique link, and chat away.</p>

	<h2 class="sub">let's make this better, together</h2>

	<p>perhaps best of all: <?php echo $this->html->link('this is open source', 'http://rad-dev.org/lithium_anologue'); ?>. built with <?php echo $this->html->link('php 5.3.1', 'http://php.net'); ?>, using the most non-heinous, totally rad <?php echo $this->html->link('lithium framework', 'http://li3.rad-dev.org'); ?>, <?php echo $this->html->link('couchdb', 'http://couchdb.apache.org'); ?>, <?php echo $this->html->link('jquery', 'http://jquery.com'); ?>, a few other scripts as well as some classy, original and <?php echo $this->html->link('established', 'http://www.pinvoke.com/'); ?> iconography for ui; all coming together for the conversational goodness you're about to experience.</p>
	<p class="last">contribute to the core or download the source and setup your own. this one's for you, internets.</p>
	</article>
</div>

<div class="footer">
	<footer>
		<?php echo $this->html->link($this->html->image('http://imgur.com/6eddU.gif', array('border' => 0, 'alt' => 'powered by lithium')), 'http://li3.rad-dev.org', array('escape' => false)); ?>
		<?php echo $this->html->script('http://www.ohloh.net/p/471008/widgets/project_users_logo.js'); ?>
	</footer>
</div>
