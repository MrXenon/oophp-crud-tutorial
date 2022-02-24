<?php
class Init{

    protected $db;
    public function __construct(){
        $this->db = new DB_con();
        $this->db = $this->db->ret_obj();
        Init::createTableGebruikers();
    }

    public function createTableGebruikers()
    {
        //Name of the table that will be added to the db
        $users = "gebruikers";

       /*Create Database*/
        //Create the users table
        $sql = "CREATE TABLE IF NOT EXISTS $users (
           id INT(11) NOT NULL AUTO_INCREMENT,
           voornaam VARCHAR(30) NULL UNIQUE,
           achternaam VARCHAR(255) NULL,
           email VARCHAR(255) NOT NULL,
           adres VARCHAR(255) NOT NULL,
           postcode VARCHAR(255) NOT NULL,
           woonplaats VARCHAR(255) NOT NULL,
           telefoonnummer VARCHAR(255) NOT NULL,
           PRIMARY KEY  (id))
           ENGINE = InnoDB DEFAULT CHARSET=latin1;";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function add_query_arg( $args ) {
        if ( is_array( $args[0] ) ) {
            if ( count( $args ) < 2 || false === $args[1] ) {
                $uri = $_SERVER['REQUEST_URI'];
            } else {
                $uri = $args[1];
            }
        } else {
            if ( count( $args ) < 3 || false === $args[2] ) {
                $uri = $_SERVER['REQUEST_URI'];
            }
        }
}
}
?>