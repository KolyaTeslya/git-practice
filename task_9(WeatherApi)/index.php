<?php

require_once "Weather.php";


$url = 'https://api.openweathermap.org/data/2.5/weather';

$options = array(
    'q' => 'Kharkiv',
    'APPID' => 'c76b5b2e59630d2b2fcef95b5ffebdaa',
    'units' => 'metric',
    'lang' => 'en'
);


$res = new Weather();
$res2 = $res->getWeather($url,$options);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>

<div class="container">

    <table class="table">
        <thead>
        <tr>
            <th scope="col">City</th>
            <th scope="col">Temperature</th>
            <th scope="col">Humidity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (array($res2) as $key => $value) {?>
        <tr>
            <td>
                <?= $value['name'] ?>
            </td>
            <td>
                <?= $value['main']['temp'] ?>
            </td>
            <td>
                <?= $value['main']['humidity'] ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<span style="display: table">


</span>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
