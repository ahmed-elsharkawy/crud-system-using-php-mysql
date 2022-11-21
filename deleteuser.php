<?php
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $id = $_GET["id"];

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'myshop';

        $conn = new mysqli($servername, $username, $password, $database);

        if($conn->connect_error){
            die("Connection faild: ". $conn->connect_error); 
        }

        $sql = "DELETE FROM clients WHERE id = $id";
        $result = $conn->query($sql);
        header("location: /projects/p5/myshop/index.php");
        exit;
    }

?>