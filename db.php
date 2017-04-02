<?php
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


