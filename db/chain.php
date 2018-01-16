<?php
include_once 'block.php';

/**
 * @property array list
 */

class Chain extends Block {

	public static function entire(){
		$chain = new static();
		$chain->list = array();
		$list = $chain->queryToArray("SELECT * FROM chain");
		return static::fromArray($list, new parent(), $chain);
	}

}