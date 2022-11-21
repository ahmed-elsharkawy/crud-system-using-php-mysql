<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";
$con = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$phone = "";
$address = "";
$errorMassage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == "GET"){
    // GET method: show the data of the client
    if(!isset($_GET["id"])){
        header("location: /projects/p5/myshop/index.php");
        exit;
    }
    $id = $_GET["id"];

    // read the row of the selected client from database table
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $con->query($sql);
    $row  = $result->fetch_assoc();

    if(!$row){
        header("location: /projects/p5/myshop/index.php");
        exit;
    }
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["addres"];
}else{

    // POST method: Update the data of the client
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do{
        if(empty($id) || empty($name) || empty($phone) || empty($address)){
            $errorMassage = "All the fields are required!";
            break;
        }
        $sql = "UPDATE clients ". 
                "SET name = '$name', email='$email', phone = '$phone', addres = '$address'". 
                "WHERE id = $id";
        $result = $con->query($sql);
        if(!$result){
            $errorMassage = "Invalid query: ". $con->error;
            break;
        }
        $successMessage = "Client updated correctly";
        header("location: /projects/p5/myshop/index.php");
        exit;
    }while(false);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>my shop</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center my-5"><span class="border px-4 py-3 rounded shadow">Edit User</span></h2>

        <?php
            if(!empty($errorMassage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> $errorMassage
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
                ";
            }

        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="Phone" name="phone" value="<?php echo $phone; ?>">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">User Adderss</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
        </div>

        <?php
        
            if(!empty($successMessage)){
                echo "
                <div class='alert alert-success' role='alert'>
                $successMessage
                </div>";
            }

        ?>

        <div class="mb-3 d-flex gap-3">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a type="submit" class="btn btn-warning" href="/projects/p5/myshop/index.php">Cancel</a>
        </form>
        </div>
        
    </div>
</body>
</html>