<?php 
if(isset($_POST['fullname']) && isset($_POST['telephone']) && isset($_POST['emailx']) && isset($_POST['message'])){
   sendMail($_POST['fullname'],$_POST['telephone'],$_POST['emailx'],$_POST['message']);
   header("location: index.php");
}
function sendMail($fullname,$telephone,$emailx,$message){
	$to      = 'fumba2014@gmail.com'; // Send email to our user
$subject = 'Contact Us | Fumba2014'; // Give the email a subject 
$messagetous = 'From:'+$fullname+
				"Email:"+$emailx+
				"Telephone"+$telephone+
				"............................................................................................."+
				"...............................Messages......................................................"+
				$message; // Our message above including the link
                     
$headers = 'From:fumba2014' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

}
 header("location: index.php");
?>