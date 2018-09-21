<?php //include('menu.php'); ?>
<?php //include('header.php'); ?>
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
.mbtns { bottom:0px; padding:0px !important; margin-left:16px; margin-top:5px;  margin-bottom:5px;}	
.tx{ display:none; font-size: 17px;}	
	
input.btn.btn-block.btn-info {
    border-radius: 0px !important;
}
.call2{text-align:center; color: #00599D;  margin-bottom: 10px; margin-top:10px; font-weight:bold;}
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
	.well2 { width: 90% !important;}
	
	
	}
	
	

</style>

  
              <div class="mbtns">       
                           <span  id="hide01" title="Minimize "><i class="fa fa-minus btn info2" ></i></span>
                           <span  id="show01" title="Opne Form  "><i class="fa fa-plus btn info2"></i></span>
                           <span class="tx" id="show01" >MAKE AN ENQUIRY</span>
              </div>
              
                     <div class="col-sm-12 col-xs-12 col-xs-12 p1">
                            <div class="clearfix"></div>
                         	<h4 class="Enq">Leave in Your details and we'll call You back shortly!</h4>
                     <div>
                            
                               <form role="form" action="http://strikersoftsolutions.com/strikernewtheme/team.php" method="post">
			                    	
			                        <div class="form-group">
			                        	<label class="sr-only" for="contact-subject">Name</label>
			                        	<input type="text" name="subject" placeholder="Name..." class="contact-subject form-control" id="contact-subject">
			                        </div>
                                    
                                    <div class="form-group">
			                    		<label class="sr-only" for="contact-email">Email</label>
			                        	<input type="text" name="email" placeholder="Email..." class="contact-email form-control" id="contact-email">
			                        </div>
                                    <div class="form-group">
			                        	<label class="sr-only" for="contact-subject">Phone Nomber</label>
			                        	<input type="text" name="subject" placeholder="Phone Nomber..." class="contact-subject form-control" id="contact-subject">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="contact-message">Message</label>
			                        	<textarea name="message" placeholder="Message..." class="contact-message form-control" id="contact-message"></textarea>
			                        </div>
                                    <input type="submit" class="" value="Send message" name="about">
			                        <!--<button type="submit" class="btn btn-block  btn-info">Send message</button>-->
			                 
                              </form>
    


<h4 class="call2" > CALL - 040 - 6454 7711</h4>
		                    </div>
                          
                           
                            
                        </div>
             
     <?php //include('footer.php'); ?>
          
     <script type="text/javascript" src="js/jquery.min.js"></script> 
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

<script>
$(document).ready(function(){
    
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