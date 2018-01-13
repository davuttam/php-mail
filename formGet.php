<?php 
	$errors = array();
	$errmsg  = '';
	$msg_sent = FALSE;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		if ($_SESSION["captcha_code"] == $_POST['captcha']) {
			//Get uploaded file data
		    $file_tmp_name = $_FILES['file']['tmp_name'];
		    $file_name = $_FILES['file']['name'];
		    $file_size = $_FILES['file']['size'];
		    $file_type = $_FILES['file']['type'];
		    $file_error = $_FILES['file']['error'];

			if($file_error > 0){
				$errors['file-error'] = 'Upload error or No files uploaded';
			} else {
				$equity_type = $_POST['equity_type'];
				$first_name = $_POST['first_name'];
				$sur_name = $_POST['sur_name'];
				$email = $_POST['email'];
				$std_code = $_POST['std_code'];
				$phone_number = $_POST['phone_number'];
				$contact_method = $_POST['contact_method'];
				$message = $_POST['message'];
				// $file = $_POST['file'];
				$captcha = $_POST['captcha'];

				//read from the uploaded file & base64_encode content for the mail
				$handle = fopen($file_tmp_name, "r");
				$content = fread($handle, $file_size);
				fclose($handle);
				$encoded_content = chunk_split(base64_encode($content));

				$to = "davuttam@gmail.com";
				$subject = "Membership Application";

				$from_email = 'noreply@your_domain.com'; //from mail, it is mandatory with some hosts
				$recipient_email = $to; //recipient email (most cases it is your personal email)

				$htmlContent = '
				    <html>
				    <head>
				        <title>Contact Us</title>
				    </head>
				    <body>
				        <h1>'. $_POST['first_name'] .' applied membership!</h1>
				        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 300px; height: 200px;">
				            <tr>
				                <th>Name:</th><td>'. $first_name . $sur_name. '</td>
				            </tr>
				            <tr>
				                <th>Enquiry Type:</th><td>'. $equity_type .'</td>
				            </tr>
				            <tr style="background-color: #e0e0e0;">
				                <th>Email:</th><td>'. $email .'</td>
				            </tr>
				            <tr>
				                <th>Phone Number:</th><td> +'. $std_code.$phone_number .'</td>
				            </tr>
				            <tr>
				                <th>Preferred Contact Method:</th><td>'.$contact_method.'</td>
				            </tr>
				            <tr>
				                <th>Message:</th><td>'.$message.'</td>
				            </tr>
				        </table>
				    </body>
				    </html>';

				$boundary = md5("sanwebe");
				//header
				$headers = "MIME-Version: 1.0\r\n"; 
				$headers .= "From:".$from_email."\r\n"; 
				$headers .= "Reply-To: ". $to 	."" . "\r\n";
				$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 

				//plain text 
				$body = "--$boundary\r\n";
				// Set content-type header for sending HTML email
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
				$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
				$body .= chunk_split(base64_encode($htmlContent)); 

				//attachment
				$body .= "--$boundary\r\n";
				$body .="Content-Type: $file_type; name=".$file_name."\r\n";
				$body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
				$body .="Content-Transfer-Encoding: base64\r\n";
				$body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
				$body .= $encoded_content;
				    
				$sentMail = mail($recipient_email, $subject, $body, $headers);

				if ($sentMail) {
					$msg_sent = TRUE;
					echo("<p>Email successfully sent!</p>");
				} else {
					echo("<p>Email delivery failed…</p>");
				}
			}
		} else {
			$errors['captcha-error'] = "Security code is wrong";
		}

		if ($errors) {
	        // one or more errors
	        foreach($errors as $error) {
	            $errmsg .= $error . '<br />';
    		}
    	}
	}

?>