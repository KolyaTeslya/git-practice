<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<h1>Time Ago</h1>

<form action="index.php" method="post">
    <div class="col-sm-6">
        <label for="firstName" class="form-label">Рассчет времени: от введенного времени до текущего</label>
        <input type="datetime-local" class="form-control" name="data" placeholder="" value="" required="">
        <br>
        <button class="w-50 btn btn-primary btn-lg"  type="submit">Calculate</button>
    </div>
</form>

<?php
$start = $_POST["data"];

$startTime = new Datetime($start);
$endTime = new DateTime();

$diff = $endTime->diff($startTime);
if($_POST['data']){
    echo '<br/><br/>Прошло с указанного момента до текущего:<br/><br/>';
    echo 'Years ago: '.$diff->format('%y').'<br/>';
    echo 'Days ago: '. 30 * $diff->format('%m') + $diff->format('%d').'<br/>';
    echo 'Hours ago: '.$diff->format('%H').'<br/>';
    echo 'Minutes ago: '.$diff->format('%i').'<br/>';
}


?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>