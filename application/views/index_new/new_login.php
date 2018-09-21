<!DOCTYPE html>
<html class="no-js" lang="en">
  
<!-- Mirrored from rudhisasmito.com/demo/laundryes/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Sep 2015 04:42:03 GMT -->
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Strikers</title>
    <meta name="description" content="Laundryes - Laundry Business Html Template. It is built using bootstrap 3.3.2 framework, works totally responsive, easy to customise, well commented codes and seo friendly.">
    <meta name="keywords" content="laundry, multipage, business, clean, bootstrap">
    <meta name="author" content="rudhisasmito.com"> 
	<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	    
	<?php include('header.php'); ?>
	
    
    <style type="text/css">
    .logo_f {
    width: 213px;
    height: 36px;
    background-image: url("../images_n/apple-touch-icon.png");
    margin: 30px auto;
}

.login-block {
    width: 320px;
    padding: 0px 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #29ABE2;
    margin: 0 auto;
}
        
  

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #29ABE2;
}

.login-block button {
    width: 100%;
    height: 40px;
    background: #29ABE2;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #29ABE2;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

.login-block button:hover {
    background: #29ABE2;
}
        
        
       /* forgot possword*/
        
        
.panel-default {

    border: none !important;
}
        
.panel-default > .panel-heading {
   
    background-color: transparent !important;
   
} 
        .panel-default > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: transparent !important;
}
    </style>
</head>


<body>
	
	<!-- Load page -->
	
	
	
	<!-- NAVBAR SECTION -->
	<?php include('menu.php'); ?>

 
	<!-- login code -->
	
	

        <div class="logo_f" style="margin-top:110px;"></div>
      
    <!--<center><h1 style="font-size:27px ; margin:30px;">Thanks for Registering with Striker</h1></center>
    -->
<div class="login-block" style="padding-top:20px !importat;">
    <h1 style="    margin-top: 14px;">Login</h1>
    <form action="new_login.php" method="post">
    <input type="text" value="" placeholder="Username" id="username" />
    <input type="password" value="" placeholder="Password" id="password" />
    <button>Submit</button>
    </form>
    
    
    
    
</div>
   
<div class="login-block"  style=" text-align:left; width: 340px;
    padding-top:0px !importat;
    background: #fff;
    border-radius: 0px !important;
    border-top:none !important;
    margin: 0 auto;">
      <div class="panel-group " id="accordion" style="margin-top:10px; ">
  <div class="panel panel-default">
    <div >
      
        <a class="accordion-toggle panel-heading" href="#" style="font-size:13px ;"  data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">
         Forgot your password ?
        </a>
     <a class="accordion-toggle" href="#" style="font-size:13px ; text-align:right;">
         Create an account ?
        </a>
        
    </div>
    <div id="collapseOne" class="panel-collapse collapse ">
      <div class="panel-body">
          <form action="new_login.php" method="post">
       <input type="text" value="" placeholder="Email ID" id="username" />
    
    <button type="submit">Submit</button>
              </form>
      </div>
    </div>
  </div>
    
</div> 
     
       
  </div>     

		     
    
	
	<!-- login code end -->
	
	
	<div class="clearfix"></div>
	
	
	
	
	<!-- FOOTER SECTION -->
	<?php include('footer.php'); ?>
	
	
	<!-- -Login Modal -->

 	<!-- - Login Model Ends Here -->
	
	
     <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        
   
    <script type="text/javascript" src=" http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
   
    
    <script type="text/javascript" src=" http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
    <script>
$(document).ready(function() {
    $('#registrationForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            firstName: {
                row: '.col-xs-12',
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    }
                }
            },
            lastName: {
                row: '.col-xs-12',
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    }
                }
            },
            
            phoneNumber: {
                row: '.col-md-4',
                validators: {
                    notEmpty: {
                        message: 'Mobile Nomber is required'
                    }
                }
            },
             postalCode: {
                row: '.col-md-4',
                validators: {
                    notEmpty: {
                        message: 'Pin/Zip Code is required'
                    }
                }
            },
            
            
            
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            },
            
            fields: {
                
                phoneNumber: {
                    validators: {
                        phone: {
                            country: 'countrySelectBox',
                            message: 'The value is not valid %s phone number'
                        }
                    }
                }
            },
            
               
            
            agree: {
                validators: {
                    notEmpty: {
                        message: 'You must agree with the terms and conditions'
                    }
                }
            },
            
            
            
            birthday: {
                validators: {
                    notEmpty: {
                        message: 'The date of birth is required'
                    },
                    date: {
                        format: 'YYYY/MM/DD',
                        message: 'The date of birth is not valid'
                    }
                }
            }
        }
    });
});
</script>
    
    
   
	
</body>


</html>