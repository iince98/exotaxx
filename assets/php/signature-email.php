<?php 

$nameErr = $emailErr = $subjectErr = $phoneErr = $messageErr = "";  
$name = $email = $subject = $phone = $message = "";  

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    
    //String Validation Name  
    if (empty($_POST["name"])) {  
         $nameErr = "Name is required. ";  
    } else {  
        $name = input_data($_POST["name"]);  
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
           $nameErr = "Name only alphabets and white space are allowed. ";  
        }  
    } 
    
     //Phone Validation  
    if (empty($_POST["phone"])) {  
         $phoneErr = "Phone is required. ";  
    } else {  
        $phone = input_data($_POST["phone"]);  
        // check if phone only number 
        if (!preg_match("/^[0-9]*$/",$phone)) {  
           $phoneErr = "Invalid phone number. ";  
        }  
    } 
    
    //Email Validation   
    if (empty($_POST["email"])) {  
         $emailErr = "Email is required. ";  
    } else {  
        $email = input_data($_POST["email"]);  
        // check that the e-mail address is well-formed  
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            $emailErr = "Invalid email format. ";  
        }  
    } 
    
    $subject = "Signed Document Submission";
    
    //String Validation Message  
    if (empty($_POST["message"])) {  
         $messageErr = "Message is required. ";  
    } else {  
        $message = input_data($_POST["message"]);  
        // check if subject only contains letters, number and whitespace  
        if (!preg_match("/^[a-zA-Z0-9. ]*$/",$message)) {  
           $messageErr = "Message only alphabets, number and white space are allowed. ";  
        }  
    } 
    
    
    if($nameErr == "" && $emailErr == "" && $subjectErr == "" && $messageErr == ""){
        
        // HTML Email Body
        $emailBody = "<b>Signed Document Submission:</b> </br>
            <h5><b>Name:</b> ".$name."</h5>
            <h5><b>Email:</b> ".$email."</h5>
            <h5><b>Phone:</b> ".$phone."</h5>
            <h5><b>Template Name:</b> Fineco</h5>
            </br><b>Message:</b></br>
            <p>".$message."</p>
            </br>
            <p><b>Note:</b> The signed PDF document is attached to this email.</p>";
            
        $to = "iince98@gmail.com"; //Replace your real receiving email address
        
        // Check if PDF data is present
        if (isset($_POST['pdf']) && !empty($_POST['pdf'])) {
            
            // Decode the base64 PDF
            $pdfData = base64_decode($_POST['pdf']);
            
            // Generate unique filename
            $filename = "signed-document-" . time() . ".pdf";
            
            // Email headers for attachment
            $separator = md5(time());
            
            // Headers
            $headers = "From: noreply@exotaxx.de\r\n"; // ✅ Use YOUR domain
            $headers .= "Reply-To: ".$email."\r\n";    // User can still reply to sender
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"\r\n";
            
            // Message body
            $body = "--".$separator."\r\n";
            $body .= "Content-Type: text/html; charset=UTF-8\r\n";
            $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $body .= $emailBody."\r\n";
            
            // Attachment
            $body .= "--".$separator."\r\n";
            $body .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
            $body .= chunk_split(base64_encode($pdfData))."\r\n";
            $body .= "--".$separator."--";
            
            // Send email
            $mail_send = mail($to, $subject, $body, $headers);
            
        } else {
            // If no PDF, send simple email
            $header = "From: noreply@exotaxx.de\r\n"; // ✅ Use YOUR domain
            $header .= "Reply-To: ".$email."\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            
            $mail_send = mail($to, $subject, $emailBody, $header);
        }
        
        if( $mail_send == true ) {
            echo "Your signed document has been sent successfully!";
        } else {
            echo "Your message could not be sent. Please try again.";
        }
        
    } else {
        
        echo $nameErr;
        echo $emailErr;
        echo $subjectErr;
        echo $messageErr;
        
    }

} else {
   echo "Invalid request method."; 
}


// data validate
function input_data($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
} 


?>
