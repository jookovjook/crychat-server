<?php

/**
 * @property array i
 * @property array o
 * @property float timeStart
 * @property string source
 * @property string action
 * @property string strInput
 * @property string strOutput
 * @property float runtime
 * @property bool soft
 * @property bool silent
 */

class Core {

    public function __construct(){
        error_reporting(E_ERROR);
        ini_set('display_errors', 1);
        $this->timeStart = microtime(true);
        $this->soft = false;
        $this->silent = false;
        $this->action = substr(str_replace(".php","", $_SERVER['PHP_SELF']), 1);
        $this->strInput = file_get_contents('php://input');
        $this->i = json_decode($this->strInput, true);
        $this->o = array();
    }

    public function __destruct() {
		//Log actions
    }

    public function echo($msg = NULL){
        $this->o["error"] = 0;
        if($msg != NULL) $this->o["msg"] = strval($msg);
        if(!key_exists("msg", (array) $this->o)) $this->o["msg"] = "OK";
        $this->out();
    }

    public function throw($code, string $msg){
        $this->o["error"] = $code;
        $this->o["msg"] = strval($msg);
        $this->out();
    }

    private function out(){
        $this->runtime = microtime(true) - $this->timeStart;
        $this->o["runtime"] = $this->runtime;
        $this->strOutput = json_encode($this->o);
        echo $this->strOutput;
        exit;
    }

}