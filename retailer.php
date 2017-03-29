<?php
include_once ('db.php');

if(isset($_POST['delete'])) {
    dbExecute('DELETE FROM `chocolate sale` WHERE id=?', array($_POST['delete_id']));
    echo "Record is deleted successfully.";
} else {
    echo "erorr";
}

$q = loadArray('SELECT *
        FROM `chocolate sale` 
        WHERE retailer = \'' . $_GET['retailer'] . '\' ORDER BY id');
$Retailer_milka_price = loadArray('SELECT price
        FROM `chocolate sale` 
        WHERE retailer = \'' . $_GET['retailer'] . '\' and product = \'milka\'');
$Retailer_kinder_price = loadArray('SELECT price
        FROM `chocolate sale` 
        WHERE retailer = \'' . $_GET['retailer'] . '\' and product = \'kinder\'');
$Retailer_milka_items = loadArray('SELECT items
        FROM `chocolate sale` 
        WHERE retailer = \'' . $_GET['retailer'] . '\' and product = \'milka\'');
$Retailer_kinder_items = loadArray('SELECT items FROM `chocolate sale` 
        WHERE retailer = \'' . $_GET['retailer'] . '\' and product = \'kinder\'');

$sum = 0;


?>

    <table class="table table-bordered table-condensed">
        <thead>
        <tr>
            <th>id</th>
            <th>retailer</th>
            <th>product</th>
            <th>price</th>
            <th>items</th>
            <th>quarter</th>
            <th>izbrisi</th>

        </tr>
        </thead>
        <tbody>
        <?php while ($r = $q->fetch()): ?>
            <?php
            $sum += $r['price'] * $r['items'];
            ?>
            <tr>
                <td><?php echo htmlspecialchars($r['id']);?></td>
                <td><?php echo htmlspecialchars($r['retailer']); ?></td>
                <td><?php echo htmlspecialchars($r['product']); ?></a></td>
                <td><?php echo htmlspecialchars($r['price']); ?></td>
                <td><?php echo htmlspecialchars($r['items']); ?></td>
                <td><?php echo htmlspecialchars($r['quarter']); ?></td>
                <form action="" method="post">
                    <input type="hidden" name="delete_id" value='<?php echo htmlspecialchars($r['id']);?>'/>
                <td><input type="submit" name="delete" value="Delete"/></td>
                </form>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>


<?php
echo 'sumčina: ' . $sum;
function quarter($x, $y, $m, $n)
{
    $z = $x * $y + $m * $n;
    return $z;
};
echo "Total income from chocolate sale in first quarter is ", quarter(125, 78, 155, 53), " din.<br/>";
echo "Total income from chocolate sale in second quarter is ", quarter(125, 91, 155, 54), " din.<br/>";
echo "Total income from chocolate sale in third quarter is ", quarter(125, 101, 155, 77), " din.<br/>";
echo "Total income from chocolate sale in fourth quarter is ", quarter(125, 56, 155, 67), " din.<br/>";

function average($x, $y, $m, $n) {
    return ($x + $y + $m + $n)/4;
};
echo "Average income from chocolate sale per quarter is ", average(quarter(125, 78, 155, 53), quarter(125, 91, 155, 54), quarter(125, 101, 155, 77), quarter(125, 56, 155, 67)), " din.<br/>";
echo '<a href="index.php">vrati na index</a>';
