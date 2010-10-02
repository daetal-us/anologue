<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?><!doctype html>
<html>
<head>
	<?php echo $this->html->charset(); ?>

	<title>anologue</title>
	<?php echo $this->html->style(array('reset','anologue')); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body>

<?php echo $this->content; ?>

</body>
</html>
