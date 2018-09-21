$( document ).ready(function( $ ) {




// Form Validation
$("#validation-signup").validate({
	rules: 
	{
		username: {
		required: true,
		minlength:5,
		maxlength:25,
		alphanumeric: true
		},
		firstname: {
		required: true,
		minlength:5,
		maxlength:25,
		alphanumeric: true
		},
		lastname: {
		required: true,
		minlength:5,
		maxlength:25,
		alphanumeric: true
		},
		mobile: {
		required: true,
		minlength:10,
		maxlength:10,
		regex:true,
		number: true			
		},
		password: {
		required: true,
		minlength:5,
		maxlength:10,
		regexpcol: true			
		},
		confpass: {
		required: true,
		minlength:5,
		maxlength:10,
		equalTo:"#password",
		regexpcol: true			
		},
		email: {
		required: true,
		maxlength:50,
		email:true,
		myEmail: true			
		},
		organization: {
		required: true,
		},
		address1: {
		required: true,
		},
		address2: {
		required: true,
		},
		state: {
		required: true,
		},
		city: {
		required: true,
		},
		pincode: {
		required: true,
		},
		captcha: {
		required: true,
		},
	},
	messages: 
	{
		username: {
		required: "Please Enter UserName",
		minlength: "username must be at least 5 characters long"

		},
		firstname: {
		required: "Please Enter First Name",
		minlength: "username must be at least 5 characters long"

		},
		lastname: {
		required: "Please Enter Last Name",
		minlength: "username must be at least 5 characters long"

		},
		mobile: {
		required: "Please Enter Mobile Number",
		minlength: "Please Enter 10 Digit Mobile Number", 
		maxlength: "Please Enter 10 Digit Mobile Number",

		number: "Please Enter Numbers Only"				
		},
		password: {
		required: "Please Enter Password",
		minlength: "Password must be at least 5 characters long", 
		maxlength: "Password must be 10 characters only", 		
		},
		confpass: {
		required: "Please Enter Confirm  Password",
		minlength: "Confirm Password must be at least 5 characters long", 
		maxlength: "Confirm Password must be 10 characters only", 		
		},
		email: {
		required: "Please Enter Email",
		email: "Please Enter Valid Email" 				
		},
		organization: {
		required: "Please Enter Organization Name",
		},
		address1: {
		required: "Please Enter Address1",
		},
		address2: {
		required: "Please Enter Address2",
		},
		state: {
		required: "Please Select State",
		},
		city: {
		required: "Please Select City",
		},
		pincode: {
		required: "Please Enter Pin Code",
		},
		captcha: {
		required: "Please Enter Captcha Code",
		}
		
			
	},
	tooltip_options: 
	{
		username: {placement:'bottom',html:true},
		firstname: {placement:'bottom',html:true},
		lastname: {placement:'bottom',html:true},
		email: {placement:'bottom',html:true},
		password: {placement:'bottom',html:true},
		mobile: {placement:'bottom',html:true},
		organization: {placement:'bottom',html:true},
		address1: {placement:'bottom',html:true},
		address2: {placement:'bottom',html:true},
		state: {placement:'bottom',html:true},
		city: {placement:'bottom',html:true},
		pincode: {placement:'bottom',html:true},
		captcha: {placement:'bottom',html:true}
	}
}); 

// mobile no validation
 $("#mobileno").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    

});
