<?php

function db_fetch($statement, $args=array(), $fetch_one = False)
{

//    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $sql = $db->prepare($statement);
        $sql->execute($args);
        if ($fetch_one) {
            $result = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = $sql->fetchAll(PDO::FETCH_ASSOC); 
        }
        $db = null;
        return $result;
//    } catch (PDOException $e) {
//        print "Error!: " . $e->getMessage() . "<br />";
//        die();
//    }
}

function db_insert($statement, $args=array(), $scope_identity=False)
{

//    try {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $sql = $db->prepare($statement);
        $sql->execute($args);
        $db = null;

//    } catch (PDOException $e) {
//        print "Error!: " . $e->getMessage() . "<br />";
//        die();
//    }

}

?>
