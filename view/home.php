<?php 
require_once '../model/gebruiker.class.php';
$gebruiker = new Gebruiker();
// Define action_url
$action_url =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Get the GET data in filtered array
$get_array = $gebruiker->getGetValues();

/* Na checken     */
// Get the POST data in filtered array
$post_array = $gebruiker->getPostValues();

// Collect Errors
$error = FALSE;
// Check the POST data
if (!empty($post_array['verzenden'])) {

    // Check the add form:
        $add = FALSE;
    // Save event types
    $result = $gebruiker->save($post_array);
    if ($result) {
        // Save was succesfull
        $add = TRUE;
    } else {
        // Indicate error
        $error = TRUE;
    }
}
var_dump($post_array);
?>
<html>
<head>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
<style>
    .row{
    margin-top:20px;
    }
</style>
</head>
<body>
    <div class="container">
<div class="row">
    <h2>gebruiker Crud</h2>
<div class="col-6">
    <form method="post" action="<?=$action_url;?>">
        <div class="row">
            <div class="col-6">
                <label>Voornaam</label>
                <input type="text" class="form-control" name="voornaam" placeholder="Voornaam" value="">
            </div>
            <div class="col-6">
                <label>Achternaam</label>
                <input type="text" class="form-control" name="achternaam" placeholder="Achternaam" value="">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email" value="">
            </div>
            <div class="col-6">
                <label>Telefoonnummer</label>
                <input type="text" class="form-control" name="telefoonnummer" placeholder="Telefoonnummer" value="">
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <label>Adres</label>
                <input type="text" class="form-control" name="adres" placeholder="Adres" value="">
            </div>
            <div class="col-4">
                <label>Postcode</label>
                <input type="text" class="form-control" name="postcode" placeholder="Postcode" value="">
            </div>
            <div class="col-4">
                <label>Woonplaats</label>
                <input type="text" class="form-control" name="woonplaats" placeholder="Woonplaats" value="">
            </div>
        </div>
     <div class="row">
         <div class="col-6">
             <input type="submit" name="verzenden" class="btn btn-primary">
         </div>
     </div>
    </form>
</div>
<div class="col-6">
    <table class="table">
        <th>Naam</th>
        <th>Email</th>
        <th>Telefoonnummer</th>
        <th>Vestiging</th>
        <th colspan="2">Acties</th>
    </table>
</div>
</div>
</div>
</body>
</html>