<?php
require_once"dbconfig.php";
$parcel_id_delete=$_GET['parcel_id'];
$deletequery="DELETE FROM `parcel_table` WHERE parcel_id='$parcel_id_delete'";
$res_delete=mysqli_query($con,$deletequery);
if($res_delete){
    echo"
    <script>
    alert('data deleted successfully')
    </script>
    ";
    header('location:view_history.php');
}
else{
    echo"
    <script>
    alert('data is not deleted')
    </script>
    ";
    
}
?>