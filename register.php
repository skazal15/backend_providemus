<?php
include_once("config.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if(isset($postdata) && !empty($postdata)){
    $username = mysqli_real_escape_string($mysqli,trim($request->username));
    $password = mysqli_real_escape_string($mysqli,trim($request->password));
    $telp=mysqli_real_escape_string($mysqli,trim($request->telp));
    $email=mysqli_real_escape_string($mysqli,trim($request->email));
    $gender=mysqli_real_escape_string($mysqli,trim($request->gender));
    $department=mysqli_real_escape_string($mysqli,trim($request->department));
    $catagory=mysqli_real_escape_string($mysqli,trim($request->catagory));
    $group=mysqli_real_escape_string($mysqli,trim($request->group));
    
    $sql = "INSERT INTO user (name,telp,email,password,gender,department,catagory,groupmandiri) 
    VALUES ('$username','$telp','$email','$password','$gender','$department','$catagory','$group')";

    if($mysqli->query($sql)==TRUE){
        $authdata = [
            'name'=>$username,
            'telp'=>$telp,
            'email'=>$email,
            'password'=>$password,
            'gender'=>$gender,
            'department'=>$department,
            'catagory'=>$catagory,
            'groupmandiri'=>$group,
            'id'=>mysqli_insert_id($mysqli)
        ];
    }
}
