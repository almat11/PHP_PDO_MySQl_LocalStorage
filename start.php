<?php 

require_once 'DatabaseFactory.php';

echo "\n---------- Aufgabeblatt 4 ----------\n\n";
echo "--- Instanziiren Klasse DB ---\n";


function test_DB() {
    $test = new DB("mysql:host=localhost;dbname=gruppe18", "root", "");
    $test->open();
    $val[]=array('id'=>22,'name'=>'test1','price'=>10);
    $val[]=array('id'=>33,'name'=>'test2','price'=>10);
    foreach($val as $v) {
        $test->insert($v);
    }
    $test->query('price', 10);
    $test->delete('price', 10);
    $test->query('price', 10);
    $test->close();
}
test_DB();

echo "\n====================================\n";
echo "--- Instanziiren Klasse PHPDB ---\n";

function test_PHPDB()
{
    $db = DatabaseFactory::Access("PHPDB");
    $db->open();
    $db->insert(array('id' => 1, 'name' => 'Cookie', 'price' => 1.50));
    $db->insert(array('id' => 2, 'name' => 'Milk', 'price' => 0.69));
    $db->insert(array('id' => 3, 'name' => 'Bread', 'price' => 1.35));
    $db->show();
    $db->delete("id", 1);
    $db->delete("id", 2);
    $db->delete("id", 3);
    $db->show();
    $db->close();
    $db->open();
    $db->show();
}
// test_phpdb();


?>