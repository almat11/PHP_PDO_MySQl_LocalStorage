<?php 

require_once 'iDB.php';

class DB implements iDB
{
    protected $DSN;
    protected $DB_USER= 'root';
    protected $DB_PW= '';
    protected $DB_options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    protected $PDO;
    
    function __construct($DSN, $DB_USER, $DB_PW) {
        $this->DSN = $DSN;
        $this->DB_USER = $DB_USER;
        $this->DB_PW = $DB_PW;
    }
    
    //  Open the DB connection
    function open() {
        try {
            $db= $this->PDO = new PDO($this->DSN,$this->DB_USER,$this->DB_PW, $this->DB_options);
            $db= $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $db= $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            echo "\n**Connected successfully**".PHP_EOL;
        } catch(PDOException $err) {
            echo 'DB ERROR: '.$err->getMessage().PHP_EOL;
        }
    }
    //  $record is a PHP hash whose element names are the column names
    //  of the table and whose values are the values of a row in the table.
    //  A new line (record) is added to the table.
    function insert($record) {
        $insert = "INSERT INTO price_list VALUES(${record["id"]},'${record["name"]}',${record["price"]});";
        $rtn= $this->PDO->exec($insert);
        if($rtn===false) {
            $err= $db->errorInfo();
            echo 'DB ERROR: #'.$err[1]." ".$err[2].PHP_EOL;
        }else {
            echo "**New record created successfully**".PHP_EOL;
            
        }
    }
    
    //  If the condition is met by several lines, only the first line is ever returned.
    function query($name, $string){
        $query = "SELECT id,name,price FROM price_list WHERE ${name} = '${string}' LIMIT 1;";
        $data= $this->PDO->query($query);
        while(($row= $data->fetch())!==false) {
            printf('%10s ',$row['id']);
            printf('%10s ',$row['name']);
            printf('%10s ',$row['price']);
            echo PHP_EOL;
        }
    }
    
//          The same function like query but with fetchAll.
//          fetchAll() reads the entire temporary table into an array.
//          Of course, this is only useful for small tables.
         function queryAll(){
            $stmt = $this->PDO->prepare("SELECT * FROM price_list;");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            echo "\n**nur um die ganze Tabelle zu sehen**\n";
            foreach($stmt->fetchAll() as $k=>$v) {
                foreach ($v as $value){
                    echo $value . " ";
                }
            echo "---\n";
           }
        }
    
    //  If the condition is met by several lines, only the first line is ever returned.
    function delete($name,$string){
        $query = "DELETE FROM price_list WHERE ${name} = '${string}' LIMIT 1;";
        $data = $this->PDO->query($query);
        echo "**Record deleted successfully**".PHP_EOL;
    }
    
    //  Close the DB connection
    function close(){
        $conn = null;
        echo "**Disconnected successfully**".PHP_EOL;
    }
}


// function test_DB() {
//     $test = new DB("mysql:host=localhost;dbname=gruppe18", "root", "");
//     $test->open();
//     $val[]=array('id'=>10,'name'=>'test1','price'=>10);
//     $val[]=array('id'=>11,'name'=>'test2','price'=>10);
//     foreach($val as $v) {
//         $test->insert($v);
//     }
//     $test->query('price', 10);
//     $test->delete('price', 10);
//     $test->query('price', 10);
//     $test->close();
// }
//  test_DB();

?>