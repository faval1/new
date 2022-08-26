<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name1 = $_POST['name1'];
$address1 = $_POST['address1'];
$country1 = $_POST['country1'];
$email = $_POST['email'];
$phone1 = $_POST['phone1'];
$weight = $_POST['weight'];

$name2 = $_POST['name2'];
$address2 = $_POST['address2'];
$country2 = $_POST['country2'];
$email = $_POST['email'];
$phone2 = $_POST['phone2'];



if(IsInjected($email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'support@globalshippingcompany.net';//<== update the email address
$email_subject = "Parcel Shipping Request";
$email_body = "Sender Infromation: $name1.\n".
             "Address:\n $address1".
             "Country:\n $country1".
             "Phone contact:\n $phone1".
             "Weight of Parcel:\n \n $weight".
             
             "Receiver's Infromation: $name2.\n".
             "Address:\n $address2".
             "Receiving Country:\n $country2".
             "Phone contact:\n $phone2".   
            
    
$to = "support@globalshippingcompany.net";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 