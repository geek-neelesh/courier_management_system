<?php require_once"dbconfig.php"
?>
<?php
function input_filter($data){
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}
if(isset($_POST["login"])){
  $username=input_filter($_POST["username"]);
  $password=input_filter($_POST["password"]);

  $username=mysqli_real_escape_string($con,$username);
  $password=mysqli_real_escape_string($con,$password);

  $query="SELECT * FROM `users_table` WHERE `username`=? AND `password`=?";
  if($stmt=mysqli_prepare($con,$query)){ //prepared statement
     mysqli_stmt_bind_param($stmt,"ss",$username,$password);//once prepared ,binding statement with strings
     mysqli_stmt_execute($stmt);//executing statement 
     mysqli_stmt_store_result($stmt);//storing execution result in $stmt 
     if(mysqli_stmt_num_rows($stmt)==1){
     session_start();
     $_SESSION['UserId']=$username;
     header("location:user_page.php");
     }else{
       echo"<script>alert('invalid username or password')</script>";
     }
  }
  else{
    echo"<script>alert('sql query is not prepared')</script>";
  }
  mysqli_stmt_close($stmt);
  mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="login.css"rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row ">
            <div class="col-12">
            <form class="form-container "action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>"method="Post">
  <div class="mb-3 col-10 ">
    <label for="username"class="label" >user name:</label>
    <input type="text" name="username"placeholder="Enter the username"class="form-control " id="exampleInputEmail1">
  </div>
  <div class="mb-3 col-10">
    <label for="password"class="label">Password:</label>
    <input type="password" name="password"placeholder="Enter the password"class="form-control" id="exampleInputPassword1">
  </div>
 
  <button type="submit" name="login"class="btn btn-primary">Log in</button>
  <div >
    <a href="register.php">create new account</a>
</div>
</form>
</div>
</div>
</div>
</body>
</html>