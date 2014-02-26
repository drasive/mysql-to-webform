<?php namespace Data;
class DatabaseReader {
        
    private $server = "127.0.0.1";
    private $database = "test";
    private $user_name = "root";
    private $password = "";

    private $database_handle = mysql_connect($server, $user_name, $password);
    private $does_database_exist = mysql_select_db($database, $db_handle);

    function __construct($server, $database, $user_name, $password) {
        $this->server = $server;
        $this->database = $database;
        $this->user_name = $user_name;
        $this->password = $password;
            
        $database_handle = mysql_connect($server, $user_name, $password);
        $does_database_exist = mysql_select_db($database, $db_handle);
    }
        
    public function readDatabase ($SQL) {
        if ($does_database_exist) {
            $SQL = "SELECT * FROM tb_address_book";
            $result = mysql_query($SQL);

            while ( $db_field = mysql_fetch_assoc($result) ) {
                print $db_field['ID'] . "<BR>";
                print $db_field['First_Name'] . "<BR>";
                print $db_field['Surname'] . "<BR>";
                print $db_field['Address'] . "<BR>";
            }

            mysql_close($database_handle);
        }
        else {
            print "Database NOT Found ";
            mysql_close($database_handle);
        }
    }
}
?>