<?php
//call required file
require '../controller/database.php';
class Gebruiker{

    private $id                 = '';
    private $voornaam           = '';
    private $achternaam         = '';
    private $email              = '';
    private $adres              = '';
    private $postcode           = '';
    private $woonplaats         = '';
    private $telefoonnummer     = '';


    // define database connection
    protected $db;
    public function __construct(){
        $this->db = new DB_con();
        $this->db = $this->db->ret_obj();
    }

    private function getGebruikerTable(){
        return $table = 'gebruikers';
    }

    public function getPostValues(){
        //Define the check for params
            $post_check_array = array (
                //Submit action
                'verzenden' => array('filter' => FILTER_SANITIZE_STRING ),
                'update' => array('filter' => FILTER_SANITIZE_STRING ),
                'voornaam' => array('filter' => FILTER_SANITIZE_STRING ),
                'achternaam' => array('filter' => FILTER_SANITIZE_STRING),
                'email' => array('filter' => FILTER_SANITIZE_STRING),
                'adres' => array('filter' => FILTER_SANITIZE_STRING),
                'postcode' => array('filter' => FILTER_SANITIZE_STRING),
                'woonplaats' => array('filter' => FILTER_SANITIZE_STRING),
                'telefoonnummer' => array('filter' => FILTER_SANITIZE_STRING),
                'id' => array('filter' => FILTER_VALIDATE_INT )
            );

            //Get filtered input: 
            $inputs = filter_input_array( INPUT_POST, $post_check_array );

            //RTS
            return $inputs;
        }

    public function getGetValues(){
        //Define parameter check
        $get_check_array = array (
            //Action
            'action'    => array('filter' => FILTER_SANITIZE_STRING ),

            //Id van huidige rij
            'id'        => array('filter' => FILTER_VALIDATE_INT ));

        //Get filtered input:
        $inputs = filter_input_array( INPUT_GET, $get_check_array );

        // RTS (Return to sender) - stuurt de values terug
        return $inputs;

    }

    public function save($input_array){
        try {
            //Check of gegeven values niet verstuurd zijn -> Throw (mist verplichte velden.)
            if (!isset($input_array['voornaam']) OR
            !isset($input_array['achternaam'])OR
            !isset($input_array['email'])OR
            !isset($input_array['adres'])OR
            !isset($input_array['postcode'])OR
            !isset($input_array['woonplaats'])OR
            !isset($input_array['telefoonnummer'])){
                // Verplichte velden zijn leeg
                throw new Exception("Verplichte velden zijn niet ingevuld") ;
            }

            // Check of de gegeven velden een waarde kleiner dan 1 hebben (0) -> Throw (Verplichte velden zijn leeg.)
            if ( (strlen($input_array['voornaam']) < 1) OR
                (strlen($input_array['achternaam']) < 1) OR
                (strlen($input_array['email']) < 1)OR
                (strlen($input_array['adres']) < 1)OR
                (strlen($input_array['postcode']) < 1)OR
                (strlen($input_array['woonplaats']) < 1)OR
                (strlen($input_array['telefoonnummer']) < 1)){
                // Verplichte velden zijn leeg
                throw new Exception("Verplichte velden zijn leeg") ;
            }
               
            // redfine values for insert
             $voornaam           = $input_array['voornaam'];
             $achternaam         = $input_array['achternaam'];
             $email              = $input_array['email'];
             $adres              = $input_array['adres'];
             $postcode           = $input_array['postcode'];
             $woonplaats         = $input_array['woonplaats'];
             $telefoonnummer     = $input_array['telefoonnummer'];

            // Insert query & check of values Unique bestaan.
            $sql = "INSERT INTO `".$this->getGebruikerTable()."` (voornaam, achternaam,email,adres,postcode,woonplaats,telefoonnummer) VALUES 
            ('$voornaam','$achternaam','$email','$adres','$postcode','$woonplaats','$telefoonnummer')";
            if (!($this->db->query($sql))) {
                return FALSE;
            }else{
               return TRUE;
            }
            // Indien een error, roept error gegevens op:
            if ( !empty($this->db->last_error) ){
                $this->last_error = $this->db->last_error;
                // Helaas, toon error bericht in users.php
                return FALSE;
            }
        } catch (Exception $exc) {
            // Roep exception melding aan (word hier niet gebruikt)
            // echo $this->$exc;
            return FALSE;
        }
        // Mooi, toon succes bericht in users.php
        return TRUE;
    }
}
?>