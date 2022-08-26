<?php
include_once("config.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if(isset($postdata) && !empty($postdata)){

  $username = mysqli_real_escape_string($mysqli,trim($request->username));
  $sql="SELECT user.name,user.telp,user.email,rule.threshold,rule.app FROM user LEFT JOIN rule ON user.id = rule.user_id WHERE user.name='$username'";
  if($result = mysqli_query($mysqli,$sql))
  {
    $rows = array();
    while($row = mysqli_fetch_assoc($result))
    {
      $rows[] = $row;
    }
    echo json_encode($rows);
  }
  else
  {
    http_response_code(404);
  }
}
?>