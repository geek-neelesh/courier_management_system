<?php
session_start();
require_once"dbconfig.php";
if(!isset($_SESSION['adminId'])){
 header('location:admin_login.php');
}
?>
<?php
if(isset($_POST["update_status"])){
    $track_status_id=$_POST["track_id"];
    $options=$_POST["select_value"];
    $insertquery_for_update_status= "UPDATE `parcel_table` SET status='$options' WHERE parcel_id=$track_status_id";
    $result=mysqli_query($con,$insertquery_for_update_status);
    if($result){
        echo"
        <script>
        alert('status is updated successfully')
        </script>
        ";
    }
    else{
        echo"
        <script>
        alert('status is not updated')
        </script>
        ";
        
    }
    header('location:admin_panel.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="admin_and_user_page.css" rel="stylesheet">

</head>
<body>
    <div class="admin_nav">
    <h2>Welcome <?php echo $_SESSION['adminId']?></h2>
    <div class="logout_btn">
    <a href="index.html"class="btn btn-outline-danger">LOG OUT</a>
</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light my-5">
            <h1>admin parcel history</h1>
        </div>

        <div class="col-lg-8">
        <table class="table">
  <thead class="text-center">
    <tr>
      <th scope="col">parcel_id</th>
      <th scope="col">sender_name</th>
      <th scope="col">sender_address</th>
      <th scope="col">sender_contact</th>
      <th scope="col">receiver_name</th>
      <th scope="col">receiver_address</th>
      <th scope="col">receiver_contact</th>
      <th scope="col">parcel_length</th>
      <th scope="col">parcel_width</th>
      <th scope="col">parcel_heigth</th>
      <th scope="col">parcel_weigth</th>
      <th scope="col">courier_status</th>
      <th scope="col">update_status</th>
    </tr>
  </thead>
  <tbody class="text-center">
      <?php
      $select_parcel_query="SELECT * FROM parcel_table ";
      $parcel_query=mysqli_query($con,$select_parcel_query);
      while($parcel_results=mysqli_fetch_assoc($parcel_query)){

      ?>
          <tr>
          <td><?php echo$parcel_results['parcel_id']; ?></td>
          <td><?php echo$parcel_results['sender_name']; ?></td>
          <td><?php echo$parcel_results['sender_address']; ?></td>
          <td><?php echo$parcel_results['sender_contact']; ?></td>
          <td><?php echo$parcel_results['receiver_name']; ?></td>
          <td><?php echo$parcel_results['receiver_address']; ?></td>
          <td><?php echo$parcel_results['receiver_contact']; ?></td>
          <td><?php echo$parcel_results['parcel_length']; ?></td>
          <td><?php echo$parcel_results['parcel_width']; ?></td>
          <td><?php echo$parcel_results['parcel_height']; ?></td>
          <td><?php echo$parcel_results['parcel_weight'];?></td>
          <td><?php echo$parcel_results['status'];?></td>
          <td>
              <form action="admin_panel.php"method="post">
                  <input type="hidden"name="track_id" value="<?php echo$parcel_results['parcel_id']; ?>">
                  <?php 
                  $options=array('picked up','delivery is in process','delivered');
                  echo"<select name='select_value'>";
                  foreach($options as $opt) {
                      echo "<option value='$opt'>$opt</option>";
                  }
                  echo"</select>";
                  ?>
                  <button class="btn btn-primary"type="submit"name="update_status">update</button>


              </form>
       
         </td>
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