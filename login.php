<?php
include_once("config.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if(isset($postdata) && !empty($postdata))
{
$pwd = mysqli_real_escape_string($mysqli, trim($request->password));
$user = mysqli_real_escape_string($mysqli, trim($request->username));
$sql = "SELECT * FROM user where name='$user' and password='$pwd'";

if($result = mysqli_query($mysqli,$sql))
{
    $rows = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $rows[] = $row;
    }
    echo json_encode($rows);
}
else{
http_response_code(404);
}
}
?>