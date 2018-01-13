<?php
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'formGet.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact Us Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="script.js"></script>
  <style type="text/css">
  	.palel-primary
	{
		border-color: #bce8f1;
	}
	.panel-primary>.panel-heading
	{
		background:#bce8f1;
		
	}
	.panel-primary>.panel-body
	{
		background-color: #EDEDED;
	}
	input[type='radio'] {
            display: none;
        }

        .toggle input[type="radio"] + .label-text:before{
            content: "\f204";
            font-family: "FontAwesome";
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing:antialiased;
            width: 1em;
            display: inline-block;
            margin-right: 22px;
            font-size: 25px;
        }

        .toggle input[type="radio"]:checked + .label-text:before{
            content: "\f205";
            color: #16a085;
            animation: effect 250ms ease-in;
        }

        .toggle input[type="radio"]:disabled + .label-text{
            color: #aaa;
        }

        .toggle input[type="radio"]:disabled + .label-text:before{
            content: "\f204";
            color: #ccc;
        }
        @keyframes effect{
            0%{transform: scale(0);}
            25%{transform: scale(1.3);}
            75%{transform: scale(1.4);}
            100%{transform: scale(1);}
        }
        .label-text{
            cursor: pointer;
            font-size: 14px;
            vertical-align: top;
        }
  </style>
</head>
<body>
<div class="row">
    <div class="col-md-6 col-sm-12 col-lg-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">Enter Your Details Here <?php echo $msg_sent ?>
			</div>
			<?php if ($errmsg != ''): ?>
				<p style="color: red;"><b>Please correct the following errors:</b><br />
					<?php echo $errmsg; ?>
				</p>
			<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
				<p style="color: green;"><b>Successfully Submitted...!</b><br />
				</p>
			<?php endif; ?>
			<div class="panel-body">
				<form id="contactUsform" action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="email">Enquiry Type *</label>
						<select name="equity_type" id="equity-type" class="DropDownField form-control">
							<option selected="selected" value="General Enquiry">General Enquiry</option>
							<option value="Membership Enquiry">Membership Enquiry</option>
							<option value="Private Event Enquiry">Private Event Enquiry</option>
							<option value="Work for Us">Work for Us</option>
							<option value="Sponsorship Enquiry">Sponsorship Enquiry</option>
						</select>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="myName">First Name *</label>
							<input id="first-name" name="first_name" class="form-control" type="text" required>
							<span id="error_name" class="text-danger"></span>
						</div>
						<div class="form-group col-sm-6">
							<label for="surname">Surname *</label>
							<input id="sur-name" name="sur_name" class="form-control" type="text" required>
							<span id="error_lastname" class="text-danger"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="email">Email *</label>
						<input type="email" name="email" class="form-control" id="email" required>
					</div>
					<div class="row">
						<div class="form-group col-sm-3">
							<label for="Code">Code *</label>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">+</span>
								<input type="text" id="std-code" name="std_code" class="form-control" aria-describedby="basic-addon1" required>
							</div>
						</div>
						<div class="form-group col-sm-9">
							<label for="phone_number">Phone Number *</label>
							<input type="text" id="phone-number" name="phone_number" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label for="phone_number">Preferred Contact Method </label>
						<div class="form-check">
	                        <label class="toggle">
	                            <input type="radio" name="contact_method" value="email" checked="checked"><span class="label-text">Email</span>
	                        </label>
						</div>
	                    <div class="form-check">
	                        <label class="toggle">
	                            <input type="radio" name="contact_method" value="phone_number"><span class="label-text">Phone</span>
	                        </label>
	                    </div>
	                    <div class="form-check">
	                        <label class="toggle">
	                            <input type="radio" name="contact_method" value="either"><span class="label-text">Either</span>
	                        </label>
	                    </div>
					</div>
					<div class="form-group">
						<label for="disc">Message <span style="font-size: 9px;"> (Within 500 Characters Please) </span></label>
						<textarea class="form-control" id="message" name="message" rows="3" required></textarea>
					</div>
					<div class="form-group">
						<label for="disc">File Attachment</label>
						<input type="file" name="file" id="file" required>
					</div>
					<div class="form-group">
						<label for="disc">Security Code</label>
						<div id="imgdiv">
							<img id="captcha_code" src="captcha.php">
							<img id="reload" onClick="refreshCaptcha();" src="reload.png">
						</div>
						
					</div>
					<div class="form-group">
						<label for="captcha">Enter security code *</label>
						<span id="captcha-info" class="info"></span><br/>
						<input id="captcha" name="captcha" class="form-control" type="text" required>
					</div>
					
					<button id="submit" type="submit" value="submit" class="btn btn-primary center">Submit</button>
			
				</form>

			</div>
		</div>
	</div>
</div>
</body>
</html>