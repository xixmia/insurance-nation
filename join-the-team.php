<?php
/* == Emailer: == */
require_once './php/emailer.php';

if($_POST){
 
 $file_name = $_FILES['Resume']['name'];
 $file_tmp = $_FILES['Resume']['tmp_name'];
 move_uploaded_file($file_tmp,"./".$file_name);
 $attachment = 'http://www.rddpinc.com/xix/'.$file_name.''; //change this line to have your directory
 
$to_email = 'jmendez@xixmia.com,cgomez@xixmia.com'; //the email you want the form to send the email to.
$body = '
 <h1>Career Form</h1>
 <div>Name: '.$_POST['name'].'</div>
 <div>Adress: '.$_POST['Adress'].'</div>
 <div>Zip-Code: '.$_POST['Zip-Code'].'</div>
 <div>Phone: '.$_POST['Phone'].'</div>
 <div>Email: '.$_POST['Email'].'</div>
 <div>LinkedIn: '.$_POST['LinkedIn'].'</div>
 <div>Resume: '.$attachment.'</div>';

 emailer($_POST['Email'],$_POST['name'],$to_email,'Careers Form',$body,$body_alt,$attachment);
}
?>


		  <form class="w-clearfix" id="wf-form-Careers-Form" name="wf-form-Careers-Form" data-name="Careers Form" data-redirect="/thank-you.html" action="./" method="post" enctype="multipart/form-data">
            <h1 class="form-heading">Apply for a career</h1>
            <input type='hidden' name='redirect_to' value='http://insurancenation.com/thank-you.html' />
            <label for="name">Name:</label>
            <input class="w-input" id="name" type="text" placeholder="Enter your name" name="name" data-name="Name" required="required">
            <label class="zip-label" for="Zip-Code">Zip Code:</label>
            <label class="address-label" for="Address">Address:</label>
            <input class="w-input address" id="Address" type="text" placeholder="Enter your address" name="Address" data-name="Address" required="required">
            <input class="w-input zip" id="Zip-Code" type="text" placeholder="Zip Code" name="Zip-Code" required="required" data-name="Zip Code">
            <label for="Phone">Phone:</label>
            <input class="w-input" id="Phone" type="text" placeholder="Enter your phone number" name="Phone" required="required" data-name="Phone">
            <label for="Email">Email:</label>
            <input class="w-input" id="Email" type="email" placeholder="Enter your email" name="Email" required="required" data-name="Email">
            <label for="LinkedIn">LinkedIn URL:</label>
            <input class="w-input" id="LinkedIn" type="text" placeholder="E.g. linkedin.com/in/jdoe" name="LinkedIn" data-name="LinkedIn">
            <label for="Resume">Upload Your Resume</label>
            <input class="w-input file" id="Resume" type="file" name="Resume" data-name="Resume">
            <input class="w-button button home-cta form-btn" type="submit" value="Submit Application" data-wait="Please wait...">
          </form>