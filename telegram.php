<?php
include_once("config.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if(isset($postdata) && !empty($postdata)){
    $username = mysqli_real_escape_string($mysqli,trim($request->username));
    $telegram = mysqli_real_escape_string($mysqli,trim($request->telegram));
    $WA = mysqli_real_escape_string($mysqli,trim($request->wa));
    $sql = "INSERT INTO telegram (name,telegramid,waid) 
    VALUES ('$username','$telegram','$WA')";

    if($mysqli->query($sql)==TRUE){
        $authdata = [
            'name'=>$username,
            'telegramid'=>$telegram,
            'waid'=>$WA,
            'id'=>mysqli_insert_id($mysqli)
        ];
    }
}
