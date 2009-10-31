<!doctype html>
<html>
<head>
	<?=@$this->html->charset(); ?>
	<title>anologue</title>
	<?=@$this->html->style('anologue'); ?>
	<?=@$this->scripts(); ?>
	<?=@$this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body>
	<div id="container">
		<div id="header"></div>
		<div id="content">
			<?=@$this->content; ?>
		</div>
		<div id="footer"></div>
	</div>
</body>
</html>
