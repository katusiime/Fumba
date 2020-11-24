<?php
//start sessions
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<?php
require_once 'includes/connection.php';
require_once 'includes/funtions.php';
?>

<?php

if(isset($_POST['username'])&& isset($_POST['password'])){
    
 global $connection;
// select a db to use
$db_select = mysql_select_db(DB_NAME,$connection);
//get user name
$user_name = mysql_preparation($_POST['username']);
$password = md5(mysql_preparation($_POST['password']));
//$password = md5($_POST['password']);
//verify user exists
try{
//select user
$query = "SELECT * FROM user WHERE elmail = '$user_name' AND pswd = '$password'";
$results = mysql_query($query, $connection);
if(!$results){
header("location: signup.php");
exit(0);
}else{
$numrows = mysql_num_rows($results);
if($numrows > 0 ){
//the default account
$row = mysql_fetch_array($results);
//setup session
$_SESSION['user'] = $row;
header("location: dashboard.php");
exit(0);
}else
{
header("location: index.php");
exit(0);
}
}
} catch(Exception $e)
{
header("location: index.php");
exit(0);
}


}else{ // if posted data is from a regidtration form
$username = mysql_preparation($_POST['usernamesignup']);
$email = mysql_preparation($_POST['emailsignup']);
$pas1 = md5(mysql_preparation($_POST['passwordsignup']));
$pas2 = md5(mysql_preparation($_POST['passwordsignup_confirm']));

if(($pas1 != $pas2)){
// send back to home page

header("location: signup.php");
exit(0);
}
//select DB to use
select_DB_TO_USE();
// insert into db
$query = "INSERT INTO user(full_name,elmail,pswd) VALUES("
. "'{$username}','{$email}','{$pas1}')";
// check query results
$result = mysql_query($query, $connection);
if($result){
// success
header("location:signup.php");
// close connection
mysql_close($connection);
exit(0);

} else {
// error msg
echo "<p><h3><font color ='red'>"
. "REGISTRATION PROCESS DIDN'T succed !!"
. "</font></h3></p>";
echo "<p>". mysql_error()."<p>";

// close connection
mysql_close($connection);
exit();
}

}

?>
    
