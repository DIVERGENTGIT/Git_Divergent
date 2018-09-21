var base_url="https://www.firstring.in/API/";
	//var base_url="http://10.10.10.21/FirstRing/API/";
		
	$(document).ready(function(){
	
	  
	
	$(".mobilecallrecord").on("click",function(e){
		e.preventDefault();
	  
	var mobile_number=$(".mobile_number").val();
	var pattern = /^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/;
	
	if (!pattern.test($(".mobile_number").val())) 
	{
	alert("Please Enter Valid Mobile Number");
	//$('#validmob').css('display', 'block');
	 $(".mobile_number").focus();
	return false;
        }
        var mobile_numberlen= mobile_number.toString().length;
	if(mobile_numberlen!=10 || mobile_number < 1000000000)
	{
	   alert("Please Enter Valid Mobile Number");
	}
	else{
	
			 	var urlstr=base_url+"SMS_C2C_Agent.php?dial_number="+mobile_number;
 
				console.log(urlstr);
				 $.ajax({  
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'text',
					success: function(data){
					console.log(data);
					if(data!=""){alert(data);}
				      }
					
				});
			
					
			
	
	var mobile_number=$(".mobile_number").val('');
	
     }
	return false;
     });
    
    $('[id^=edit]').keypress(validateNumber);


function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
    	return true;
    }
};
	});
	
	
	
