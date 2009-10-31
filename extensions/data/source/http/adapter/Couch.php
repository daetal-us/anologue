<?php

namespace app\extensions\data\source\http\adapter;

class Couch extends \lithium\data\source\Http {

	protected function _prepare($data = array()) {
		return parent::_prepare(json_encode($data));
	}

	protected function _send($path = null) {
		$this->request->headers('Content-Type', 'application/json');
		$data = parent::_send($path);
		if (get_magic_quotes_gpc() == true) {
			$data = stripslashes($data);
		}
		return json_decode($data);
	}
}
?>
