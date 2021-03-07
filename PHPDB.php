<?php 

$price_list = array(0 => array('id' => 1, 'name' => 'Cookie', 'price' => 1.50));
$price_list = array(1 => array('id' => 1, 'name' => 'Milk', 'price' => 0.69));

file_put_contents('price_list.txt', serialize($price_list));





?>