<?php

require_once "Maker.php";
require_once "JsonMaker.php";
require_once "CsvMaker.php";
require_once "PhpMaker.php";
require_once "UrlConfigurator.php";

$variantsOfResources = [
    'addresses',
    'books',
    'companies',
    'credit_cards',
    'images',
    'persons',
    'places',
    'products',
    'texts',
    'users',
];


$resultOfExport = "";
$outputType = "";
$resource = "";
$locale = "";
$quantity = 1;
$url = "";
$result = "";


if (isset($_POST['resource'])) {

    if (!empty($_POST['resource'])) {
        $resource = $_POST['resource'];
    }

    if (!empty($_POST['_locale'])) {
        $locale = $_POST['_locale'];
    }

    if (!empty($_POST['_quantity'])) {
        $quantity = $_POST['_quantity'];
    }

    if (!empty($_POST['format'])) {
        $outputType = $_POST['format'];
    }

    $url = UrlConfigurator::makeUrl($resource, $quantity, $locale);

    $response = file_get_contents($url);
    $result = json_decode($response, true)['data'];

    $export = new ($outputType . 'Maker')();
    $result = $export->make($result);

    $extension = strtolower($outputType);
    $file = "array.$extension";

    $stat = fstat($result);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . $stat['size']);
    fpassthru($result);
    exit;


}

?>

<!DOCTYPE html>

<head>
    <title>Collections</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
    div {
        column-gap: 10px;
    }


</style>

<body class="mx-auto w-50">

<form action="" method="post">


    <div class="container">
        <br>
        <div class="form-group form-inline">
            <label for="_quantity">Получить </label>
            <input type="number" name="_quantity" min="1" max="100" step="1" class="form-control" id="amountInput"
                   value="<?= $quantity ?>">
            <label for="resource">строк данных типа </label>
            <select class="form-control" name="resource" id="test_resource">
                <?php foreach ($variantsOfResources as $variant) { ?>
                    <option value="<?= $variant ?>">
                        <?= $resource == $variant  ?> <?= $variant ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group form-inline">
            <label for="_locale">на языке</label>
            <select class="form-control" name="_locale">
                <option value="uk-UA" <?= $locale == "ua_UA" ?>>Українська</option>
                <option value="en-US" <?= $locale == "en_US" ?>>English</option>
                <option value="de-DE" <?= $locale == "ge_GE" ?>>German</option>
                <option value="fr-FR" <?= $locale == "fr_FR" ?>>French</option>
            </select>
            <label for="format">в формате</label>
            <select class="form-control" name="format">
                <option value="Csv" <?= $outputType == "Csv" ?> >*.csv</option>
                <option value="Json" <?= $outputType == "Json"  ?> >*.json</option>
                <option value="Php" <?= $outputType == "Php" ?> >*.php</option>
            </select>
            <button class="btn-primary">Скачать </button>
        </div>
    </div>
</form>
</div>

</body>
</html>
