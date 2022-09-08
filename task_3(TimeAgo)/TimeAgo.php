<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<h1>Time Ago</h1>

<form action="" method="post">
    <div class="col-sm-6">
        <label for="firstName" class="form-label">Calculate your date. </br> Write your date: </label>
        <input type="datetime-local" class="form-control" name="date" placeholder=""
               value="<?php echo $_POST['date'] ?? ''; ?>" required="">
        <br>
        <button class="w-50 btn btn-primary btn-lg" type="submit">Calculate</button>
    </div>
</form>

<?php

date_default_timezone_set("Europe/Helsinki");

if (isset($_POST['date'])) {
    $startDate = $_POST['date'];
    $now = time();
    $user_time_unix = strtotime($startDate);
    if ($user_time_unix > $now) {
        echo "Error! Your time is bigger than now!";
    } else {
        $datediff = $now - $user_time_unix;
        echo "<span>Years ago: </span>";
        echo floor($datediff / (365 * 60 * 60 * 24));
        echo "<br>";
        echo "<span>Days ago: </span>";
        echo round($datediff / (60 * 60 * 24));
        echo "<br>";
        echo "<span> Hours ago: </span>";
        echo round($datediff / (60 * 60));
        echo "<br>";
        echo "<span>Minutes ago: </span>";
        echo round($datediff / 60);
        echo "<br>";
    }
}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>
</html>