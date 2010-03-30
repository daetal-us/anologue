<?php

namespace app\models;

class AnologueView extends \lithium\data\Model {

	/**
	 * This design document is created utilizing the `li3 Anologue install` console command
	 * @see \app\extensions\commands\Anologue
	 */
	public static $views = array(
		'changes' => array(
			'id' => '_design/changes',
			'filters' => array(
				'id' => '
					function(doc, req) {
						if (doc._id == req.query.id) {
							return true;
						}
						return false;
					}'
			)
		)
	);

}

?>