<!DOCTYPE html>
<html>
<body>

<form action="index.php" method="post">
    <p>Рассчитать время от текущего до: <input type="datetime-local" name="calculate" /></p>
    <p><input type="submit" value="Calculate" /></p>
</form>

<?php
$start = $_POST["data"];

$startTime = new Datetime($start);
$endTime = new DateTime();

$diff = $endTime->diff($startTime);

echo 'Прошло время от текущего до заданного:<br/><br/>';
echo 'Years ago: '.$diff->format('%y').'<br/>';
echo 'Days ago: '.$diff->format('%d').'<br/>';
echo 'Hours ago: '.$diff->format('%H').'<br/>';
echo 'Minutes ago: '.$diff->format('%i').'<br/>';


?>

</body>
</html>