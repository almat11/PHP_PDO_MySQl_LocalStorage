<?php 

require_once 'DatabaseFactory.php';

echo "\n----------------- Aufgabeblatt 4 ------------------\n\n";
echo "------- Instanziiren Klasse DB -------\n";

/**
 * dient zur Implementierung der Funktion der Klasse DB*/
function test_DB()
{
    // Ein neues Objekt der Klasse DB wird erzeugt
    $test = DatabaseFactory::Access("DB");
    
    // Die Verbindung zur Datenbank wird eingelegt
    $test->open();
    
    // 3 neue Datensätze werden in Datenbank gespeichert
    $val[]=array('id'=>11,'name'=>'Cookie','price'=>1.50);
    $val[]=array('id'=>12,'name'=>'Milk','price'=>0.69);
    $val[]=array('id'=>13,'name'=>'Bread','price'=>1.50);
    foreach($val as $v) {
        $test->insert($v);
    }
    // Liefert die ganze Tabelle zurück
//     $test->queryAll();
    
    // Führt ein SELECT Anweisung.
    // Wenn die Bedingung mehrere Zeilen erfüllen, 
    // so wird immer nur die erste Zeile geliefert.
    $test->query('price', 0.69);
    // Wie Sie sehen, wird hier nur die erste Zeile, 
    // die Bedingungen erfüht, geliefert.
    $test->query('price', 1.50);
    
    // Führt eine DELETE Anweisung.
    // Wenn die Bedingung mehrere Zeilen erfüllen,
    // so wird immer nur die erste Zeile gelöscht.
    $test->delete('price', 1.50);
    $test->delete('id', 12);
    
    $test->query('price', 1.50);
    
    $test->delete('id', 13);
    
    // schließen die DB-Verbindung
    $test->close();
}
/**
 * führt die Implementierung der Funktion der Klasse DB*/
test_DB();

echo "\n====================================================\n";
echo "------ Instanziiren Klasse PHPDB ------\n";

/**
 * dient zur Implementierung der Funktion der Klasse PHPDB*/
function test_PHPDB()
{
    // Ein neues Objekt der Klasse PHPDB wird erzeugt
    $test = DatabaseFactory::Access("PHPDB");
    
    // Der Dateizugriff ist festgelegt 
    $test->open();
    
    // 3 neue Datensätze werden in File gespeichert
    $test->insert(array('id' => 11, 'name' => 'Cookie', 'price' => 1.50));
    $test->insert(array('id' => 12, 'name' => 'Milk', 'price' => 0.69));
    $test->insert(array('id' => 13, 'name' => 'Bread', 'price' => 1.50));
    
    // Liefert die Datensätze zurück 
    $test->show();
    
    // Die Datenzätze werden gelöscht
    $test->delete("id", 11);
    $test->delete("id", 12);
    $test->delete("id", 13);
    
    $test->show();
    
    // Speichret die Datensätze in File
    $test->close();
    
    $test->open();
    
    $test->show();
}
/**
 * führt die Implementierung der Funktion der Klasse PHPDB*/
test_phpdb();


?>