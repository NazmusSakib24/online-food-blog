<?php
    $host = "127.0.0.1";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "food_blog_final";

    function getConnection()
    {
        global $host;
        global $dbuser; 
        global $dbpassword; 
        global $dbname;
        $con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

        return $con;
    }
?>