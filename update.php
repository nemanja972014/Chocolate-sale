    <?php
    include_once('db.php');

    $q = loadArray('SELECT *
    FROM `chocolate sale`
    WHERE id = ' . $_GET['id']);
        $r = $q->fetch();

    if(isset($_POST['update'])) {
        dbExecute('UPDATE `chocolate sale` SET retailer=?, product=?, price=?, items=?, quarter=? WHERE id=?', array($_POST['retailer'], $_POST['product'], $_POST['price'], $_POST['items'], $_POST['quarter'], $_GET['id']));
    } ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div>
    <h1>Update</h1>
        <form action="" method="post">
            <p> retailer:
                <input name="retailer" value="<?php echo htmlspecialchars($r['retailer']);?>"/>
            </p>
            <p> product:
                <input name="product" value="<?php echo htmlspecialchars($r['product']); ?>"/>
            </p>
            <p> price:
               <input name="price" value="<?php echo htmlspecialchars($r['price']); ?>"/>
            </p>
            <p> items:
                <input name="items" value="<?php echo htmlspecialchars($r['items']); ?>"/>
            </p>
            <p> quarter:
                <input name="quarter" value="<?php echo htmlspecialchars($r['quarter']); ?>"/>
            </p>
            <input type="submit" name="update" value="Update"/>
        </form>

    <?php
    echo '<a href="index.php">vrati na index</a>';
    ?>
    </div>
    </body>
