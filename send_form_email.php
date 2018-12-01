<?php
$errors = '';
$myemail = 'jmillthetruth@gmail.com';//<-----Put Your email address here.
if(empty($_POST['firstname'])  ||
   empty($_POST['lastname'])  ||
   empty($_POST['emailaddress']) ||
   empty($_POST['subject']))
{
    $errors .= "\n Error: all fields are required";
}
  $fname = $_POST['firstname']; 
  $lname = $_POST['lastname'];
  $email_address = $_POST['emailaddress'];
  $country = $_POST['country'];
  $subject = $_POST['subject'];


if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
$to = $myemail;
$email_subject = "Contact form submission: $name";
$email_body = "You have received a new message. ".
" Here are the details:\n First Name: $fname \n ".
"Last Name: $lname \n Email: $email_address\n Country: $country \n Message \n $subject";
$headers = "From: $myemail\n";
$headers .= "Reply-To: $email_address";
mail($to,$email_subject,$email_body,$headers);
echo "sent";
//redirect to the 'thank you' page
header('Location: thankyou.html');
}
else{
  echo "$errors";
}
?>