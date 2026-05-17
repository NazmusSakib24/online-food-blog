<?php

require_once('db.php');

function getReviewCount(){

    $con = getConnection();

    $sql = "SELECT COUNT(*) as total FROM reviews";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);

    return $row['total'];
}

?>