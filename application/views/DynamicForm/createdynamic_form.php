<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css">
<link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/js/jquery-1.3.2.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/formutil.js"></script>
<script type="text/javascript"> 
//console.log(sqltype_array[6]);
var inc=1;

function create_elements(element_type)	{

var initial_load_opt_value=1;
//alert(element_type);

	var close_element=function(element_type)	{
	var elem;
		//console.log(element_type);
		elem='<div class="col-sm-8 blockdiv">';
		
		elem+= first_element(element_type);
		elem+= common_element(inc);
			
		elem+= initial_load_opt(element_type,inc);
		elem+='</div>';
		//alert(elem);
		$('#embedelement').append(elem);
		inc++;
	}
	
	var val1=$("#mainsub_count").val(); 
	
	
	$('#count_val').val(inc+val1);
	

	
	var type_obj_arr1={1:'TEXT',2:'PASSWORD',3:'SELECT',4:'MULTIPLE SELECT',5:'TEXTAREA',6:'RADIO',7:'CHECKBOX',8:'DATE'};
	
	var type_obj_arr2={1:'text',2:'password',3:'select',4:'multiple_select',5:'textarea',6:'radio',7:'checkbox',8:'date'};

	var first_element=function(element_type)	{
	
	//alert(initial_load_opt_value);
	
	
	
	return '<div class="block_element"><div style="float:right;"><input type="hidden" name="element_type['+inc+']"  value="'+type_obj_arr2[element_type]+'"  /><input type="hidden" name="element_load_options['+inc+']"  value="'+initial_load_opt_value+'"  /></div></div>';	
	//<input type="button"  value="X" name="delete" onclick="remove_block(this);" />
	
	}

	var initial_load_opt=function(element_type,blockno)	{
	
	if(element_type==3 || element_type==4 || element_type==6 || element_type==7)	{
		var elem='';
		elem='<div class="block_element"><fieldset><legend >Options<img src="<?php echo base_url(); ?>images/add.jpg"  style="float:none; vertical-align:middle;"  onclick="add_options(this,'+element_type+','+blockno+')"  /></legend><div class="block_options"><input type="hidden" name="option_count'+element_type+'" id="option_count'+element_type+'" value="'+initial_load_opt_value+'" />';
		
		for(var i=1;i<=initial_load_opt_value;i++)	{
			elem+=element_opt(element_type,blockno,i);
		}
		elem+='</div></fieldset></div>';
		//alert(elem);
		return elem;
		}
		return '';
	}
	
	var common_element1=function(inc,element_type)	{
	
	var commonelement='';
	commonelement='<div class="common_element">';
	commonelement+='<div class="col-sm-12 block_element"><div class="col-sm-4 block_label">Label</div><div class="col-sm-7"><input type="text" name="element_label['+inc+']" value=""></div></div><div class="col-sm-12 block_element"><div class="col-sm-4 block_label">Field Name</div><div class="col-sm-7"><input type="text" name="element_fieldname['+inc+']" value="" /></div></div><div class="block_element"><div class="block_label">Need database integration?</div><div><input type="checkbox" name="element_database_yn['+inc+']" value="1" /></div></div>';
	/*
	commonelement+='<div class="block_element"><li class="block_label">Mysql Type</li><li><select name="element_mysql_type['+inc+']" class="u" ><option value="1">CHAR</option><option value="2"selected="selected">VARCHAR</option><option value="3">TINYINT</option><option value="4">DATE</option><option value="5">SMALLINT</option><option value="6">MEDIUMINT</option><option value="7">INT</option><option value="8">BIGINT</option><option value="9">FLOAT</option><option value="10">DECIMAL</option><option value="11">DATETIME</option><option value="12">TIME</option><option value="13">YEAR</option><option value="14">TINYTEXT</option><option value="15">MEDIUMTEXT</option><option value="16">TEXT</option><option value="17">LONGTEXT</option><option value="18">ENUM</option><option value="19">SET</option><option value="20">BOOL</option><option value="21">BINARY</option><option value="22">VARBINARY</option></select></li></div>';
	
	commonelement+='<div class="block_element"><li class="block_label">Field Length</li><li><input type="text" name="element_mysql_length['+inc+']" value="" /></li></div>';
	commonelement+='<div class="block_element"><li class="block_label">Is NULL</li><li><select name="element_mysql_isnull['+inc+']" class="u"  valtype="integers" ><option value="1">not null</option><option value="2">null</option></select></li></div>';
	commonelement+='<div class="block_element"><li class="block_label">Mysql Default Value</li><li><input type="text" name="element_mysql_default['+inc+']" value="" /></li></div>'; */
commonelement+='</div> ';

	return commonelement;
	
	}
	
	
	var common_element=function(inc)	{
	//alert(element_type);
	var mysql_type=2;
	var date_format='';	
		
if(element_type==8){
mysql_type=4;
date_format='<div class="block_element"><li class="block_label">Date Format</li><li><select name="mysql_date_format" class="u" >'+ getArray2List(dateformat_array,1)+'</select></li></div>';

}
	
	var commonelement='';
	commonelement='<div class="common_element">';
	//elem_typen , label, fldname, 	db_need, mysql_type, mysql_length, mysql_isnull, mysql_default
		
	commonelement+='<div class="form-group"><label class="col-sm-3 control-label">Label Name</label><div class="col-sm-6"><input  class="form-control" name="elem_typen" value="'+element_type+'" type="hidden"><input  class="form-control" type="text" name="label'+inc+'" value=""></div><div class="col-sm-3"><img src="<?php echo base_url(); ?>images/delete.png" class="del-opt" data-toggle="tooltip" title="delete" onclick="remove_block(this);"/></div><div class="col-sm-2 block_label"></div><div class="col-sm-3"><input type="hidden" name="fldname'+inc+'" value="'+type_obj_arr2[element_type]+'" /></div></div>';
	
	return commonelement;
	
	}

	close_element(element_type);
}


function update_elements(element_type,blockobj)	{

var initial_load_opt_value=3;

	var close_element=function(element_type)	{
		var elem;
		//alert(blockobj.elem_typen);
		
		elem='<div class="blockdiv">';
		elem+= first_element(element_type);
		elem+= common_element(inc);
		
		if(typeof blockobj.options !="undefined" && typeof blockobj.options =='object')		{
			//alert("Object Exists");
			elem+= initial_load_opt(element_type,inc,blockobj.options);
		}
		
		elem+='</div>';
		
		//console.log(elem);
		
		//alert(blockobj.options);
		//$("#embedelement").html("");
		$('#embedelement').append(elem);
		
		
		inc++;
	}
	
	var first_element=function(element_type)	{
	//alert(initial_load_opt_value);
	
	var type_obj_arr1={1:'TEXT',2:'PASSWORD',3:'SELECT',4:'MULTIPLE SELECT',5:'FILE',6:'RADIO',7:'CHECKBOX',8:'DATE'};
	
	var type_obj_arr2={1:'text',2:'password',3:'select',4:'multiple_select',5:'file',6:'radio',7:'checkbox',8:'date'};
	
	return '<div class="block_element" style="color:#fff;background-color: #08c; height:25px;vertical-align:middle;"><span style=" font-size:20px; ">'+(inc)+'</span> - <span>'+type_obj_arr1[element_type]+'</span><div style="float:right;"><input type="hidden" name="element_type['+inc+']"  value="'+type_obj_arr2[element_type]+'"  /><input type="hidden" name="element_load_options['+inc+']"  value="'+initial_load_opt_value+'"  /><span onclick="remove_block(this);" />X</span></div></div>';
	
	}

	var initial_load_opt=function(element_type,blockno,blockopts)	{
	var def;
	element_type=parseInt(element_type);
	//alert(blockno);
	if(blockopts!='undefined' && blockopts.length>0 && (element_type==3 || element_type==4 || element_type==6 || element_type==7))	{
	//alert(blockopts.length);
		var elem='';
		
		elem='<div class="block_element"><fieldset><legend>Options<img src="<?php echo base_url(); ?>images/add.jpg"  style="float:none; vertical-align:middle;"  onclick="add_options(this,'+element_type+','+blockno+')"  /></legend><div class="block_options">';
		
			for(i in blockopts)	{
				//console.log(i+"--"+blockopts[i].def);
				//def=parseInt(blockopts[i].def);
			elem+=element_opt(element_type,blockno,(parseInt(i)+1),blockopts[i].opt_name,blockopts[i].def);
			}
		
/*		for(var i=1;i<=blockopts.length;i++)	{

			elem+=element_opt(element_type,blockno,i);
		}
*/		
		elem+='</div></fieldset></div>';
		//alert(elem+"sle");
		return elem;		
		}
		return '';
	}
	
	
	
	var common_element=function(inc)	{
	//alert(blockobj.mysql_isnull);
	
	//var mysql_nulls=parseInt(blockobj.mysql_isnull);
	//var mysql_types=parseInt(blockobj.mysql_type);
	
	//var sqltypes=getArray2List(sqltype_array,blockobj.mysql_type);

	var commonelement='';
	commonelement='<div class="common_element">';
		
	var db_need_chk=(blockobj.db_need==1)?'checked="Checked"':'';
	commonelement+='<label class="col-sm-4 padding_zero col-xs-12 block_label">Label</label><div class="col-sm-7 padding_mzero"><input name="elem_typen" value="'+blockobj.elem_typen+'" type="hidden"><input type="text" name="label" value="'+blockobj.label+'" /></div><label class="col-sm-4 padding_zero col-xs-12 block_label">Field Name</label><div class="col-sm-7 col-xs-12 padding_mzero"><input type="text" name="fldname" value="'+blockobj.fldname+'" onChange="return ValidateAlphanumeric(this);" valtype="varchars"  /></div></div>';
	

//alert(commonelement);

	return commonelement;
	
	}


	
	close_element(element_type);

	
}


	var element_opt1=function(element_type,blockno,option_num)	{
	var opt='';
	
		switch(element_type)	{
		case 3:
		case 6:
		opt='<div class="col-sm-12 listoptions"><div class="col-sm-4 padding_mzero"><input type="text" placeholder="Enter Option" name="default_opt['+blockno+'][0]" value="" /></div><div class="col-sm-6 padding_mzero"><input type="text" name="option_text['+blockno+']['+option_num+']" placeholder="Enter Option" /></div><div class="col-sm-2 padding_mzero"><img src="<?php echo base_url(); ?>images/delete.png" class="del-opt" data-toggle="tooltip" title="delete" onclick="removeoptions(this)"/></div></div>';
		break;
		case 4:
		case 7:
		opt='<div class="col-sm-12 listoptions"><div class="col-sm-4 padding_mzero"><input type="checkbox" name="default_opt['+blockno+']['+option_num+']" value="'+option_num+'" /></div><div class="col-sm-6 padding_mzero"><input type="text"  name="option_text['+blockno+']['+option_num+']"  /></div><div class="col-sm-2 padding_mzero"><img src="<?php echo base_url(); ?>images/delete.png" class="del-opt" data-toggle="tooltip" title="delete" onclick="removeoptions(this)"/></div></div>';
		
		break;
		}
		
		return opt;
	}
	
	var element_opt=function(element_type,blockno,option_num,option_val,defaultval)	{
	$("#sub_count").val(option_num);
	//alert(option_num);
	var opt='';
	var option_vals=(option_val!='' && option_val!=null && option_val!='undefined')?option_val:"";
	var defaultvals_chk=(defaultval!='' && defaultval==1)?'checked="Checked"':'';
	//console.log("element_type="+element_type+"::option_vals="+option_vals+"::defaultval"+defaultval+"::defaultvals_chk"+defaultvals_chk);
	
	element_type=parseInt(element_type);
	
		switch(element_type)	{
		case 3:
opt='<li class="listoptions form-group"><div class="col-sm-6 col-sm-offset-3 padding_mzero"><input type="text" class="form-control" placeholder="Enter Option" name="opt_lable'+blockno+''+option_num+'" value="" /></div><img src="<?php echo base_url(); ?>images/delete.png" class="del-opt" data-toggle="tooltip" title="delete" onclick="removeoptions(this)"/></li>';

		break;
		case 6:
		case 4:
		case 7:
		opt='<li class="form-group listoptions"><div class="col-sm-6 col-sm-offset-3  padding_mzero"><input type="text" placeholder="Enter Value" class="form-control" name="opt_lable'+blockno+''+option_num+'" value=""/></div><img src="<?php echo base_url(); ?>images/delete.png" data-toggle="tooltip" title="delete" class="del-opt" onclick="removeoptions(this)"/></li>';
		
		break;
		}
		
			//console.log("element_type="+element_type+"blockno="+blockno+"option_num="+option_num+"option_val="+option_val+"\nopt="+opt);

	//alert(opt);	
		return opt;
		
	}
	

function remove_block(obj)	{
	
	$(obj).parent().parent().parent().remove();
	
}


function add_options(obj,element_type,block_no)	{

var sub_val = $("#sub_count").val();
var mainsub_val = $("#mainsub_count").val();
var sub_val = $("#sub_count").val();
//alert(mainsub_val);

console.log(sub_val);
console.log(mainsub_val);

if(mainsub_val == '')
{
	sub_val = Number(sub_val)+1;
	$("#mainsub_count").val(sub_val);
}
else
{
	sub_val = Number(sub_val)+1;
	mainsub_val = Number(mainsub_val)+1;
	$("#mainsub_count").val(mainsub_val);
}


var str= element_opt(element_type,block_no,sub_val);	
//alert($(obj).parent().parent().find(".block_options .listoptions").length);
	if($(obj).parent().parent().find(".block_options .listoptions").length<100)
		$(obj).parent().parent().children('.block_options').append(str);

}


function removeoptions(obj)	{
if($(obj).parent().parent().children(".block_options li").length>1)
	$(obj).parent().remove();
else
	alert("Atleast single option needed for this block");
	
//alert($(obj).parent().parent().html());
//alert($(obj).parent().parent().children(".block_options li").length);
//$('.tr_sub').length<=25
	//$(obj).parent().remove();
}

//create_elements(1);

function copy_code(fldid)	{
	
$("#"+fldid).focus();
$("#"+fldid).select();
	
}
function preloader()	{
		$('div#lightbox_wploader').css({left:(leftMargin-150)}).slideDown(300);
}
function preloaderHide(){
	$('#lightbox_wploader').slideUp(200);
}

</script>
<script>


$(document).ready(function()	{


var global_opt=new Array();
var global_options='';
$("#backtoform_btn").click(function()	{
	
					$(".blockdiv").show();
					$("#embedelement").show();
					
					$("#phpformcode_text").text("");
					$("#phpservercode_text").text("");
					$("#phpdbcode_text").text("");
					$("#phpgeneratedcode").hide();
					$("#formtop_config").show();
	
})

$("#createcode_btn").click(function()	{


var h=0;
global_opt[h++]=($(":input[name='tablename']").val()!='')?'"tablename":"'+$(":input[name='tablename']").val()+'"':'"tablename":""';
global_opt[h++]=($(":input[name='primarykey']").val()!='')?'"primarykey":"'+$(":input[name='primarykey']").val()+'"':'"primarykey":""';
global_opt[h++]=($(":input[name='primarykeylength']").val()!='')?'"primarykeylength":'+$(":input[name='primarykeylength']").val():'"primarykeylength":0';
global_opt[h++]=($(":input[name='filename1']").val()!='')?'"filename1":"'+$(":input[name='filename1']").val()+'"':'"filename1":""';
global_opt[h++]=($(":input[name='filename2']").val()!='')?'"filename2":"'+$(":input[name='filename2']").val()+'"':'"filename2":""';
global_opt[h++]=($("#require_email:checked").val()=='email')?'"require_email":'+1:'"require_email":'+0;
global_opt[h++]=($("#require_database:checked").val()=='database')?'"require_database":'+1:'"require_database":'+0;
global_opt[h++]=($("#require_captcha:checked").val()=='captcha')?'"require_captcha":'+1:'"require_captcha":'+0;
global_options='{'+global_opt.join(",")+'}';
//console.log(global_options);




var i=0,kkk=0;
var json_blockdiv=new Array();
var json_blockelements='';

$(".blockdiv").each(function(index,element)	{
json_div=new Array();

var j=0;
var k=0;
//Options
var newoptions=new Array();
//End Options
$(".common_element",this).each(function(index,element)	{


//if($("fldname",this).val()!='')

//console.log($(":input[name='fldname']",this).val());
if($(":input[name='fldname']",this).val()!='' && $(":input[name='label']",this).val()!='' )
$("input,select",this).each(function(index,element)	{

if(this.name=='elem_typen' || this.name=='label' || this.name=='fldname'  || this.name=='mysql_default' || this.name=='mysql_length' || this.name=='mysql_date_format' )
	json_div[j++]=(this.value!='')?('"'+this.name+'":"'+this.value+'"'):('"'+this.name+'":""');
else if(this.name=='db_need')
	json_div[j++]=(this.checked==true)?('"'+this.name+'":1'):('"'+this.name+'":0');
else if(this.name=='mysql_type' || this.name=='mysql_isnull')
	json_div[j++]=(this.value!='')?('"'+this.name+'":'+this.value):('"'+this.name+'":""');
	
})

})


op=0;

if(json_div.length>0)	
$(".block_element .block_options .listoptions",this).each(function(index,element)	{
option_checked='';
option_text='';

$("input",this).each(function()	{

if(this.type=='radio' || this.type=='checkbox')
	option_checked=(this.checked==true)?1:0;
else if(this.type=="text")
	option_text=(this.value!='')?this.value:"";
})

if(option_text!='')	{
	newoptions[op++]='{"def":'+option_checked+',"opt_name":"'+option_text+'"}';
}

	//console.log($(this));
	//console.log($("[subopt=1]",element).type);
	//console.log($("input [type=radio]",this));
})
//console.log(json_div);
//console.log();

if(newoptions.length>0)	{
	json_div[j++]='"options":['+newoptions.join(',')+']';
}

if(json_div.length>0)	
json_blockdiv[kkk++]='{'+json_div.join(',')+'}';


//console.log('{'+json_div.join(',')+'}');
//console.log(newoptions.join(','));
i++;

})

if(json_blockdiv.length>0)	{
	json_blockelements='['+json_blockdiv.join(',')+']';
	//console.log(json_blockelements);
}

lightBoxHeight=$(document).height();
lightBoxWidth=$(document).width();
leftMargin=Math.round(lightBoxWidth/2);
//show the light box and preloader
$('#lightbox_wp').css({height:0,display:'block',width:0,left:leftMargin}).animate({left:0,width:'100%',height:lightBoxHeight,opacity:.6},700,function(){preloader()});	
//var form_block_elements='{"global_options":{'+global_options+'},"blockelements":{'+json_blockelements+'}}';
//$("#lightbox_wp").center();
//$("#lightbox_wp").height($(document).height());
//$("#lightbox_wp").fadeIn(300);
//$("#lightbox_wp").fadeIn(300);	

})

})

</script>


<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Dynamic Form</h3>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<section class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
  <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">


<h4 class="details-title text-center"> Create Dynamic Form</h4>
<p style="color:green;" class="text-center" ><?php echo ($this->session->flashdata('success'))?$this->session->flashdata('success'):''?></p>
<p style="color:red;" class="text-center" ><?php echo ($this->session->flashdata('error'))?$this->session->flashdata('error'):''?></p>


<form id="dynform" action="" method="POST" class="form-horizontal" >

						<input type="hidden" name="count_val" id="count_val"  value=""  />
						<input type="hidden" name="sub_count" id="sub_count"  value=""  />
						<input type="hidden" name="mainsub_count" id="mainsub_count"  value=""  />	
						<div class="col-sm-12 col-xs-12 padding_zero empl_detl">
					
						<!--
						<div class="col-sm-2 padding_t">
						<label class="col-sm-12 padding_zero col-xs-12 bk_label">Company Name </label>	
						</div>					
						<div class="col-sm-3 col-xs-12 padding_mzero padding_t">
						<select name="Company_ID" class="form-control" id="Company_ID">
						<option value="">Select Company</option>
						<?php foreach($companyes as $company){?>
						<option value="<?php echo $company['Company_ID'] ?>"><?php echo $company['Company_Name'] ?></option>
						<?php } ?>
						</select>
						 </div>
					-->
					<div class="form-group">
						<label class="col-sm-3 control-label bk_label">Form Name </label>	
									
						<div class="col-sm-6">
						 <input type="text" class="form-control" name="form_name" id="form_name" value="" required>
						 </div>
						
						<!--<label class="col-sm-2 padding_zero col-xs-12 block_element">Select Form Field </label>-->	
						<div class="col-sm-3">
						<div class="dropdown">
						  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Select Form Field
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
							<li><a href="javascript:create_elements(1)">TEXT</a></li>							
							<li><a href="javascript:create_elements(5)">TEXTAREA</a></li>
							<li><a href="javascript:create_elements(6)">RADIO BUTTON</a></li>
							<li><a href="javascript:create_elements(7)">CHECKBOX</a></li>
							<li><a href="javascript:create_elements(3)">SELECT</a></li>
						  </ul>
						</div>			
					
						</div>							
						
					</div>
										
						<div id="embedelement">
						
							
						</div>
						<div class="col-sm-12 text-center">
						<input type="submit" name="submit_form" class="submit_btn" value="Submit"  />
                        <a href="<?php echo base_url();?>DynamicForm/Reports" class="submit_btn" title="Back">Back</a>
						</div>
					</form>

</div>
</div>
</div>

<style type="text/css">
.dropdown ul{width:100%;}
.dropdown-menu li{
	width:100%;
	text-align:center;
}
.block_label {
	font-weight: bold;
}
.bk_label label{padding-left:12px;}
.blockdiv {
padding:0px;	
margin:5px 0px;	
width:100%;
}

.blockdiv_left{width:80%;}
.blockdiv_right	{
width:20%;
} 
.block_options	{
	background: #FFFFF2;
}
.block_options {
	padding:2px;
}
.block_options input[type=radio],.block_options li input[type=checkbox]	{
	width:40px;
}
.block_options	img	{
 vertical-align:middle;
 margin-left:10px;
}
li	{
list-style-type:none;
}

.block_element input[type=text],.block_element select {
 	
}
.empl_detl label{
	font-weight: bold;
    color: #333;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
	font-size: 13px; }
legend img{padding-left:5px;}
.del-opt {cursor: pointer;padding:9px; padding-left:0px;}
.padding_t{margin-top: 10px;}	
fieldset{width:100%;}
.sub_btn{margin-left:15px;}
</style>
 

</div>

<!-- wrapper -->
 
</div> 
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>
</body>
</html>
