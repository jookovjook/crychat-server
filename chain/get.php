<?php
include_once '../db/core.php';
include_once '../db/chain.php';
$c = new Core();
$chain = Chain::entire();
$c->o["chain"] = $chain->toAll();
$c->echo();