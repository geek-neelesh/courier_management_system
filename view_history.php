<?php 
session_start();
require_once"dbconfig.php"
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view parcel history</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="admin_and_user_page.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="admin_nav">
    <h2 class="heading2">Welcome <?php echo $_SESSION['UserId']?></h2>
    <div class="logout_btn">
    <a href="user_page.php"class="btn btn-outline-success">ADD Parcel</a>
    <a href="index.html"class="btn btn-outline-danger">LOG OUT</a>
</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light my-5">
            <h1>MY parcel history</h1>
        </div>

        <div class="col-lg-8">
        <table class="table">
  <thead class="text-center">
    <tr>
      <th scope="col">parcel_id</th>
      <th scope="col">sender_contact</th>
      <th scope="col">receiver_name</th>
      <th scope="col">receiver_address</th>
      <th scope="col">receiver_contact</th>
      <th scope="col">parcel_length</th>
      <th scope="col">parcel_width</th>
      <th scope="col">parcel_heigth</th>
      <th scope="col">parcel_weigth</th>
      <th scope="col" >courier_status</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody class="text-center">
      <?php
      $sender_name=$_SESSION["UserId"];
      $select_parcel_query="SELECT * FROM parcel_table WHERE sender_name= '$sender_name'";
      $parcel_query=mysqli_query($con,$select_parcel_query);
      while($parcel_results=mysqli_fetch_assoc($parcel_query)){

      ?>
          <tr>
          <td><?php echo$parcel_results['parcel_id']; ?></td>
          <td><?php echo$parcel_results['sender_contact']; ?></td>
          <td><?php echo$parcel_results['receiver_name']; ?></td>
          <td><?php echo$parcel_results['receiver_address']; ?></td>
          <td><?php echo$parcel_results['receiver_contact']; ?></td>
          <td><?php echo$parcel_results['parcel_length']; ?></td>
          <td><?php echo$parcel_results['parcel_width']; ?></td>
          <td><?php echo$parcel_results['parcel_height']; ?></td>
          <td><?php echo$parcel_results['parcel_weight'];?></td>
          <td><?php echo$parcel_results['status'];?></td>
          <td><a href="update.php?parcel_id=<?php echo$parcel_results['parcel_id'];?> "><i class="fas fa-user-edit"></i></a></td>
          <td><a href="delete.php?parcel_id=<?php echo$parcel_results['parcel_id'];?> "><i class="fas fa-trash"></i></a></td>
          <td></td>
          </tr>
      <?php

      }
      ?>
    
  </tbody>
</table>

        </div>

    </div>
</div>
    
</body>
</html>