<?php
include_once 'config.php';

define("ANY", 0);
define("LST", 1);
define("OBJ", 2);

class Custom implements ArrayAccess {

    protected $db;

    protected function isList(){return property_exists($this, "list");}

    public function offsetSet($offset, $value) {
        if($this->isList()){
            if (is_null($offset)) {
                $this->list[] = $value;
            } else {
                $this->list[$offset] = $value;
            }
        }
    }

    public function offsetExists($offset) {
        if($this->isList()) return isset($this->list[$offset]);
        return false;
    }

    public function offsetUnset($offset) {
        if($this->isList()) unset($this->list[$offset]);
    }

    public function offsetGet($offset) {
        if($this->isList()) return isset($this->list[$offset]) ? $this->list[$offset] : null;
        return null;
    }

    function __construct($array = null)
    {
        include_once 'config.php';
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        $this->db->set_charset('UTF8');
        if($array != null) foreach ($array as $key=>$value) $this->$key = $value;
    }

    function __destruct() { }

    protected function objFromQuery($query){
        $obj = mysqli_fetch_assoc($this->db->query($query));
        foreach ($obj as $key => $value) $this->$key = $value;
    }

    protected function key(string $key){ if($this->$key == null) $this->$key = -1;}

    protected static function fromObj($obj, $class = NULL, $delNulls = false){
        if($class == NULL) $class = new static();
        foreach ($obj as $key => $value) { if(!($delNulls and $value == null)) $class->$key = $value; }
//        foreach ($obj as $key => $value) { $class->$key = $value; }
        return $class;
    }

    protected static function fromArray($array, $parent, $class = NULL){
        $list = "list";
        if($class == NULL) $class = new static();
        foreach ($array as $object) $class->$list[] = self::fromObj($object, clone $parent);
        return $class;
    }

    protected function toAny(array $values){
        $list = "list";
        if(!$this->isList()) return $this->toObj($this, $values);
        $output = array();
        foreach ($this->$list as $item) $output[] = $this->toObj($item, $values);
        return $output;
    }

    protected function addOneToOne($property, $class, $from, $to, $type = NULL){
        if($type == NULL) $type = ANY;
        if($type == ANY or $type == LST)
            if($this->isList())
                for($i = 0; $i < sizeof($this->list); $i++)
                    if($this->list[$i]->$property == null) $this->list[$i]->$property = $class::$from($this->list[$i])->$to();
        if($type == ANY or $type == OBJ)
            if($this->$property == null) $this->$property = $class::$from($this)->$to();
    }

    private function toObj($item, $values){
        foreach ($item as $key => $value) if(!in_array($key, $values)) unset($item->$key);
        return $item;
    }

    function queryToArray($query){
        $response = array();
        $result = $this->db->query($query);
        if($result) while($r = mysqli_fetch_assoc($result)) $response[] = $r;
        return $response;
    }

    function queryToArrayOfInts($query, $key){
        $response = array();
        $result = $this->db->query($query);
        if ($result) while($r = mysqli_fetch_assoc($result)) $response[] = intval($r[$key]);
        return $response;
    }

    function queryToObject($query){
        $result = $this->db->query($query);
        if($result) return mysqli_fetch_assoc($result);
        return array();
    }

    function query($query) {
        if($this->db == null) $this->__construct();
        if($this->db != null) return $this->db->query($query);
        else return (new self())->query($query);
    }

    private function ifTokenExists($token){
        return false;
    }

    protected function generateToken(){
        $characters = TOKEN_CHARS;
        do {
            $token = '';
            for ($i = 0; $i < TOKEN_LENGTH; $i++) $token .= $characters[mt_rand(0, strlen($characters) - 1)];
        } while ($this->ifTokenExists($token));
        return $token;
    }



}

function formatPhone($phoneNumber){ return "+".preg_replace('/[^0-9.]+/', '', $phoneNumber); }