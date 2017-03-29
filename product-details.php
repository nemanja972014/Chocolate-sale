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

