<?php
require_once"dbconfig.php"
?>
<?php
session_start();
if(!isset($_SESSION['UserId'])){
 header('location:login.php');
}
if(isset($_POST["submit"])){
    $sender_name=$_POST["sendername"];
    $sender_address=$_POST["senderaddress"];
    $sender_contact=$_POST["sendercontact"];
    $receiver_name=$_POST["receivername"];
    $receiver_address=$_POST["receiveraddress"];
    $receiver_contact=$_POST["receivercontact"];
    $parcel_length=$_POST["parcellength"];
    $parcel_width=$_POST["parcelwidth"];
    $parcel_height=$_POST["parcelheight"];
    $parcel_weight=$_POST["parcelweight"];
   /* if(isset($_SESSION['box'])){
    $count=count($_SESSION['box']);
    $_SESSION['box'][$count]=array('sender_name'=>$sender_name,'sender_contact'=>$sender_contact,'receiver_contact'=>$receiver_contact,'parcel_length'=>$parcel_length,'parcel_width'=>$parcel_width,'parcel_height'=>$parcel_height,'parcel_weight'=> $parcel_weight);
    }
    else{
        $_SESSION['box'][0]=array('sender_name'=>$sender_name,'sender_contact'=>$sender_contact,'receiver_contact'=>$receiver_contact,'parcel_length'=>$parcel_length,'parcel_width'=>$parcel_width,'parcel_height'=>$parcel_height,'parcel_weight'=> $parcel_weight);
    }*/
  
    $insertquery= " INSERT INTO `parcel_table`(`sender_name`,`sender_address`,`sender_contact`,`receiver_name`,`receiver_address`,`receiver_contact`,`parcel_length`,`parcel_width`,`parcel_height`,`parcel_weight`)VALUES('$sender_name','$sender_address','$sender_contact','$receiver_name', '$receiver_address','$receiver_contact','$parcel_length','$parcel_width','$parcel_height', '$parcel_weight')";
    $res=mysqli_query($con,$insertquery);
    if($res){
        echo"
        <script>
        alert('data inserted successfully')
        </script>
        ";
    }
    else{
        echo"
        <script>
        alert('data is not inserted')
        </script>
        ";
        
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="admin_and_user_page.css" rel="stylesheet">

</head>
<body>
    <div class="admin_nav">
    <h2>Welcome <?php echo $_SESSION['UserId']?></h2>
    <div class="logout_btn">
    <a href="index.html"class="btn btn-outline-danger">LOG OUT</a>
</div>

</div>
<div class="container">
    <div class="heading">
    <h2 >Add parcel details:</h2>
    <div class="view_history">
        <a href="view_history.php" class="btn btn-primary">view history</a>
    </div>
    </div>
    <form class="add_details" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>"method="post">
    <div class="wrap">
        <div class="sender_details col-5">
            <h3>sender details</h3>
                <div class="mb-3 col-10">
                <label for="sendername"class="label" > name:</label>
                <input type="text" name="sendername"placeholder="Enter the sender name"class="form-control " id="exampleInputEmail1"value="<?php echo $_SESSION['UserId']?>">
                </div>
                <div class="mb-3 col-10 ">
                <label for="senderaddress"class="label" > address:</label>
                <input type="text" name="senderaddress"placeholder="Enter the sender address"class="form-control " id="exampleInputEmail1">
                </div>
                <div class="mb-3 col-10 ">
                <label for="sendercontact"class="label" > contact number:</label>
                <input type="text" name="sendercontact"placeholder="Enter the sender contact number"class="form-control " id="exampleInputEmail1">
                </div>
        </div>
        <div class="receiver_details col-5">
            <h3>recevier details</h3>
                <div class="mb-3 col-10 ">
                <label for="receivername"class="label" > name:</label>
                <input type="text" name="receivername"placeholder="Enter the receiver name"class="form-control " id="exampleInputEmail1">
                </div>
                <div class="mb-3 col-10">
                <label for="receiveraddress"class="label" > address:</label>
                <input type="text" name="receiveraddress"placeholder="Enter the receiver address"class="form-control " id="exampleInputEmail1">
                </div>
                <div class="mb-3 col-10 ">
                <label for="receivercontact"class="label" > contact number:</label>
                <input type="text" name="receivercontact"placeholder="Enter the receiver contact number"class="form-control " id="exampleInputEmail1">
                </div>
        </div>
    </div>
        <div class="pacel_details">
            <h3>parcel details</h3>
                <div class="mb-3 col-4 ">
                <label for="parcellength"class="label" > parcel length:</label>
                <input type="text" name="parcellength"placeholder="Enter the parcel length"class="form-control " id="exampleInputEmail1">
                </div>
                <div class="mb-3 col-4 ">
                <label for="parcelwidth"class="label" > parcel width:</label>
                <input type="text" name="parcelwidth"placeholder="Enter the parcel width"class="form-control " id="exampleInputEmail1">
                </div>
                <div class="mb-3 col-4 ">
                <label for="parcelheight"class="label" > parcel height:</label>
                <input type="text" name="parcelheight"placeholder="Enter the parcel height"class="form-control " id="exampleInputEmail1">
                </div>
                <div class="mb-3 col-4 ">
                <label for="parcelweight"class="label" > parcel weight:</label>
                <input type="text" name="parcelweight"placeholder="Enter the parcel weight"class="form-control " id="exampleInputEmail1">
                </div>
   
        </div>
        <button type="submit" name="submit"class="btn btn-primary">submit</button>

</form>
 <br>       
         
</div>
    
</body>
</html>