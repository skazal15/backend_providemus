<?php
include_once("config.php");
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata))
{
$request = json_decode($postdata);
$Id = trim($request->Id);
$name1 = mysqli_real_escape_string($mysqli, trim($request->name));
$email1 = mysqli_real_escape_string($mysqli, trim($request->email));
$phone1 = mysqli_real_escape_string($mysqli, trim($request->phone));
$address1 = mysqli_real_escape_string($mysqli, trim($request->address));
$city1 = mysqli_real_escape_string($mysqli, trim($request->city));
$pincode1 = mysqli_real_escape_string($mysqli, trim($request->pincode));
$snik1 = mysqli_real_escape_string($mysqli, trim($request->snik));
$sql = "UPDATE employee SET name='$name1', email='$email1',phone='$phone1', address='$address1', city='$city1',pincode='$pincode1',snik='$snik1' WHERE id='$Id'";
if ($mysqli->query($sql) === TRUE) {
$authdata = [
'name' => $name1,
'email' => $email1,
'address' => $address1,
'city' => $city1,
'pincode' => $pincode1,
'snik'=> $snik1,
'id' => $Id
];
echo json_encode($authdata);
}
}

?>