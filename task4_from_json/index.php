<?php
echo '<pre>';
$res = file_get_contents('posts.json');

echo "<br>";
$data = json_decode($res, true);
$data1 = $data['data'];

$page = !isset($_GET['page']) ? 1 : $_GET['page'];
$limit = 5;
$offset = ($page - 1) * $limit;
$total_items = count($data1);
$total_pages = ceil($total_items / $limit);
$final = array_splice($data1, $offset, $limit);
?>

<table border="1" cellpadding="10">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Content</th>
    </tr>
    <?php foreach ($final as $key => $value): ?>
        <tr bgcolor="<?php echo $key % 2 ? "#90EE90" : "#FFFFFF"; ?>">
            <?php foreach ($value as $index => $element): ?>
                <?php if ($index == 'title' or $index == 'author' or $index == 'content') { ?>
                    <td>
                        <?php echo $element; ?>
                    </td>
                <?php } ?>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<span style="display: table">
<?php for ($x = 1; $x <= $total_pages; $x++): ?>
    <a style="padding-right:5px" href='index.php?page=<?= $x; ?>'><?= $x; ?></a>
<?php endfor; ?>
</span>
