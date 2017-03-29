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
