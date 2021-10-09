<?php
require_once"dbconfig.php"
?>
<?php 
$username=$password=$confirmpassword=$username_err=$password_err=$confirmpassword="";
if(isset($_POST["register"])){
if(empty(trim($_POST["username"]))){
  $username_err="username is empty";
}
else{
  $bind_username=trim($_POST["username"]);
  $sql="SELECT * FROM `users_table` WHERE `username`=? ";
  if($stmt=mysqli_prepare($con,$sql)){
    mysqli_stmt_bind_param($stmt,"s",$bind_username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt)==1){
      $username_err="username already exits";

    }else{
     $username=trim($_POST["username"]);
      
    }

  }else{
    echo"<script>alert('sql query is not prepared')</script>";
  }
  mysqli_stmt_close($stmt);
}
if(empty(trim($_POST["password"]))){
  $password_err="password is empty";
}
else{
  $password=trim($_POST["password"]);

}
if(trim($_POST["confirmpassword"])!=trim($_POST["password"])){
  $confirmpassword_err="passwords do not match";
}
if(empty($username_err) && empty($password_err) && empty($confirmpassword_err)){
 // $password=password_hash($password,PASSWORD_DEFAULT);
  $sql="INSERT INTO users_table(username,password) values(?,?)";
  if($stmt=mysqli_prepare($con,$sql)){
  mysqli_stmt_bind_param($stmt,"ss",$username,$password);
  if(mysqli_stmt_execute($stmt)){
    header("location:login.php");
  }
  else{
    echo"<script>alert('something went wrong ...try registering again')</script>";
  }
  
  }
  mysqli_stmt_close($stmt);


}
mysqli_close($con);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="register.css"rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row ">
            <div class="col-12">
            <form class="form-container "action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'])?>"method="Post">
  <div class="mb-3 col-10 ">
    <label for="username"class="label" >user name:</label>
    <input type="text" name="username"placeholder="Enter the username"class="form-control " id="exampleInputEmail1">
  </div>
  <div class="mb-3 col-10">
    <label for="password"class="label">Password:</label>
    <input type="password" name="password"placeholder="Enter the password"class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 col-10">
    <label for="confirmpassword"class="label">Confirm Password:</label>
    <input type="password" name="confirmpassword"placeholder="Re-Enter the password"class="form-control" id="exampleInputPassword1">
  </div>
 
  <button type="submit" name="register" class="btn btn-primary">Register</button>
  <div >
    <a href="login.php">already have account login here</a>
</div>
</form>
</div>
</div>
</div>
</body>
</html>