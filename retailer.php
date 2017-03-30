<?php
include_once ('db.php');

if(isset($_POST['delete'])) {
    dbExecute('DELETE FROM `chocolate sale` WHERE id=?', array($_POST['delete_id']));
    echo "Record is deleted successfully.";
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

    <div class="container">
        <h2><?php echo $_GET['retailer']; ?></h2>
        <p><?php $r = $q->fetch(); $sum += $r['price'] * $r['items']; echo 'Total income of the retailer is ' . $sum . ' din (average income per quarter is ' . $sum/4 . ' din.)'; ?></p>
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
                <th>change</th>


            </tr>
            </thead>
            <tbody>
            <?php while ($r = $q->fetch()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($r['id']);?></td>
                    <td><?php echo htmlspecialchars($r['retailer']); ?></td>
                    <td><?php echo htmlspecialchars($r['product']); ?></a></td>
                    <td><?php echo htmlspecialchars($r['price']); ?></td>
                    <td><?php echo htmlspecialchars($r['items']); ?></td>
                    <td><?php echo htmlspecialchars($r['quarter']); ?></td>
                    <form action="" method="post">
                        <input type="hidden" name="delete_id" value"<?php echo htmlspecialchars($r['id']);?>"/>
                        <td><input type="submit" name="delete" value="Delete"/></td>
                    </form>
                    <td><a href="update.php?id=<?php echo htmlspecialchars($r['id']);?>">update</a></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
            <p><?php echo '<a href="index.php">back to home page</a>'; ?></p>
    </div>
    </body>
    </html>





