<?php

interface iDB
{
    function open();
    function insert($record);
    function query($name, $string);
    function delete($name,$string);
    function close();
}

?>