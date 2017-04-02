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
    <?php include_once('header.php'); ?>
    <body class="sales">
    <div class="row">
        <div class="col-sm-4"></div>
             <div class="col-sm-4">
        <div>
            <h2>update</h2>
            <form action="index.php" method="post" id="myForm">
                <div class="form-group-size">
                    <label for="sel1">retailer:</label>
                    <select name="retailer" class="form-control" id="retailer">
                        <?php if($r['retailer'] == 'Vero'){
                        echo '<option selected value="Vero">Vero</option>';
                        } else {
                            echo '<option value="Vero">Vero</option>';
                        }
                        if($r['retailer'] == 'Maxi'){
                            echo '<option selected value="Maxi">Maxi</option>';
                        } else {
                            echo '<option value="Maxi">Maxi</option>';
                        }
                        if ($r['retailer'] == 'Idea') {
                            echo '<option selected value="Idea">Idea</option>';
                        } else {
                            echo '<option value="Idea">Idea</option>';
                        }
                        ?>
                    </select>
                    <label for="sel1">product:</label>
                    <select name="product" class="form-control" id="product">
                        <?php if($r['product'] == 'kinder'){
                            echo '<option selected value="kinder">kinder</option>';
                        } else {
                            echo '<option value="kinder">kinder</option>';
                        }
                        if($r['product'] == 'milka'){
                            echo '<option selected value="milka">milka</option>';
                        } else {
                            echo '<option value="milka">milka</option>';
                        }
                        ?>
                    </select>
                    <label for="sel1">price:</label>
                    <select name="price" class="form-control" id="price">
                        <?php for($i = 1; $i < 200; $i++) {
                            if($r['price'] == $i ){
                                echo '<option selected value="' . $i . '">' . $i . ' din. </option>';
                            }
                            else{
                                echo '<option value="' . $i . '">' . $i . ' din. </option>';
                            }

                        } ?>
                    </select>
                    <label for="sel1">items:</label>
                    <select name="items" class="form-control" id="items">
                        <?php for($i = 1; $i < 200; $i++) {
                            if($r['items'] == $i){
                                echo '<option selected value="' . $i . '">' . $i . '</option>';
                            } else {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                        } ?>
                    </select>
                    <label for="sel1">quarter:</label>
                    <select name="quarter" class="form-control" id="quarter">
                        <?php for($i = 1; $i < 5; $i++) {
                            if($r['quarter'] == $i){
                                echo '<option selected value="' . $i . '">' . $i . '</option>';
                            } else {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                        } ?>
                    </select>
                </div><br/>
                <div class="text">
                <button type="submit" name="update" class="btn btn-success">Update</button> <button name="reset" type="reset" class="btn btn-default">Reset</button><br/>
                    <?php
                    echo '<a href="index.php"><button type="button" class="btn btn-link">home page</button></a>';
                    ?>
                </div>
            </form>
        </div>
    </div>
        <div class="col-sm-4"></div>
    </div>
    </body>


