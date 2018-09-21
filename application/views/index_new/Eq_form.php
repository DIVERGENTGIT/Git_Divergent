
 <style type="text/css">
	.form-top-left {
    margin-top: 1px;
    }

.p1{ padding-top: 6px; }
.well2 { width: 20% !important;
    min-height: 20px;
   
	padding: 0px !important;
    padding-right: 0px;
    padding-left: 0px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    /*border: 1px solid #29ABE2;*/
	
	border:1px solid rgb(212, 210, 210);
    border-radius: 0px !important;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
    }
	
.well2{ position:absolute; z-index:1000;
       bottom: 0px !important;
	   position:fixed; 
	   right: 0px !important;  }
	   
.Enq{text-align:center;; margin-bottom: 10px !important; font-size:16px; color: #fff; 
     background-color: #03A9F4;}
.info2 {
    margin-top: 1px !important;
    width: 33px;
    height: 26px; background-color:#D4D2D2; text-align:center; color:#607D8B;
	}
.mbtns { bottom:0px; padding:0px !important; margin-left:16px;  margin-top:5px;  margin-bottom:5px;}	
.tx{ display:none; font-size: 18px; margin-right: 15px;    }	
	
input.btn.btn-block.btn-info {
    border-radius: 0px !important;
}

.btn-info {
    color: #fff;
    background-color: #03A9F4 !important;
    border-color: #03A9F4 !important;
}
.show01{    margin-top: -11px !important;}
::-webkit-input-placeholder { color: #0F3; }
::-moz-placeholder {color:#0FC; }
:-ms-input-placeholder { color: #09C; } 
:-o-input-placeholder { color:#099; } 
@media (max-width: 768px) {
	
	.well2 { width: 40% !important;}
	}	
	
@media (max-width: 767px) {
	
	.well2 { width: 60% !important;}
	
	}	

@media (max-width: 479px) {
	.well2 { width: 90% !important;
	margin-right: 16px !important;}
	
	}


</style>
<div class="col-md-3 col-sm-12 col-xs-12  well2 ">
 <div class="mbtns">          
                           <span  id="hide01" title="Minimize "><i class="fa fa-minus btn info2 " ></i></span>

                           <span  id="show01" title="Opne Form  "><i class="fa fa-plus btn info2"></i></span>
                         <span class="tx  pull-right" id="show01" >MAKE AN ENQUIRY</span>
              </div>
                     <div class="col-sm-12 p1 " >
                        

                        
                            <div class="clearfix"></div>
                         
                         
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			
                            		<h4 class="Enq">Leave Your Details Here, We’ll Call You Shortly.</h4>
                        		</div>
                        		<div class="form-top-right">
                        			
                        		</div>
                            </div>
                             
                            
                            <div class="form-bottom contact-form">
			                    <form role="form" name="enquire_form" action="enquire_form" method="post" onsubmit="return(enqu_validate());">
			                        <div class="form-group">
			                        	<label class="sr-only" for="contact-subject">Name</label>
			                        	<input type="text" name="name" placeholder="Name..." class="contact-subject form-control" id="name" required>
			                        </div>
                                    
                                    <div class="form-group">
			                    		<label class="sr-only" for="contact-email">Email</label>
			                        	<input type="email" name="email" placeholder="Email..." class="contact-email form-control" id="email" required>
			                        </div>
                                    <div class="form-group">
			                        	<label class="sr-only" for="contact-subject">Phone Nomber</label>
			                        	<input type="text" name="phone_no" placeholder="Phone Number..." class="contact-subject form-control" id="phone_no" required>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="contact-message">Message</label>
			                        	<textarea name="message" placeholder="Message..." class="contact-message form-control" id="message" required></textarea>
			                        </div>
                                    <input type="submit" class="btn btn-block  btn-info" value="Send message" name="enqui_form">
			                        <!--<button type="submit" class="btn btn-block  btn-info">Send message</button>-->
			                       </form>
                                <h4 style="text-align:center; color: #00599D;     margin-bottom: 10px; margin-top:10px; font-weight:bold;"> CALL - 040 - 6454 7711</h4>
		                    </div>
                          
                           
                            
                        </div>
                </div>
     
          
          <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>  
      <script>
$(document).ready(function(){
    $("#hide01").click(function(){
        $(".p1").hide(100);
    });
    $("#show01").click(function(){
        $(".p1").show(100);
    });
	
	$("#hide01").click(function(){
        $(".tx").show(100);
    });
    $("#show01").click(function(){
        $(".tx").hide(100);
    });
});


</script> 
<script type="text/javascript">
  
      // Form validation code will come here.
      function enqu_validate()
      {
         if( document.enquire_form.Name.value == "" )
         {
            alert( "Please Enter your Name!" );
            document.enquire_form.Name.focus() ;
            return false;
         }
         if( document.enquire_form.email.value == "" )
         {
            alert( "Please provide your Email!" );
            document.enquire_form.email.focus() ;
            return false;
         }
         if( document.enquire_form.phone_no.value == "" )
         {
            alert( "Please provide your Phone Number!" );
            document.enquire_form.phone_no.focus() ;
            return false;
         }
		 if( document.enquire_form.message.value == "" )
         {
            alert( "Please provide your Discription!" );
            document.enquire_form.message.focus() ;
            return false;
         }
         return( true );
      }
  
</script>

<script>
$(document).ready(function(){
    
});
</script>  
<script type="text/javascript">
$(document).ready(function() {
    $("#phone_no").keydown(function (e) {
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
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)||$('#phone_no').val().length >= 10 || $('#phone_no').val().length == 10) {
            e.preventDefault();
        }
    });
	
	

});
</script>               
                        
 <!--<script type="text/javascript">
					   
					    
    $("#button").click(function(){
    if($(this).html() == "+"){
        $(this).html("-");
    }
    else{
        $(this).html("+");
    }
    $("#box").slideToggle({bottom: 'toggle'}, 1000);
    });

</script>-->

<!--<script type="text/javascript">
 (function() {
    $('a.maximize').click(function() {
        $($(this).attr('href')).animate({
        position: "relativ",
        top: 0,
        left: 0,
        height: '99.5%',
        width: '99.5%',
        opacity: 1,
  },1000)
});
});
$(function() {
    $('a.minimize').click(function() {
        $($(this).attr('href')).slideToggle();
});
});
</script>-->