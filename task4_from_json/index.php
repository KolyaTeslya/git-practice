<?php
echo '<pre>';
$res = @file_get_contents('posts.json');
if (empty($res)) {
    echo "Отсутствует файл";
} else {
    echo "<br>";
    $data = json_decode($res, true);
    $data = $data['data'];

    if (empty($data)) {
        echo "Отсутствует data";
    }

    $page = $_GET['page'] ?? 1;
    $limit = 5;
    $offset = ($page - 1) * $limit;
    $total_items = count($data);
    $total_pages = ceil($total_items / $limit);
    $final = array_splice($data, $offset, $limit);
}
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


<table border="1" cellpadding="10">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Content</th>
    </tr>
    <?php foreach ($final as $key => $value):?>
        <?php switch (!is_array($key)):
            case 0:
                echo "Данного ключа не существует";
                break;
            default:
                ?>
            <?php endswitch; ?>
        <tr bgcolor="<?php print_r($key % 2 ? "#90EE90" : "#FFFFFF") ?>">
            <?php foreach ($value as $index => $element): ?>
                <?php if ($index == 'title' or $index == 'author' or $index == 'content') { ?>
                    <td>
                        <?php print_r($element) ?>
                    </td>
                <?php } ?>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<span style="display: table">
<?php
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$x1 = substr($url, strlen($url)-1, 1);
?>
<?php for ($x = 1; $x <= $total_pages; $x++): ?>

    <?php

    if ($x1 == $x) {
        echo '<a class="btn btn-danger" href="index.php?page='. $x.'">' . $x.'</a>';
    } else {
        echo '<a class="btn btn-warning" href="index.php?page='. $x.'">' . $x.'</a>';
    }
    ?>

<?php endfor; ?>
</span>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>

