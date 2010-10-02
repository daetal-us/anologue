<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace anologue\models;

class AnologueView extends \lithium\data\Model {

	protected $_schema = array(
		'id' => array('primary' => true),
		'filters' => array()
	);

	/**
	 * AnologueView meta
	 *
	 * @var array
	 * @see lithium\data\Model::$_meta
	 */
	protected $_meta = array(
		'connection' => 'anologue',
		'source' => 'anologue',
		'locked' => false,
	);

	/**
	 * This design document is created utilizing the `li3 anologue install` console command
	 * @see \anologue\extensions\commands\Anologue
	 */
	public static $views = array(
		'all' => array(
			'id' => '_design/all',
			'language' => 'javascript',
			'views' => array(
				'created' => array(
					'map' => 'function(doc) {
						if (doc.type && doc.type == "anologue") {
							emit(doc.created, doc);
						}
					}'
				),
				'slug' => array(
					'map' => 'function(doc) {
						if (doc.type && doc.type == "anologue") {
							if (doc.slug && doc.slug != "") {
								emit(doc.slug, doc);
							}
						}
					}'
				)
			)
		),
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