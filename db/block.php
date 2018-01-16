<?php
include_once 'custom.php';

/**
 * @property int id
 * @property string previousHash
 * @property string hash
 * @property int timestamp
 * @property string data
 * @property int version
 */

class Block extends Custom {

	static protected function fromQuery($query){
		$block = new static();
		$block->objFromQuery($query);
		$block->key("id");
		if(intval($block->id) < 1) return self::initial();
		return $block;
	}

	static function fromId($id){
		return self::fromQuery("SELECT * FROM chain WHERE id = $id");
	}

	static function fromData($data){
		$block = new static();
		$lastBlock = self::last();
		$block->id = intval($lastBlock->id) + 1;
		$block->previousHash = $lastBlock->hash;
		$block->timestamp = time();
		$block->data = $data;
		$block->hash = $block->getHash();
		return $block;
	}

	static function initial(){
		$block = new static();
		$block->id = 1;
		$block->previousHash = "";
		$block->timestamp = 0;
		$block->data = "";
		$block->hash = $block->getHash();
		return $block;
	}

	static function last(){
		return self::fromQuery("SELECT * FROM chain ORDER BY id DESC LIMIT 1");
	}

	function toAll(){
		return static::toAny(array("id", "previousHash", "hash", "timestamp", "data", "version"));
	}


	function insert(){
		return $this->query("INSERT INTO chain (previousHash, hash, timestamp, data) VALUES ('$this->previousHash', '$this->hash', $this->timestamp, '$this->data')");
	}

	function getString(){
		return "{\"id\":".$this->id.",\"previousHash\":\"".$this->previousHash."\",\"timestamp\":".$this->timestamp.",\"data\":\"".$this->data."\"}";
	}

	function getHash(){
		return hash("sha256", $this->getString());
	}



}