<?php
    include_once ('db.php');
    $q = loadArray('SELECT *
            FROM `chocolate sale` 
            WHERE product =  \'' . $_GET['product'] . '\'
       ORDER BY id');
    $sum = 0;
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <?php include_once('header.php'); ?>
    <body class="sales">
    <div class="container">
    <h2><?php echo $_GET['product']; ?></h2>
    <p><?php $r = $q->fetch(); $sum += $r['price'] * $r['items'];  echo 'Total income of seling ' . $_GET['product'] . ' chocolate is ' . $sum . ' din (average income per quarter is ' . $sum/4 . ' din)'; ?></p>
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
        <p><?php echo '<a href="index.php"><button type="button" class="btn btn-link">home page</button></a>'; ?></p>
</div>