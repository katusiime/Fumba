<?php
//start sessions
session_start();
        $value_session = $_SESSION['user'];
        $user_id = $value_session[0];
?>
<?php
require_once 'includes/connection.php';
require_once 'includes/funtions.php';
?>
<?php
if(isset($_POST['group_name']) && $_POST['dish']){
    global $connection;
    global $value_session;
    global $user_id;


// prepare data to escape sql injections
$groupname = mysql_preparation($_POST['group_name']);
$dish = mysql_preparation($_POST['dish']);


//select DB to use
select_DB_TO_USE();
// insert into db
$query = "INSERT INTO gr_p(user_id,gr_p_name,Dish) VALUES("
. "'{$user_id}','{$groupname}','{$dish}')";
// check query results
$result = mysql_query($query, $connection);
if($result){

// query 4 group ids 
    query_grpTB();
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
$group_id_for_sub;
// function to query from the gr_p_id to pick group id  to subsribe
function query_grpTB(){
    global $connection;
    global $group_id_for_sub;
    //select DB to use
select_DB_TO_USE();   
//// fetch from database
$query = mysql_query("SELECT gr_p_id FROM gr_p", $connection);
if(!$query){
die("Database query failed:".mysql_error());
}
//// use returned data 
while ($row = mysql_fetch_array($query)) {
$group_id_for_sub = $row['gr_p_id'];

}
// call subscription
    subsribe();
}
// function subsribe boss
function subsribe(){
    global $connection;
     global $group_id_for_sub;
      global $user_id;
      $level ='Cordinator';
//select DB to use
select_DB_TO_USE();
// insert into db
$query = "INSERT INTO subscription_tb(gr_p_id,user_id,level) VALUES("
. "'{$group_id_for_sub}','{$user_id}','{$level}')";
// check query results
$result = mysql_query($query, $connection);
if($result){
// success
header("location:dashboard.php?");

// close connection
mysql_close($connection);
exit();


} else {
// error msg
echo "<p><h3><font color ='red'>"
. " GROUP REGISTRATION PROCESS DIDN'T succed !!"
. "</font></h3></p>";
echo "<p>". mysql_error()."<p>";

// close connection
mysql_close($connection);
exit();
}
}

?>