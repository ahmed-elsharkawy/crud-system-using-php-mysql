<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>my shop</title>
</head>
<body>
    <h2 class="text-center py-5"><span class="border px-4 py-3 rounded shadow">My Shop</span></h2>

    <div class="container">
        <a class="btn btn-info" href="/projects/p5/myshop/adduser.php">Add User</a>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "myshop";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check Connection
        if($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
        }

        // mysql query
        $sql = "SELECT * FROM clients";
        $result = $conn->query($sql);

        // Check comming data
        if(!$result){
            die("Invalid qurey: ".$conn->error);
        }

        // read data of each row
        while($row = $result->fetch_assoc()){

            echo "
            <tr>
            <th scope='row'>$row[id]</th>
            <td>$row[name]</td>
            <td>$row[email]</td>
            <td>$row[phone]</td>
            <td>$row[addres]</td>
            <td>$row[created_at]</td>
            <td>
              <a class='btn btn-warning my-1' href='/projects/p5/myshop/edituser.php?id=$row[id]'>Edit</a>
              <a class='btn btn-danger my-1' href='/projects/p5/myshop/deleteuser.php?id=$row[id]'>Delete</a>
            </td>
          </tr>
            ";
        }

    ?>
  </tbody>
</table>
</div>

</body>
</html>