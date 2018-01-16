<?php
include_once '../db/core.php';
$c = new Core();
if(!array_key_exists("data", $c->i)) $c->throw(1, "Please, specify data");
include_once '../db/block.php';
$block = Block::fromData(strval($c->i["data"]));
if (!$block->insert()) $c->throw(2, "Error creating new block");
$c->o["block"] = $block->toAll();
$c->echo();