<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Ajax Contact Form</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#submit_btn").click(function() { 
       
	    var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields		
		$("#contact_form input[required=true], #contact_form textarea[required=true]").each(function(){
			$(this).css('border-color',''); 
			if(!$.trim($(this).val())){ //if this field is empty 
				$(this).css('border-color','red'); //change border color to red   
				proceed = false; //set do not proceed flag
			}
			//check invalid email
			var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
			if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
				$(this).css('border-color','red'); //change border color to red   
				proceed = false; //set do not proceed flag				
			}	
		});
       
        if(proceed) //everything looks good! proceed...
        {
           //data to be sent to server         
            var m_data = new FormData();    
            m_data.append( 'user_name', $('input[name=name]').val());
            m_data.append( 'user_email', $('input[name=email]').val());
            m_data.append( 'country_code', $('input[name=phone1]').val());
            m_data.append( 'phone_number', $('input[name=phone2]').val());
            m_data.append( 'subject', $('select[name=subject]').val());
			m_data.append( 'msg', $('textarea[name=message]').val());
			m_data.append( 'file_attach', $('input[name=file_attach]')[0].files[0]);
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
              url: 'contact_me.php',
              data: m_data,
              processData: false,
              contentType: false,
              type: 'POST',
              dataType:'json',
              success: function(response){
                 //load json data from server and output message     
 				if(response.type == 'error'){ //load json data from server and output message     
					output = '<div class="error">'+response.text+'</div>';
				}else{
				    output = '<div class="success">'+response.text+'</div>';
				}
				$("#contact_form #contact_results").hide().html(output).slideDown();
              }
            });
			

        }
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function() { 
        $(this).css('border-color',''); 
        $("#result").slideUp();
    });
});
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="form-style" id="contact_form">
    <div class="form-style-heading">Please Contact Us</div>
    <div id="contact_results"></div>
    <div id="contact_body">
        <label><span>Name <span class="required">*</span></span>
            <input type="text" name="name" id="name" required="true" class="input-field"/>
        </label>
        <label><span>Email <span class="required">*</span></span>
            <input type="email" name="email" required="true" class="input-field"/>
        </label>
        <label><span>Phone <span class="required">*</span></span>
            <input type="text" name="phone1" maxlength="4" placeholder="+91"  required="true" class="tel-number-field"/>&mdash;<input type="text" name="phone2" maxlength="15"  required="true" class="tel-number-field long" />
        </label>
        <label><span>Attachment</span>
            <input type="file" name="file_attach" class="input-field" />
        </label>

            <label for="subject"><span>Regarding</span>
            <select name="subject" class="select-field">
            <option value="General Question">General Question</option>
            <option value="Advertise">Advertisement</option>
            <option value="Partnership">Partnership Oppertunity</option>
            </select>
        </label>
        <label for="field5"><span>Message <span class="required">*</span></span>
            <textarea name="message" id="message" class="textarea-field" required="true"></textarea>
        </label>
        <label>
            <span>&nbsp;</span><input type="submit" id="submit_btn" value="Submit" />
        </label>
    </div>
</div>

</body>
</html>
