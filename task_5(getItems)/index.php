<?php
require_once "Collection.php";
require_once "CollectionExport.php";

require_once "UsersCollection.php";
require_once "ProductsCollection.php";
require_once "PlacesCollection.php";

require_once "JsonCollectionExport.php";
require_once "CsvCollectionExport.php";


$resultOfExport = "";
$collection="";

if (isset($_POST['Collection'])) {

    if (!empty($_POST['Collection'])) {
        $collection = $_POST['Collection'];
    }

    if (!empty($_POST['TypeExport'])) {
        $export = $_POST['TypeExport'];
    }

    $CollectionForExport = new $collection();
    $exportMechanizm = new $export();
    $resultOfExport = $exportMechanizm->export($CollectionForExport);

}


?>


<!DOCTYPE html>
<head>
    <title>Collections</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
</head>

<body>


<form action="" method="post">
    <select name="Collection">
        <?= $collection == "UsersCollection" ?>
        <option value="UsersCollection" <?= $collection == "UsersCollection" ?>> UsersCollection</option>
        <option value="ProductsCollection" <?= $collection == "ProductsCollection" ?>> ProductsCollection</option>
        <option value="PlacesCollection" <?= $collection == "PlacesCollection"?>>PlacesCollection</option>
    </select>
    <br>
    <br>
    <div>
        <button class="btn btn-primary" name="TypeExport" type="submit" value="CsvCollectionExport">CSV</button>
        <button class="btn btn-primary" name="TypeExport" type="submit" value="JsonCollectionExport">JSON</button>
    </div>
    <br>
    <div>
        <h5>RESULT: <?= print_r($resultOfExport) ?></h5>
    </div>
</form>


</body>
</html>