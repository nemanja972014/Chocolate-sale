# Chocolate-sale
3 retailers, 2 brands
<?php
include_once('db.php');

$total = loadValue('SELECT sum(items) as total_items FROM `chocolate sale`')['total_items'];
$totalPerQuarter = $total / 4;
$vero = loadValue('SELECT sum(items) as vero_items FROM `chocolate sale` WHERE retailer = \'Vero\'')['vero_items'];
$maxi = loadValue('SELECT sum(items) as maxi_items FROM `chocolate sale` WHERE retailer = \'Maxi\'')['maxi_items'];
$idea = loadValue('SELECT sum(items) as idea_items FROM `chocolate sale` WHERE retailer = \'Idea\'')['idea_items'];
$milka = loadValue('SELECT sum(items) as milka_items FROM `chocolate sale` WHERE product = \'milka\'') ['milka_items'];
$kinder = loadValue('SELECT sum(items) as kinder_items FROM `chocolate sale` WHERE product = \'kinder\'') ['kinder_items'];
echo $total . '-' . $vero . $maxi . $idea . $milka . $kinder;
if (isset($_POST['submit'])) {
    dbExecute('INSERT INTO `chocolate sale` (retailer, product, price, items, quarter)
VALUES (?, ?, ?, ?, ?)', array($_POST['retailer'], $_POST['product'], $_POST['price'], $_POST['items'], $_POST['quarter']));
}

?>


<html>

<head><?php echo "<strong>CHOCOLATE SALE</strong> - Belgrade 2016." ?></head>
<body>
<h1>Sale of the top 3 retailers:</h1>
<p>*analysis assumes that the participation of other retailers on this market is negligible</p>

<?php
echo "Total items sold: " . $total . " (" . $totalPerQuarter . " average items sold per quarter)";
?>

<p><a href="retailer.php?retailer=Vero">Vero</a><?php echo " - " . $vero; ?> </p>
<p><a href="retailer.php?retailer=Maxi">Maxi</a><?php echo " - " . $maxi; ?> </p>
<p><a href="retailer.php?retailer=Idea">Idea</a><?php echo " - " . $idea; ?> </p>

<h2>Brands:</h2>
<p><a href="product-details.php?product=milka">Milka</a><?php echo " - " . $milka; ?></p>
<p><a href="product-details.php?product=kinder">Kinder</a><?php echo " - " . $kinder; ?></p>

<h3>Insert:</h3>
<form action="index.php" method="post">
    <p> retailer:
        <select name="retailer">
            <option value="Maxi">Maxi</option>
            <option value="Idea">Idea</option>
            <option value="Vero">Vero</option>
        </select>>
    </p>
    <p> product:
        <select name="product">
            <option value="milka">Milka</option>
            <option value="kinder">Kinder</option>
         </select>
    </p>
    <p> price:
        <select name="price">
            <?php for($i = 5; $i < 1000; $i += 5) {
                echo '<option value="' . $i . '">' . $i . ' din. </option>';
            } ?>
        </select>
    </p>
    <p> items:
        <select name="items">
            <?php for($i = 1; $i < 200; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            } ?>
    </select>
    </p>
    <p> quarter:
        <select name="quarter">
            <?php for($i = 1; $i < 5; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            } ?>
        </select>
</p>
    <input type="submit" name="submit" value="Submit"/>
</form>


</body>
</html>

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

<?php
include_once ('db.php');
$q = loadArray('SELECT *
        FROM `chocolate sale` 
        WHERE product =  \'' . $_GET['product'] . '\'
   ORDER BY id');
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
    </tr>
    </thead>
    <tbody>
    <?php while ($r = $q->fetch()): ?>
        <tr>
            <td><?php echo htmlspecialchars($r['id']); ?></td>
            <td><?php echo htmlspecialchars($r['retailer']); ?></td>
            <td><?php echo htmlspecialchars($r['product']);?></td>
            <td><?php echo htmlspecialchars($r['price']); ?></td>
            <td><?php echo htmlspecialchars($r['items']); ?></td>
            <td><?php echo htmlspecialchars($r['quarter']); ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>



<?php
echo '<a href="index.php">vrati na index</a>';

<?php
include_once ('db.php');
$q = loadArray('SELECT *
        FROM `chocolate sale` 
        WHERE product =  \'' . $_GET['product'] . '\'
   ORDER BY id');
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
    </tr>
    </thead>
    <tbody>
    <?php while ($r = $q->fetch()): ?>
        <tr>
            <td><?php echo htmlspecialchars($r['id']); ?></td>
            <td><?php echo htmlspecialchars($r['retailer']); ?></td>
            <td><?php echo htmlspecialchars($r['product']);?></td>
            <td><?php echo htmlspecialchars($r['price']); ?></td>
            <td><?php echo htmlspecialchars($r['items']); ?></td>
            <td><?php echo htmlspecialchars($r['quarter']); ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>



<?php
echo '<a href="index.php">vrati na index</a>';

<
?php
function getPDO(){
    return new PDO("mysql:host=localhost;dbname=proba", 'root', '');
}
function loadValue($query){
    $pdo = getPDO();
    $q = $pdo->query($query);
    $row = $q->fetch();
    return $row;
}
function loadArray($query){
    $pdo = getPDO();
    $q = $pdo->query($query);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    return $q;
}

function dbExecute($query, $values) {
    $pdo = getPDO();
    $statement = $pdo->prepare($query);
    for($i = 0; $i < count($values); $i++) {
        $statement->bindValue($i + 1, $values[$i]);
    }
    $statement->execute();
}
