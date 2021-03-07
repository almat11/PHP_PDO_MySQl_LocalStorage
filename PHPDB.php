<?php 

require_once 'iDB.php';

class PHPDB implements iDB
{
    protected $DB_FILE;
    protected $DB_RAM;
    
    function __construct($db_file) {
        $this->DB_FILE = $db_file;
    }
    
    protected function db_exists() {
        $d = dir(".");
        $ex = false;
        while($e= $d->read()) {
            if ($e == $this->DB_FILE) {
                $ex = true;
            }
        }
        $d->close();
        return $ex;
    }
    
    public function open() {
        if (!$this->db_exists()) {
            $this->DB_RAM = array();
        } else {
            $this->DB_RAM = unserialize(file_get_contents($this->DB_FILE));
        }
        
    }
    
    public function insert($record) {
        $this->DB_RAM[] = $record;
    }
    
    public function query($name, $string) {
        foreach ($this->DB_RAM as $row) {
            if ($row[$name] == $string) {
                return $row;
            }
        }
    }
    
    public function delete($name, $string) {
        $q = $this->query($name, $string);
        if (isset($q)) {
            $i = array_search($q, $this->DB_RAM);
            unset($this->DB_RAM[$i]);
            array_values($this->DB_RAM);
        }
    }
    public function close() {
        file_put_contents($this->DB_FILE, serialize($this->DB_RAM));
        $this->DB_RAM = NULL;
    }
    
    public function show() {
        echo var_dump($this->DB_RAM);
    }
}

// function test_PHPDB()
// {
//     $db = DatabaseFactory::Access("PHPDB");
//     $db->open();
//     $db->insert(array('id' => 1, 'name' => 'Cookie', 'price' => 1.50));
//     $db->insert(array('id' => 2, 'name' => 'Milk', 'price' => 0.69));
//     $db->insert(array('id' => 3, 'name' => 'Bread', 'price' => 1.35));
//     $db->show();
//     $db->delete("id", 1);
//     $db->delete("id", 2);
//     $db->delete("id", 3);
//     $db->show();
//     $db->close();
//     $db->open();
//     $db->show();
// }
//  test_phpdb();

?>