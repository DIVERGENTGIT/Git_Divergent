<script type="text/javascript" src='<?php echo base_url();?>/js/jquery.js'></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href='<?php echo base_url();?>/css/bootstrap/dist/css/bootstrap_striker.css' media="all"/>
<script type="text/javascript" src='<?php echo base_url();?>/css/bootstrap/js/jquery.min.js'></script>
<script type="text/javascript" src='<?php echo base_url();?>/css/bootstrap/dist/js/bootstrap.min.js'></script>


<script src="<?php echo base_url();?>/js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>



<script type="text/javascript">

function fun_passwrod_chk()
{
	var txt_password_sales = $("#txt_password_sales").val();
	txt_password_sales=txt_password_sales.trim();
	var longcode_id_pop=$('#txt_sale_id').val();
	if(!txt_password_sales=='')
	{
		var data ={passcode:txt_password_sales,longcode_id_pop:longcode_id_pop};
		$.ajax({
				url: "<?php echo site_url(); ?>/striker_clients/pageAuthenticate.html",
				type: "POST",
				data: data,
				//data: {'passcode': '1'},
				cache: false,
				success: function (callback_data) 
				{
					var a_id_before_split=callback_data.split('.');
					//alert(a_id_before_split[0])
					//document.getElementById('ajaxmessge').innerHTML=a_id_before_split[0];
					var a_id_split=a_id_before_split[1]
					
					if(a_id_before_split[0]=='Y')
					{
						$('#div_user_id5').removeClass('form-group has-error');
						$('#div_user_id5').addClass('form-group');
						
						$('#div_user_id6').removeClass('form-group has-error');
						$('#div_user_id6').addClass('form-group');
						
						var a_id_split_final=a_id_split.split('#')
						//alert(a_id_split_final);
						//alert(a_id_split_final.length);
						for(i = 0; i < a_id_split_final.length; i++)
					    {				    	
							txtid='#txt_user_id'+i;
							$(txtid).val(a_id_split_final[i])
					    }
						$('#myModal').modal('hide');
						
						$('#btnGenerate_new').html('Generate'); 
						$('#btnGenerate_new').attr('disabled', false);
						$('#btnGenerate_new').removeClass('btn disabled');
						$('#btnGenerate_new').addClass('btn btn-primary btn-sm');
						$('#btnGenerate_cancel').show();
						
						$('#txt_user_id5').attr('disabled', false);
						$('#txt_user_id6').attr('disabled', false);
						
						$('#generate_before').modal('show');
					}
					else
					{
						//alert("error");
						$( "#txt_password_sales" ).focus();
						$('#div_pass').removeClass('form-group');
						$('#div_pass').addClass('form-group has-error');
						
						$('#div_pass_err').removeClass('form-group');
						$('#div_pass_err').addClass('form-group has-error');
						//$('error').addClass('form-group has-error label');
						
						$("#error").show();
					}
					//$('#dnd_chk_number_result').html(callback_data);
				}
		});
	}
	else
	{
		$( "#txt_password_sales" ).focus();
		$('#div_pass').removeClass('form-group');
		$('#div_pass').addClass('form-group has-error');
	}
}

function fun_gererate_invoice()
{
	var txt_user_id5 = $("#txt_user_id5").val();
	var txt_user_id6 = $("#txt_user_id6").val();
	var txt_sale_id = $("#txt_sale_id").val();
	//alert(txt_sale_id);
	var txt_user_id_generate = $("#txt_user_id_generate").val();
	//alert(txt_user_id_generate)
	
	var month=$('#month').val();
	var year = $('#year').val();
	var invoice_client_id = $('#client_id').val();
	var client_id = $('#client_id').val();
	var sale_type = $('#sale_type').val();
	var sms_type = $('#sms_type').val();
	var sales_exe = $('#sales_exe').val();
	
	if(!txt_user_id5=='' && !txt_user_id6=='')
	{
		//alert("call generate function");  .btn.disabled
		$('#btnGenerate_new').html('Processing, please wait...'); 
		$('#btnGenerate_new').attr('disabled', true);
		
		$('#btnGenerate_new').removeClass('btn btn-primary btn-sm');
		$('#btnGenerate_new').addClass('btn disabled');
		$('#btnGenerate_cancel').hide();
		
		$('#txt_user_id5').attr('disabled', true);
		$('#txt_user_id6').attr('disabled', true);
		
		window.location.href='<?php echo site_url(); ?>/striker_clients/generate_invoice/'+txt_sale_id+'/'+txt_user_id5+'/'+txt_user_id6;
		
		/*var url='<?php echo site_url(); ?>/striker_clients/generate_invoice/'+txt_sale_id
		//alert(url)
		$.post(url,{sale_ids:sale_ids,month:month,year:year,invoice_client_id:invoice_client_id,client_id:client_id,sale_type:sale_type,sms_type:sms_type,sales_exe:sales_exe,organization_new:txt_user_id5,manual_invoice_id:txt_user_id6},function(x)
		{ 
			alert(x);
		refresh_url='<?php echo site_url(); ?>/striker_clients/sales?'+x+'&month='+month+'&year='+year+'&client_id='+client_id+'&sale_type='+sale_type+'&sms_type='+sms_type+'&sales_exec='+sales_exe+'&invoice_id='+x
		//alert(refresh_url);
		//window.location.href=refresh_url;
		})*/
	}
	else
	{
		if(txt_user_id5=='')
		{
			$( "#txt_user_id5" ).focus();
			$('#div_user_id5').removeClass('form-group');
			$('#div_user_id5').addClass('form-group has-error');
		}
		else
		{
			$( "#txt_user_id6" ).focus();
			$('#div_user_id5').removeClass('form-group has-error');
			$('#div_user_id5').addClass('form-group');
		}
		if(txt_user_id6=='')
		{
			$( "#txt_user_id6" ).focus();
			$('#div_user_id6').removeClass('form-group');
			$('#div_user_id6').addClass('form-group has-error');
		}
		else
		{
			$( "#txt_user_id5" ).focus();
			$('#div_user_id6').removeClass('form-group has-error');
			$('#div_user_id6').addClass('form-group');
		}
		
	}
}

function fun_open_modal(user_id,payment_id)
{
	$('#txt_sale_id').val(payment_id);
	$('#txt_user_id_generate').val(user_id);
	$('#txt_password_sales').val('');
	$("#error").hide();
	$('#div_pass').removeClass('form-group has-error');
	$('#div_pass').addClass('form-group');
	$('#myModal').modal('show');
}


function fun_open_modal_individual()
{
	//$('#txt_sale_id').val(payment_id);
	//$('#txt_user_id_generate').val(user_id);
	$('#txt_password_individual').val('');
	$("#error_individual").hide();
	$('#div_pass_individual').removeClass('form-group has-error');
	$('#div_pass_individual').addClass('form-group');
	
	var check_sale_id_checked=validateForm_new()
	
	if(check_sale_id_checked==true)
	{
		$('#individual_model').modal('show');
	}
	else
	{
		$('#individual_model_error').modal('show');
	}
	//$('#individual_model').modal('show');
}

function validateForm_new()
{
    if($("input#sale_id:checked").length == 0)
    {
        return false;
    }
    else
    {
		return true;
	}
}

function fun_passwrod_chk_individual()
{
	var txt_password_sales = $("#txt_password_individual").val();
	txt_password_sales=txt_password_sales.trim();
	//var payment_id_pop=$('#sale_ids').val();
	var user_id_pop=$('#client_id').val();
	//alert(txt_password_sales)
	//alert(payment_id_pop)
	page=$(this).attr("#sale_id");
	ids=new Array()
	a=0;
	$("input#sale_id:checked").each(function(){
	//ids[a]=$(this).val();
	ids=ids+$(this).val()+",";
	a++;
	})
	//alert(ids)
	var result = ids.substring(0, ids.length-1);  //for remove last comma
	
	var payment_id_pop=result;
	//alert(payment_id_pop)
	if(!txt_password_sales=='')
	{
		//alert(user_id_pop)
		//alert(payment_id_pop)
		var data ={passcode:txt_password_sales,payment_id:payment_id_pop,user_id_pop:user_id_pop};
		$.ajax({
				url: "<?php echo site_url(); ?>/striker_clients/pageAuthenticate.html",
				type: "POST",
				data: data,
				//data: {'passcode': '1'},
				cache: false,
				success: function (callback_data) 
				{
					//alert(callback_data)
					var a_id_before_split=callback_data.split('.');
					
					var a_id_split=a_id_before_split[1]
					
					if(a_id_before_split[0]=='Y')
					{
						$('#div_user_id_individual5').removeClass('form-group has-error');
						$('#div_user_id_individual5').addClass('form-group');
						
						$('#div_user_id_individual6').removeClass('form-group has-error');
						$('#div_user_id_individual6').addClass('form-group');
						
						var a_id_split_final=a_id_split.split('#')
						
						for(i = 0; i < a_id_split_final.length; i++)
					    {
					    	if(i==0)
					    	{
								txtid='#txt_user_id_individual'+i;
								//var str = jQuery.param(payment_id_pop );
								//$(txtid).val(str)	
								$(txtid).val(payment_id_pop)	
							}
							else
							{
								txtid='#txt_user_id_individual'+i;
								$(txtid).val(a_id_split_final[i])	
							}
					    	//alert(a_id_split_final[i]);
							
					    }
						$('#individual_model').modal('hide');
						
						$('#btnGenerate_new_individual').html('Generate'); 
						$('#btnGenerate_new_individual').attr('disabled', false);
						$('#btnGenerate_new_individual').removeClass('btn disabled');
						$('#btnGenerate_new_individual').addClass('btn btn-primary btn-sm');
						$('#btnGenerate_cancel_individual').show();
						
						$('#txt_user_id_individual5').attr('disabled', false);
						$('#txt_user_id_individual6').attr('disabled', false);
						
						$('#generate_before_individual').modal('show');
						//var check_sale_id_checked=validateForm()
						//alert(check_sale_id_checked)
						
						//alert("submit form")
						//window.location.href='<?php echo site_url(); ?>/striker_clients/generate_invoice/'+txt_sale_id;
					}
					else
					{
						//alert("error");
						$( "#txt_password_individual" ).focus();
						$('#div_pass_individual').removeClass('form-group');
						$('#div_pass_individual').addClass('form-group has-error');
						
						$('#div_pass_err_individual').removeClass('form-group');
						$('#div_pass_err_individual').addClass('form-group has-error');
						//$('error').addClass('form-group has-error label');
						
						$("#error_individual").show();
					}
					//$('#dnd_chk_number_result').html(callback_data);
				}
		});
	}
	else
	{
		$( "#txt_password_individual" ).focus();
		$('#div_pass_individual').removeClass('form-group');
		$('#div_pass_individual').addClass('form-group has-error');
	}
}

function fun_gererate_invoice_individual()
{
	var txt_user_id5 = $("#txt_user_id_individual5").val();
	var txt_user_id6 = $("#txt_user_id_individual6").val();
	//var txt_sale_id = $("#txt_sale_id").val();
	//alert(txt_sale_id);
	//var txt_user_id_generate = $("#txt_user_id_generate").val();
	//alert(txt_user_id_generate)
	if(!txt_user_id5=='' && !txt_user_id6=='')
	{
		//alert("call generate function");  .btn.disabled
		$('#btnGenerate_new_individual').html('Processing, please wait...'); 
		$('#btnGenerate_new_individual').attr('disabled', true);
		
		$('#btnGenerate_new_individual').removeClass('btn btn-primary btn-sm');
		$('#btnGenerate_new_individual').addClass('btn disabled');
		$('#btnGenerate_cancel_individual').hide();
		
		$('#txt_user_id_individual5').attr('disabled', true);
		$('#txt_user_id_individual6').attr('disabled', true);
		//alert("form submit")
		//window.location.href='<?php echo site_url(); ?>/striker_clients/generate_invoice';
		//$.post(window.location, {name: 'John'});
		
		page=$(this).attr("#sale_id");
		ids=new Array()
		a=0;
		$("input#sale_id:checked").each(function(){
		ids[a]=$(this).val();
		a++;
		})
		
		//var result = ids.substring(0, ids.length-1);  //for remove last comma
		
		var sale_ids=ids;
		
		var month=$('#month').val();
		var year = $('#year').val();
		var invoice_client_id = $('#client_id').val();
		var client_id = $('#client_id').val();
		var sale_type = $('#sale_type').val();
		var sms_type = $('#sms_type').val();
		var sales_exe = $('#sales_exe').val();
		
		/*alert(sale_ids)
		alert(month)
		alert(year)
		alert(invoice_client_id)
		alert(client_id)
		alert(sale_type)
		alert(sms_type)
		alert(sales_exe)*/
		var url='<?php echo site_url(); ?>/striker_clients/generate_invoice'
		//alert(url)
		$.post(url,{sale_ids:sale_ids,month:month,year:year,invoice_client_id:invoice_client_id,client_id:client_id,sale_type:sale_type,sms_type:sms_type,sales_exe:sales_exe,organization_new:txt_user_id5,manual_invoice_id:txt_user_id6},function(x)
		{ 
			//alert(x);
		refresh_url='<?php echo site_url(); ?>/striker_clients/sales?'+x+'&month='+month+'&year='+year+'&client_id='+client_id+'&sale_type='+sale_type+'&sms_type='+sms_type+'&sales_exec='+sales_exe+'&invoice_id='+x
		//alert(refresh_url);
		window.location.href=refresh_url;
		
		//redirect("striker_clients/sales?invoice_id=$invoiceId&month=$month&year=$year&client_id=$client_id&sale_type=$sale_type&sms_type=$sms_type&sales_exec=$sales_exe&");
		//alert(x)
			/*$('#loading').hide();
			document.getElementById('pageResults').innerHTML='';
			document.getElementById('pageResults').innerHTML=x;*/
		})
	}
	else
	{
		if(txt_user_id5=='')
		{
			$( "#txt_user_id_individual5" ).focus();
			$('#div_user_id_individual5').removeClass('form-group');
			$('#div_user_id_individual5').addClass('form-group has-error');
		}
		else
		{
			$( "#txt_user_id_individual6" ).focus();
			$('#div_user_id_individual5').removeClass('form-group has-error');
			$('#div_user_id_individual5').addClass('form-group');
		}
		if(txt_user_id6=='')
		{
			$( "#txt_user_id_individual6" ).focus();
			$('#div_user_id_individual6').removeClass('form-group');
			$('#div_user_id_individual6').addClass('form-group has-error');
		}
		else
		{
			$("#txt_user_id_individual5").focus();
			$('#div_user_id_individual6').removeClass('form-group has-error');
			$('#div_user_id_individual6').addClass('form-group');
		}
		
	}
}


    function validateForm(){
        if($("input#sale_id:checked").length == 0){
            alert("Check atleast once invoice");
            return false;
        }
    }

    function showInvoice(invoice_id)
    {
        myRef = window.open('<?php echo site_url(); ?>/striker_clients/show_invoice/'+invoice_id, 'invoice', 'width=800,height=400,scrollbars=yes,location=no');
        myRef.focus();
    }
</script>

<script type="text/javascript">
  
  
    $(document).ready( function(){
        $('#from_date').datetimepicker({
            dateFormat: 'yyyy-mm-dd'
        });

        $('#to_date').datetimepicker({
            dateFormat: 'yyyy-mm-dd'
        });
    });
</script>
<h2>Long Code - Received SMS</h2>
<div class="form">
    <?php if(isset($no_long_code) && $no_long_code): ?>
        <div align="center"><h3>Your not subscribed for Long Code Service. To subscribe Call 040-64547711.</h3></div>
    <?php else: ?>
        <?php echo form_open('longcode/index',array('name' => 'sms_inbox_search', 'id' => 'sms_inbox_search')); ?>
        <table cellpadding=0 cellspacing=0 class="textsmstd" align="center" >
            
            <tr>
            
            <td>From Date:&nbsp;</td>
                <td><?php echo form_input(array('name' => 'from_date', 'id' => 'from_date', 'class' => 'inputText', 'style' => 'width:200px;', 'value' => set_value('from_date')))?>&nbsp;</td>

                <td>To Date:&nbsp; </td><td><?php echo form_input(array('name' => 'to_date', 'id' => 'to_date','class' => 'inputText',  'style' => 'width:200px;', 'value' => set_value('to_date')))?>&nbsp;</td>

                <td>&nbsp;<?php echo form_submit(array('name' => 'Search','value' => 'Go', 'class' => 'button'));?></td>
            </tr>
        </table>
        <?php echo form_close();?>
		
		<a href="<?php echo site_url('longcode/invalidateLongCodeSession'); ?>">Change Code</a>
		
    <a href="<?php echo site_url('longcode/download/'.$from_date.'/'.$to_date); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Export to Excel</strong><span class="bt_green_r"></span></a>

        <table id="rounded-corner" summary="SMS inbox Report">
            <thead>
            <tr>
                <th scope="col" class="rounded-company"></th>
                <th scope="col" class="rounded">On Date</th>
                <th scope="col" class="rounded">To</th>
                <th scope="col" class="rounded">From</th>
                <th scope="col" class="rounded-q4">SMS Text</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="4" class="rounded-foot-left">&nbsp;</td>
                <td class="rounded-foot-right">&nbsp;</td>

            </tr>
            </tfoot>
            <tbody>
            <?php
            $count=1;
            foreach($received_sms as $sms):
                ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $sms->created_on; ?></td>
                <td><?php echo $sms->code_number; ?></td>
                <td><?php echo $sms->from_number; ?></td>
                <td><?php echo wordwrap($sms->sms_text,60,"\n",1); ?></td>
            </tr>

                <?php
                $count++;
            endforeach;
            ?>
            </tbody>
        </table>
        <div align='center' class="pagination">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    <?php endif; ?>
    
    
    <!-- New Code For POPUP Start ----->
        <div class="modal fade" id="myModal" style="margin: 120px 1px 1px 150px; width: 500px;">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="purchaseLabel" style="text-align: left">Enter Password</h4>
		            </div>
		            <div class="modal-body" style="text-align: left">
		                 <div class="form-group" id="div_pass">
		                    <div class="input-group">
		                        <!--<span class="input-group-addon">Enter Password : </span>-->
		                        <span class="control-label">Password : </span>
		                        <input type="password" id="txt_password_sales" name="txt_password_sales" class="form-control" placeholder="Password">
		                    </div>
		                </div>
		                <div class="form-group" id="div_pass_err" >
		                	<span class="control-label" for="inputError" id="error" style="display: none;">Password Mismatch</span>
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-primary btn-sm" id="btnPassword_chk_sales" name="btnPassword_chk_sales" onclick="fun_passwrod_chk()">OK</button>
		            </div>
		        </div>
		    </div>
		</div>
</div>		









