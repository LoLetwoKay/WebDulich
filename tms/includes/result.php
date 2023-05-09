
<?php
include('config.php');
$fname=$_POST['fname'];
$mnumber=$_POST['mobilenumber'];
$email=$_POST['email'];
$password=md5($_POST['password']);
if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

    echo "error : You did not enter a valid email.";
}else{
$sql ="SELECT EmailId FROM tblusers WHERE EmailId=:email";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
}
if(!$fname || !$mnumber || !$email || !$password){
    echo 'Khong duoc de trong';
}elseif($query -> rowCount() > 0)
{
    echo 'Email already exists';
}
// if($lastInsertId)
// {
// echo "You are Scuccessfully registered. Now you can login ";
// // header('location:thankyou.php');
// } 
elseif(strlen($fname) < 6){
echo "FUll name must be 6 char ";
// header('location:thankyou.php');
}elseif(strlen($mnumber) != 10){
    echo 'so dien thoai phai co 10 ky tu';
}
else
{

    $sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->execute();
   $dbh->lastInsertId();
echo "You are Scuccessfully registered. Now you can login ";
}
