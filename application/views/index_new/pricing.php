
	<style type="text/css">
   a {
    color: #FFFFFF;
       text-decoration: none !important;}
    
/*.btn-sky {
    color: #fff;
    background-color: #0bacd3;
    border-bottom: 2px solid #098aa9 !important;
}*/
.btn-sky {
    color: #fff;
    background-color: #0071BC;
    border-bottom: 2px solid #27A3C1 !important;
}        
.btn-xs {
    font-weight: 300;
     color:#fff !important;
}
.btn {
    margin: 4px;
    box-shadow: 1px 1px 5px #3BA7D6;
     color:#fff !important;
}
.btn-xs, .btn-group-xs>.btn {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
     color:#fff !important;
}
.btn {
    display: inline-block;
    
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    
   
}
.text-capitalize {
    text-transform: capitalize;
}
        
        a:hover {
    text-decoration: none;
    color: #fff;
}

        table.col-md-12.table-bordered.table-striped.table-condensed.cf {
    text-align: center !important;
}
        th.numeric {
    text-align: center !important;
}
        
        
       /* thead.cf {
    background-color: #4EB7E4;
    color: #fff;
    font-weight: 600;
   
}*/
 thead.cf {
    
    font-weight: 600;
   
}
        
        .hdd_1{ background-color: #0071BC; color: #fff !important;}
        
         .hdd_2{ background-color: #4EB7E4; color: #fff !important;}
        
         .hdd_3{ background-color: #0071BC; color: #fff !important;}
        
         .hdd_4{ background-color: #4EB7E4; color: #fff !important;}
        
         .hdd_5{ background-color: #0071BC; color: #fff !important;}
        
          .hdd_6{ background-color: #4EB7E4; color: #fff !important;}
   
        
       /* border none*/
        
 th.numeric {
    border-left: 0px !important;
    border-right: 0px !important;
}
td.numeric {
    border-right: 0px !important;
    border-left: 0px !important;
}        
   
 /*popup model text colors*/       
 a.signup-tab {
    color: rgb(82, 183, 251) !important;
}
 a#forgetpass-taba {
    color: #777 !important;
}

.top_login{ position:absolute; z-index:1000;
       top: 200px !important;
	   position:fixed; 
	   left: 0px !important;
	    }
        </style>

<body>
	<!-- BANNER -->
	<div class="section subbanner col-sm-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="caption">
						
						<ol class="breadcrumb">
                               
						  <li class="active">Home</li>
						  <li class="active">Pricing</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	
	<!-- ABOUT SECTION -->
	<div id="services" class="section services">
		<div class="container">
			<!--  -->
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="page-title">
						<h2 class="lead">OUR PRICING TABLE</h2>
						
					</div>
				</div>
			</div>





			<!-- price table  -->
            
			<div class="row">
			
               <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed cf">
        		<thead class="cf">
        			<tr>
        				
        				<th class="numeric hdd_1" style="background-color:#0071BC;">SMS Pack</th>
        				<th class="numeric hdd_2" style="background-color:#0071BC;">Price Per SMS</th>
        				<th class="numeric hdd_3" style="background-color:#0071BC;">Amount</th>
        				<th class="numeric hdd_4" style="background-color:#0071BC;">Service Tax(15%)</th>
        				<th class="numeric hdd_5" style="background-color:#0071BC;">Total Amount</th>
        				<th class="numeric hdd_6" style="background-color:#0071BC;">Activity</th>
        			
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
        				<td  class="numeric hdd_1">1000</td>
        				<td  class="numeric hdd_2">Rs. 0.40</td>
        				<td  class="numeric hdd_3">Rs. 400</td>
        				<td class="numeric hdd_4">Rs.60</td>
        				<td  class="numeric hdd_5">Rs. 460</td>
        				<td  class="numeric hdd_6">
<?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="1000"  />
<input type="hidden"  name="planprice" id="planprice" value="460"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>

<?php echo form_close();?>
                      

                        </td>
        			
        			</tr>
        			
                    <tr>
        				<td  class="numeric hdd_1">5000</td>
        				<td  class="numeric hdd_2">Rs. 0.35</td>
        				<td  class="numeric hdd_3">Rs. 1750</td>
        				<td class="numeric hdd_4">Rs.262.5</td>
        				<td  class="numeric hdd_5">Rs. 2012.5</td>
        				<td  class="numeric hdd_6">
						<?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="5000"  />
<input type="hidden"  name="planprice" id="planprice" value="2012.5"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>

<?php echo form_close();?>
                      

                        </td></tr>
        			
                        
                        <tr>
        				<td  class="numeric hdd_1">10000</td>
        				<td  class="numeric hdd_2 ">Rs. 0.30</td>
        				<td  class="numeric hdd_3">Rs. 3000</td>
        				<td class="numeric hdd_4">Rs.450</td>
        				<td  class="numeric hdd_5">Rs. 3450</td>
        				<td  class="numeric hdd_6">
						<?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="10000"  />
<input type="hidden"  name="planprice" id="planprice" value="3450"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>

<?php echo form_close();?>
                     
          
                        </td>
        			</tr>
                            <tr>
        				<td  class="numeric hdd_1">20000</td>
        				<td  class="numeric hdd_2">Rs. 0.25</td>
        				<td  class="numeric hdd_3">Rs. 5000</td>
        				<td class="numeric hdd_4">Rs.750</td>
        				<td  class="numeric hdd_5">Rs.5750</td>
        				<td  class="numeric hdd_6">
                      <?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="20000"  />
<input type="hidden"  name="planprice" id="planprice" value="5750"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>



<?php echo form_close();?>

                        </td></tr>
        			<tr>
        				<td  class="numeric hdd_1">50000</td>
        				<td  class="numeric hdd_2">Rs. 0.20</td>
        				<td  class="numeric hdd_3">Rs. 10000</td>
        				<td class="numeric hdd_4">Rs. 1500</td>
        				<td  class="numeric hdd_5">Rs. 11500</td>
        				<td  class="numeric hdd_6">
                      <?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="50000"  />
<input type="hidden"  name="planprice" id="planprice" value="11500"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>

<?php echo form_close();?>

                        </td></tr>
        			<tr>
        				<td  class="numeric hdd_1">80000</td>
        				<td  class="numeric hdd_2">Rs. 0.17</td>
        				<td  class="numeric hdd_3">Rs. 13600</td>
        				<td class="numeric hdd_4">Rs. 2040</td>
        				<td  class="numeric hdd_5">Rs. 15640</td>
        				<td  class="numeric hdd_6">
                      <?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="80000"  />
<input type="hidden"  name="planprice" id="planprice" value="15640"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>

<?php echo form_close();?>

                        </td></tr>
        			<tr>
        				<td  class="numeric hdd_1">1 Lc</td>
        				<td  class="numeric hdd_2">Rs. 0.15</td>
        				<td  class="numeric hdd_3">Rs. 15000</td>
        				<td class="numeric hdd_4">Rs. 2250</td>
        				<td  class="numeric hdd_5">Rs. 17250</td>
        				<td  class="numeric hdd_6">
                      <?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="100000"  />
<input type="hidden"  name="planprice" id="planprice" value="17250"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>


<?php echo form_close();?>

                        </td></tr>
        			<tr>
        				<td  class="numeric hdd_1">2 Lc</td>
        				<td  class="numeric hdd_2">Rs. 0.14</td>
        				<td  class="numeric hdd_3">Rs. 28000</td>
        				<td class="numeric hdd_4">Rs. 4200</td>
        				<td  class="numeric hdd_5">Rs. 32200</td>
        				<td  class="numeric hdd_6">
                     <?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="200000"  />
<input type="hidden"  name="planprice" id="planprice" value="32200"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>

<?php echo form_close();?>

                        </td></tr>
        			<tr>
        				<td  class="numeric hdd_1">3 Lc</td>
        				<td  class="numeric hdd_2">Rs. 0.13</td>
        				<td  class="numeric hdd_3">Rs. 39000</td>
        				<td class="numeric  hdd_4">Rs. 5850</td>
        				<td  class="numeric hdd_5">Rs. 44850</td>
        				<td  class="numeric hdd_6">
                     <?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="300000"  />
<input type="hidden"  name="planprice" id="planprice" value="44850"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>

<?php echo form_close();?>

                        </td></tr>
        			<tr>
        				<td  class="numeric hdd_1">4 Lc</td>
        				<td  class="numeric hdd_2">Rs. 0.12</td>
        				<td  class="numeric hdd_3">Rs. 48000</td>
        				<td class="numeric hdd_4">Rs. 7200</td>
        				<td  class="numeric hdd_5">Rs. 55200</td>
        				<td  class="numeric hdd_6">
                      <?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="400000"  />
<input type="hidden"  name="planprice" id="planprice" value="55200"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>

<?php echo form_close();?>

                        </td>
        			<tr>
        				<td  class="numeric hdd_1">5 Lc</td>
        				<td  class="numeric hdd_2">Rs. 0.11</td>
        				<td  class="numeric hdd_3">Rs. 55000</td>
        				<td class="numeric hdd_4">Rs.8250</td>
        				<td  class="numeric hdd_5">Rs. 63250</td>
        				<td  class="numeric hdd_6">
                      <?php 
echo form_open('billings', array('id' => 'price_form', 'name' => 'price_form') ); ?>
<input type="hidden" name="qnty" id="qnty" value="500000"  />
<input type="hidden"  name="planprice" id="planprice" value="63250"/> 
<?php echo  form_submit(array('name' => 'price','value' => 'Pay Now', 'class' => 'btn btn-sky center text-capitalize btn-sm'));?>

<?php echo form_close();?>
          
                        </td></tr>
        		</tbody>
        	</table>
        </div>
				</div>
            
            
			<!--  -->
		<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="page-title">
                    
					</div>
				</div>
			</div>
			
			<!--<div class="row">
			
				<div class="col-sm-12 col-md-6">
					<div class="price-detail">
						<div class="price-detail-heading">Dry Cleaning.</div>
						<div class="price-detail-body">
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>All Shirts</div>
								<div class="item-price">$ 1.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Pants, Jeans, Skirt</div>
								<div class="item-price">$ 2.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Sweeters</div>
								<div class="item-price">$ 6.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Tie, Scarf</div>
								<div class="item-price">$ 5.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Coat, Heavy Jacket, Dress</div>
								<div class="item-price">$ 10.50</div>
							</div>
							
						</div>
					</div>
		
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="price-detail">
						<div class="price-detail-heading">Laundry Press.</div>
						<div class="price-detail-body">
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Sheets</div>
								<div class="item-price">$ 1.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Pillowcases</div>
								<div class="item-price">$ 2.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Duvet Covers</div>
								<div class="item-price">$ 6.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Bed Covers</div>
								<div class="item-price">$ 5.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Gorden</div>
								<div class="item-price">$ 10.50</div>
							</div>
							
						</div>
					</div>
		
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="price-detail">
						<div class="price-detail-heading">Special Items.</div>
						<div class="price-detail-body">
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Fancy Dresses</div>
								<div class="item-price">$ 1.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Comforters</div>
								<div class="item-price">$ 2.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Handkerchief</div>
								<div class="item-price">$ 6.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Tuxedo Shirt</div>
								<div class="item-price">$ 5.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Polo (laundered short sleeve)</div>
								<div class="item-price">$ 10.50</div>
							</div>
							
						</div>
					</div>
		
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="price-detail">
						<div class="price-detail-heading">Leather Items.</div>
						<div class="price-detail-body">
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Fancy Dresses</div>
								<div class="item-price">$ 21.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Comforters</div>
								<div class="item-price">$ 22.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Handkerchief</div>
								<div class="item-price">$ 16.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Tuxedo Shirt</div>
								<div class="item-price">$ 85.50</div>
							</div>
							<div class="item">
								<div class="item-name"><i class="fa fa-check-circle"></i>Polo (laundered short sleeve)</div>
								<div class="item-price">$ 6.50</div>
							</div>
							
						</div>
					</div>
		
				</div>
				
				<div class="col-sm-12 col-md-12">
				
				<p class="more-info-price">Get discount 10% if you join our membership. <br />
				Leather items (1 - 2 weeks finish). <br />
				Don't worry if your items not listed here, <a href="mailto:mail@email.com" title="">Send Us Message</a> and we will take care of it.</p>
				</div>
			</div>-->
			
			
			
		</div>
	</div>
	
	
	<!-- FOOTER SECTION -->
	
	
	<!-- -Login Modal -->

 	<!-- - Login Model Ends Here -->
	
	
	
	
</body>

</html>
