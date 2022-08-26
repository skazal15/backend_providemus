<?php
include_once("config.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
date_default_timezone_set('Asia/Jakarta');

if(isset($postdata)&&!empty($postdata)){
    $username = mysqli_real_escape_string($mysqli,trim($request->username));
    $activity = mysqli_real_escape_string($mysqli,trim($request->activity));
    $sql = "SELECT * FROM activity where name='$username'";
    $result=mysqli_query($mysqli,$sql);
    if(mysqli_num_rows($result)>0){
        $rows=array();
        while($row=mysqli_fetch_assoc($result)){
            $rows[]=$row;
        }
        $sid=$rows[0]["id"];
        $today = date("Y-m-d H:i:s");
        $sql1="UPDATE activity SET name='$username',status='$activity',timestamp='$today' WHERE id='$sid'";
        if ($mysqli->query($sql1) === TRUE) {
            $authdata = [
            'name' => $username,
            'status' => $activity,
            'timestamp' => $today,
            'id'=>$sid
            ];
            echo json_encode($authdata);
        }
    }

    else{
        $sql2="INSERT INTO activity (name,status) VALUES ('$username','$activity')";
        if($mysqli->query($sql2)==TRUE){
        $authdata = [
            'name'=>$username,
            'status'=>$activity,
            'id'=>mysqli_insert_id($mysqli)
        ];
        echo json_encode($authdata);
    }
    }
}
?>