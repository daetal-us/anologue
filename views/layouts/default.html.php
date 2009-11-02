<!doctype html>
<html>
	<head>
		<?php echo $this->html->charset(); ?>
		<title>anologue</title>
		<?php echo $this->html->style('anologue'); ?>
		<?php echo $this->scripts(); ?>
		<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
	</head>
	<body<?php echo (!empty($index)) ? ' class="index"' : null; ?>>
		<?php echo $this->content; ?>
	</body>
</html>
