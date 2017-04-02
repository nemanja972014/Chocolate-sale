<?php
    include_once('db.php');

    $total = loadValue('SELECT sum(items) as total_items FROM `chocolate sale`')['total_items'];
    $totalPerQuarter = $total / 4;
    $vero = loadValue('SELECT sum(items) as vero_items FROM `chocolate sale` WHERE retailer = \'Vero\'')['vero_items'];
    $maxi = loadValue('SELECT sum(items) as maxi_items FROM `chocolate sale` WHERE retailer = \'Maxi\'')['maxi_items'];
    $idea = loadValue('SELECT sum(items) as idea_items FROM `chocolate sale` WHERE retailer = \'Idea\'')['idea_items'];
    $milka = loadValue('SELECT sum(items) as milka_items FROM `chocolate sale` WHERE product = \'milka\'') ['milka_items'];
    $kinder = loadValue('SELECT sum(items) as kinder_items FROM `chocolate sale` WHERE product = \'kinder\'') ['kinder_items'];

    if (isset($_POST['submit'])) {
        dbExecute('INSERT INTO `chocolate sale` (retailer, product, price, items, quarter)
    VALUES (?, ?, ?, ?, ?)', array($_POST['retailer'], $_POST['product'], $_POST['price'], $_POST['items'], $_POST['quarter']));
    };
    ?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('header.php'); ?>
<body class="sales">
<div class="jumbotron text-center">
    <h1>Chocolate sale</h1>
    <p>Belgrade 2016.</p>
    <p><?php
        echo "Total items sold: " . $total . " (" . $totalPerQuarter . " average items sold per quarter)";
        ?></p>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h2>retailer - items sold</h2>
            <p><a href="retailer.php?retailer=Vero"><button type="button" class="btn btn-danger">Vero</button></a><?php echo " - " . $vero; ?> </p>
            <p><a href="retailer.php?retailer=Maxi"><button type="button" class="btn btn-danger">Maxi</button></a><?php echo " - " . $maxi; ?> </p>
            <p><a href="retailer.php?retailer=Idea"><button type="button" class="btn btn-danger">Idea</button></a><?php echo " - " . $idea; ?> </p>
            <h2>best retailer:</h2>
            <?php
            if($maxi > $vero && $maxi > $idea) {
                echo "Maxi sold the most items!";
            } else if($vero > $maxi && $vero > $idea){
                echo "Vero sold the most items!";
            } else  if($idea > $maxi && $idea > $vero){
                echo "Idea sold the most items";
            } else if ($maxi > $idea && $idea === $vero){
                echo "Maxi sold the most items!";
            } else if ($vero > $maxi && $maxi === $idea){
                echo "Vero sold the most items!";
            } else if ($idea > $vero && $vero === $maxi){
                echo "Idea sold the most items";
            } else if ($vero === $maxi && $maxi > $idea){
                echo "Vero and Maxi sold the most items!";
            } else if ($idea === $maxi && $maxi > $vero){
                echo "Maxi and Idea sold the most items!";
            } else if ($vero === $idea && $idea > $maxi){
                echo "Idea and Super Vero sold the most items!";
            } else {
                "Vero, Maxi and Idea are tied!";
            }
            ?>
            <h2>brand - itams sold</h2>
            <p><a href="product-details.php?product=kinder"><button type="button" class="btn btn-default">Kinder</button></a><?php echo " - " . $kinder; ?></p>
            <p><a href="product-details.php?product=milka"><button type="button" class="btn btn-default">Milka</button></a><?php echo " - " . $milka; ?></p>
            <h2>best brand:</h2>
            <?php
            if($milka > $kinder) {
                echo "Milka sold the most itams!";
            } else if ($milka < $kinder ){
                echo "Kinder sold the most items!";
            } else {
                echo "Milka and Kinder are tide!";
            }
            ?>
        </div>
        <div class="col-sm-4">
            <div class="container-size">
                <h2>insert new info</h2>
                <form action="index.php" method="post" id="myForm">
                    <div class="form-group">
                        <label for="sel1">retailer:</label>
                        <select name="retailer" class="form-control" id="retailer">
                            <option value="">--- Choose ---</option>
                            <option value="Vero">Vero</option>
                            <option value="Maxi">Maxi</option>
                            <option value="Idea">Idea</option>
                        </select>
                        <label for="sel1">product:</label>
                        <select name="product" class="form-control" id="product">
                            <option value="">--- Choose ---</option>
                            <option value="kinder">Kinder</option>
                            <option value="milka">Milka</option>
                        </select>
                        <label for="sel1">price:</label>
                        <select name="price" class="form-control" id="price">
                            <option value="">--- Choose ---</option>
                            <?php for($i = 1; $i < 200; $i++) {
                                echo '<option value="' . $i . '">' . $i . ' din. </option>';
                            } ?>
                        </select>
                        <label for="sel1">items:</label>
                        <select name="items" class="form-control" id="items">
                            <option value="">--- Choose ---</option>
                            <?php for($i = 1; $i < 200; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            } ?>
                        </select>
                        <label for="sel1">quarter:</label>
                        <select name="quarter" class="form-control" id="quarter">
                            <option value="">--- Choose ---</option>
                            <?php for($i = 1; $i < 5; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="text">
                    <p><input type="submit" class="btn btn-info" name="submit" value="Submit" onclick="checkForm()"> <button name="reset" type="reset" class="btn btn-default">Reset</button></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>