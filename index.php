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
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chocolate sale</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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
            <p><a href="retailer.php?retailer=Vero"><button type="button" class="btn btn-danger">Super Vero</button></a><?php echo " - " . $vero; ?> </p>
            <p><a href="retailer.php?retailer=Maxi"><button type="button" class="btn btn-danger">Maxi</button></a><?php echo " - " . $maxi; ?> </p>
            <p><a href="retailer.php?retailer=Idea"><button type="button" class="btn btn-danger">Idea</button></a><?php echo " - " . $idea; ?> </p>
        </div>
        <div class="col-sm-4">
            <h2>brand - itams sold</h2>
            <p><a href="product-details.php?product=kinder"><button type="button" class="btn btn-default">Kinder</button></a><?php echo " - " . $kinder; ?></p>
            <p><a href="product-details.php?product=milka"><button type="button" class="btn btn-default">Milka</button></a><?php echo " - " . $milka; ?></p>
        </div>
        <div class="col-sm-4">
            <h2>best retailer:</h2>
                <?php
                if($maxi > $vero && $maxi > $idea) {
                    echo "Maxi sold the most items!";
                } else if($vero > $maxi && $vero > $idea) {
                    echo "Super Vero sold the most items!";
                } else {
                    echo "Idea sold the most items";//nije dovrsena, razmisljam kako da ubacim kada su neke 2 jednake
                }
                ?>
            <h2>best product:</h2>
                <?php
                if($milka > $kinder) {
                    echo "Milka sold the most itams!";
                } else {
                    echo "Kinder sold the most items!";
                }
                ?>
        </div>
    </div>

    <div class="container">
        <h2>insert new info</h2>
        <table class="table">
            <thead>
            <tr>
                <th>category</th>
                <th>value</th>
            </tr>
            </thead>
            <tbody>
            <form action="index.php" method="post">
            <tr>
                <td>retailer:</td>
                <td>
                    <select name="retailer">
                        <option value="Maxi">Maxi</option>
                        <option value="Idea">Idea</option>
                        <option value="Vero">Vero</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>product:</td>
                <td>
                    <select name="product">
                        <option value="milka">Milka</option>
                        <option value="kinder">Kinder</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>price:</td>
                <td>
                    <select name="price">
                        <?php for($i = 1; $i < 200; $i++) {
                            echo '<option value="' . $i . '">' . $i . ' din. </option>';
                        } ?>
                    </select>
                </td>
            </tr>
                <tr>
                    <td>items:</td>
                    <td>
                        <select name="items">
                            <?php for($i = 1; $i < 200; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>quarter:</td>
                    <td>
                        <select name="quarter">
                            <?php for($i = 1; $i < 5; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn btn-info" name="submit" value="Submit">
                    </td>
                </tr>
            </form>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>