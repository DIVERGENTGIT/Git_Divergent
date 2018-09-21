
<style>




input#remove_duplictes {
    height: 20px !important;
    width: 20px !important;}
 
 input#numbers_count {
	 height: 20px !important;
    width: 20px !important;
	
}
input#schedule{
	 height: 20px !important;
    width: 20px !important; 
	}
	
	.modal {
    top: 10%;

   }

	.modal-header {
    padding: 5px 15px;
    border-bottom: 1px solid #eee;
  
}
.bootstrap-datetimepicker-widget.dropdown-menu {
margin-top: -69px !important;
}

label.col-sm-3 {
    text-align: right;
}
div#sectionC {
    height: 485px !important;
    margin-bottom: 10px;
}
div#sectionA {
		
    height: 485px !important;
	margin-bottom: 10px;
}
div#sectionB {

    height: 480px !important;
	margin-bottom: 10px;
}



/*delet popop padding*/
.popover-content.text-center {
    width: 194px !important;
    height: 45px !important;
    padding: 4px !important;
   
}
.tab-content {
    margin-bottom: 44px;
}


.sender_id01 select, input[type="file"]{height:30px;width:100% !important;}
.sender_id01 select {
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    height: 40px;
	border-radius: 0px;
}

</style>
<style type="text/css">
.blockdiv	{
padding:10px;
width:98%;
border:1px  dotted #F8E2D3;
}
.blockdiv:hover,.blockdiv:focus	{
background-color: #F9F9F9;
}

.block_element	{
margin:2px;
padding-top:5px;
margin-right:10px;
}
.blockdiv_left	{
width:80%;
}
.blockdiv_right	{
width:20%;
}
.block_options	{
	background: #FFFFF2;
}
.block_options li	{
	padding:2px;
}
.block_options li input[type=radio],.block_options li input[type=checkbox]	{
	width:40px;
}
.block_options	img	{
 vertical-align:middle;
 margin-left:10px;
}
.blockdiv input[type="image"]{vertical-align:middle;padding-right:6px;padding-bottom:6px;}

.block_element .block_label{
width:30%;
float:left;
font-size:12px;
font-weight:bold;
}
li	{
list-style-type:none;
}
.block_element input[type=text],.block_element select {
 width:250px;	
}
.block_element img{margin-right:6px;vertical-align:middle;}
#embedelement{ width:96%;max-height:auto;}
.dynform_button{display:block;margin-bottom:5px;float:right;}
</style>
<script type="text/javascript"> 
//console.log(sqltype_array[6]);
var inc='';

function create_elements(element_type)	{

var initial_load_opt_value=3;
//alert(element_type);

	var close_element=function(element_type)	{
	var elem;
		//console.log(element_type);
		elem='<div class="blockdiv">';
		
		elem+= first_element(element_type);
		
		elem+= common_element(inc);
			
		elem+= initial_load_opt(element_type,inc);
		elem+='</div>';
		//alert(elem);
		$('#embedelement').append(elem);
		
		inc++;
	}
	
	var first_element=function(element_type)	{
	
	//alert(initial_load_opt_value);
	
	var type_obj_arr1={1:'TEXT',2:'PASSWORD',3:'SELECT',4:'MULTIPLE SELECT',5:'FILE',6:'RADIO',7:'CHECKBOX',8:'DATE'};
	
	var type_obj_arr2={1:'text',2:'password',3:'select',4:'multiple_select',5:'file',6:'radio',7:'checkbox',8:'date'};
	
	return '<div class="block_element" style="color:#fff;border-radius:5px;background-color: #08c; height:25px;vertical-align:middle;"><span style=" font-size:20px; ">'+''+'</span>&nbsp;<span>'+type_obj_arr1[element_type]+'</span><div style="vertical-align:middle;float:right;"><input type="hidden" name="element_type['+inc+']"  value="'+type_obj_arr2[element_type]+'"  /><input type="hidden" name="element_load_options['+inc+']"  value="'+initial_load_opt_value+'"  /><input type="image" src="<?php echo base_url();?>assets/img/delete2.png" name="delete" onclick="remove_block(this);" /></div></div>';
	
	//<input type="button"  value="X" name="delete" onclick="remove_block(this);" />
		
	}

	var initial_load_opt=function(element_type,blockno)	{
	
	if(element_type==3 || element_type==4 || element_type==6 || element_type==7)	{
		var elem='';
		
		elem='<div class="block_element"><fieldset><legend >Options<img src="<?php echo base_url();?>assets/img/add.jpg"  style="float:none; vertical-align:middle;"  onclick="add_options(this,'+element_type+','+blockno+')"  /></legend><div class="block_options"><li ><b>Default</b></li>';
		
		for(var i=1;i<=initial_load_opt_value;i++)	{
			elem+=element_opt(element_type,blockno,i);
		}
		
		elem+='</div></fieldset></div>';
		return elem;
		}
		return '';
	}
	
	var common_element1=function(inc,element_type)	{
	
	var commonelement='';
	commonelement='<div class="common_element">';
	commonelement+='<div class="block_element"><li class="block_label">Label</li><li><input type="text" name="element_label['+inc+']" value="" /></li></div><div class="block_element"><li class="block_label">Field Name</li><li><input type="text" name="element_fieldname['+inc+']" value="" /></li></div>';
		
	commonelement+='<div class="block_element"><li class="block_label">Is NULL</li><li><select name="element_mysql_isnull['+inc+']" class="u"  valtype="integers" ><option value="1">not null</option><option value="2">null</option></select></li></div>';	
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
		
	commonelement+='<div class="block_element"><li class="block_label">Label</li><li><input name="elem_typen" value="'+element_type+'" type="hidden"><input type="text" name="label" value="" /></li></div><div class="block_element"><li class="block_label">Field Name</li><li><input type="text" name="fldname" value="" onChange="return ValidateAlphanumeric(this);" valtype="varchars"  /></li></div>';
	

	commonelement+=date_format;

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
	
	return '<div class="block_element" style="color:#fff;border-radius:5px;background-color:#08c;height:25px;vertical-align:middle;"><span style=" font-size:20px; ">'+(inc)+'</span> &nbsp; <span style="padding-bottom:8px;">'+type_obj_arr1[element_type]+'</span><div style="vertical-align:middle;float:right;"><input type="hidden" name="element_type['+inc+']"  value="'+type_obj_arr2[element_type]+'"  /><input type="hidden" name="element_load_options['+inc+']"  value="'+initial_load_opt_value+'"  /><input type="image"  src="<?php echo base_url();?>assets/img/delete2.png"   name="delete" onclick="remove_block(this);" /></div></div>';
//<input type="button" value="X" name="delete" onclick="remove_block(this);" />		
	}

	var initial_load_opt=function(element_type,blockno,blockopts)	{
	var def;
	element_type=parseInt(element_type);
	
	if(blockopts!='undefined' && blockopts.length>0 && (element_type==3 || element_type==4 || element_type==6 || element_type==7))	{
	//alert(blockopts.length);
		var elem='';
		
		elem='<div class="block_element"><fieldset><legend >Options<img src="<?php echo base_url();?>assets/img/add.jpg"  style="float:none; vertical-align:middle;"  onclick="add_options(this,'+element_type+','+blockno+')"  /></legend><div class="block_options"><li ><b>Default</b></li>';
		
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
		//alert(elem);
		return elem;
		
		}
		return '';
	}
	
	
	
	var common_element=function(inc)	{
	//alert(blockobj.mysql_isnull);
	
	//var mysql_nulls=parseInt(blockobj.mysql_isnull);
	//var mysql_types=parseInt(blockobj.mysql_type);
	
	//var sqltypes=getArray2List(sqltype_array,blockobj.mysql_type);

	/* var commonelement='';
	commonelement='<div class="common_element">';
		
	var db_need_chk=(blockobj.db_need==1)?'checked="Checked"':'';
	commonelement+='<div class="block_element"><li class="block_label">Label</li><li><input name="elem_typen" value="'+blockobj.elem_typen+'" type="hidden"><input type="text" name="label" value="'+blockobj.label+'" /></li></div><div class="block_element"><li class="block_label">Field Name</li><li><input type="text" name="fldname" value="'+blockobj.fldname+'" onChange="return ValidateAlphanumeric(this);" valtype="varchars"  /></li></div>'; */
	

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
		opt='<li class="listoptions"><input type="radio" name="default_opt['+blockno+'][0]" value="'+option_num+'" /><input type="text" name="option_text['+blockno+']['+option_num+']"  /><img src="<?php echo base_url();?>assets/img/delete.png" onclick="removeoptions(this)"/></li>';
		break;
		case 4:
		case 7:
		opt='<li class="listoptions"><input type="checkbox" name="default_opt['+blockno+']['+option_num+']" value="'+option_num+'" /><input type="text" name="option_text['+blockno+']['+option_num+']"  /><img src="<?php echo base_url();?>assets/img/delete.png" onclick="removeoptions(this)"/></li>';
		
		break;
		}
		
		return opt;
	}
	
	var element_opt=function(element_type,blockno,option_num,option_val,defaultval)	{
	//alert(defaultval);
	var opt='';
	var option_vals=(option_val!='' && option_val!=null && option_val!='undefined')?option_val:"";
	var defaultvals_chk=(defaultval!='' && defaultval==1)?'checked="Checked"':'';
	//console.log("element_type="+element_type+"::option_vals="+option_vals+"::defaultval"+defaultval+"::defaultvals_chk"+defaultvals_chk);
	
	element_type=parseInt(element_type);
	
		switch(element_type)	{
		case 3:
		case 6:
		opt='<li class="listoptions"><input type="radio" name="default_opt['+blockno+'][0]" value="'+option_num+'" '+defaultvals_chk+' /><input type="text" name="opt_text" value="'+option_vals+'"  /><img src="<?php echo base_url();?>assets/img/delete.png" onclick="removeoptions(this)"/></li>';
		break;
		case 4:
		case 7:
		opt='<li class="listoptions"><input type="checkbox" name="default_opt['+blockno+']['+option_num+']" value="'+option_num+'"  '+defaultvals_chk+'  /><input type="text" name="opt_text"  value="'+option_vals+'" /><img src="<?php echo base_url();?>assets/img/delete.png" onclick="removeoptions(this)"/></li>';
		
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
var str= element_opt(element_type,block_no,0);	
//alert($(obj).parent().parent().find(".block_options .listoptions").length);
	if($(obj).parent().parent().find(".block_options .listoptions").length<10)
		$(obj).parent().parent().children('.block_options').append(str);

}


function removeoptions(obj)	{
if($(obj).parent().parent().children(".block_options li").length>2)
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
	
});

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
	
});

});


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
});

if(option_text!='')	{
	newoptions[op++]='{"def":'+option_checked+',"opt_name":"'+option_text+'"}';
}

	//console.log($(this));
	//console.log($("[subopt=1]",element).type);
	//console.log($("input [type=radio]",this));
});
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

});

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


		$.ajax({
	                url: "class_php_db_code_test.php",
	                type: 'POST',
	                data: "blockelements="+encodeURIComponent(json_blockelements)+"&globalelements="+encodeURIComponent(global_options)+"&sid="+Math.random(),
	                success: function(data) {
					
					
					eval("var datas="+data);
					if(datas.result=='pass')	{
					
						$(".blockdiv").hide();
						$("#embedelement").hide();
						$("#formtop_config").hide();
						$("#phpformcode_text").text(decodeURIComponent(datas.form_code).replace(/[+]/g, " "));
						$("#phpservercode_text").text(decodeURIComponent(datas.servercode).replace(/[+]/g, " "));
						$("#phpdbcode_text").text(decodeURIComponent(datas.db_structure).replace(/[+]/g, " "));
						$("#phpservercode_filename").html(decodeURIComponent(datas.server_filename).replace(/[+]/g, " "));
						$("#phpformcode_filename").html(decodeURIComponent(datas.form_filename).replace(/[+]/g, " "));
						$("#phpgeneratedcode").show();
					
					}else {
						
						$("#errorlist").html("Please fill the elements value");
						$("#errorlist").show();
					}
					

					//hide the light box and preloader
					 $('#lightbox_wp').animate({left:leftMargin,width:0,height:0,opacity:0.3},700,function(){preloaderHide()});
					 
					}
		});

});


/*$.fn.center = function () {
    this.css("position","absolute");
    this.css("top", (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + "px");
    this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
    return this;
}

*/



});

</script>
<script type="text/javascript">
$(document).ready(function()	{


var jsoncodes=[{"elem_typen":"1","label":"Label name","fldname":"Field name"},{"elem_typen":"6","label":"","fldname":"","options":[{"def":0,"opt_name":""},{"def":1,"opt_name":""}]},{"elem_typen":"7","label":"","fldname":"", "options":[{"def":1,"opt_name":""},{"def":1,"opt_name":""},{"def":1,"opt_name":""}]}];


//jsoncodes[4].options[0].opt_name
for(ob1 in jsoncodes)    {
  //console.log(jsoncodes[ob1]);
  if( jsoncodes[ob1].elem_typen>0 && jsoncodes[ob1].label!='' && jsoncodes[ob1].fldname!='' )	{
		update_elements(jsoncodes[ob1].elem_typen,jsoncodes[ob1]);
		
		
  }
	
}


});

</script>

  <body class="skin-blue sidebar-mini "  >
<div class="modal fade" id="feedback_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="feedback_model">Custom Feedback Form</h4>
      </div>
      <div class="col-sm-12 modal-body">
       <div class="col-sm-12">  
                              
    <form id="test_audio_msg" method="post" action="">
                <div class="x_content">
            <div class="col-sm-12 padding_zero">
                <div class="col-sm-12 padding_zero empl_detl">
				<ul class="feed_back_url_list">
                <?php foreach($dynamic_result AS $resu) { ?>
				<li>
				<a href="<?php echo base_url();?>dynamicform/<?php echo $resu->form_name;?>" class="custom_url close" data-dismiss="modal" aria-label="Close"><?php echo $resu->form_name;?></a>
				</li>
				<?php }?>
					 </ul>
				</div>
				

			</div>
		</div>
     </form>


</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- view End-->
   <!-- <div class="col-sm-10 col-xs-12 mbl_left padding_zero">

    <div class="col-sm-12 crm_sms_tabs"> 
<ul class="jtab-trigger jtab-ul">
	<li>
        <a href="<?php echo base_url();?>campaign/shorturlSMS" class="jtab-selected">ShortUrl</a>
    </li>
    <li>
        <a href="<?php echo base_url();?>campaign/shorturlfileSMS">File SMS</a>
    </li>
    <li>
        <a href="<?php echo base_url();?>campaign/shorturlunicodeSMS">Unicode SMS</a>
    </li>
   <li>
        <a href="<?php echo base_url();?>campaign/shorturlVariableSMS">New variable SMS</a>
    </li>
</ul>
</div> -->
      
    
      <div class="content-wrapper accordion-1" data-url="@{jqueryui.Accordion-1.region('')}">
      
    

        <!-- Main content -->
        <section class="col-sm-9"  data-wow-duration="2s" data-wow-delay="5s" >

  <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> ShortUrl SMS   <?php    
?></strong>     <span style="float:right; color:#F00;">
<?php 
if(isset($error)){
echo $error;
}

if(isset($total_no_of_sms)){
echo $total_no_of_sms;
}

?>

 </span></div>
<div class="col-sm-12 crm_div_bg">
<div class="col-md-7 ng-scope" data-ng-controller="formConstraintsCtrl" style="padding:0px;">
        <div class="panel panel-default">
    
<?php echo form_open('campaign/shorturlSMS',
array('id' => 'single_sms_form', 'name' => 'single_sms_form', 'method' => 'post', 'style' => 'margin:0px !important')
); ?> 

                <div class="panel-body">
                <div class="col-sm-12 padding_zero">
				<div class="col-sm-4" style="margin-bottom:10px;">
                <label class="ui-radio">
				
				<?php echo form_radio('sms_type','0',TRUE,'class="ui-radio"'); ?> 

				<span>Normal SMS</span></label>
				</div>
			  
			    <div class="col-sm-4" style="margin-bottom:10px;">
                <label class="ui-radio">
				
				<?php echo form_radio('sms_type','1',set_radio('sms_type','class="ui-radio"')); ?>
				<span>Flash SMS</span></label>

				</div>
				<div class="col-sm-4">
				<label class="dynform_button">
				<a href="#feedback_model"  data-toggle="modal" data-target="#feedback_model" class="btn btn-primary padding-zero">Custom Feedback</a> </label>
				<!-- <label class="dynform_button">		   
				<button type="button" class="btn btn-primary padding-zero" data-toggle="modal" data-target="#creatForm">Create Form</button>				
				</label> -->				
				</div>
              </div>
			  
                <form class="form-horizontal ng-pristine ng-valid">
				<div class="col-sm-12 padding_zero form-group shor_url_div">
			    <label for="" class="col-sm-3">Short Url</label>
                
				<div class="col-sm-9">
				
                      <input type="text" name="shorturl_input" value="<?php echo $_REQUEST['shorturl_input'];?>" id="checkit1" placeholder="Short Url" class="short_input form-control" style="margin-bottom:0px !important;"> 
                      
<input type="button" name="" value="Short"  id="checkit2" class="short_url_btn btn btn-default btn-sm">

		
        <div class="short_error"></div>		  
                     </div>
    </div>

	
                <div class="form-group">
				
				
                    <label for="" class="col-sm-3">Campaign Name</label>
                               <div class="col-sm-9">
                               
  <input type="text" name="campaign_name" value="<?php echo $_REQUEST['campaign_name'];?>" id="campaign_name" placeholder="Campaign Name" class="form-control" style="height:30px;">                              
                        
						
						
						
                        	<div class="form_error"></div>
							
							
                    </div>
                </div>
                <div class="form-group">
                    <label for="label-focus" class="col-sm-3">Sender ID </label>
                    <div class="col-sm-9 sender_id01">

	  	<?php echo form_dropdown('sender', $sender_names, set_value('sender'),
		array( 'class'=>'form-control'));?> 
        </span>
<div class="form_error"><?php echo form_error('sender'); ?></div>

                    </div>
                </div>
                
                 <div class="form-group">
    
                    <label for="" class="col-sm-3">Text </label>
					<div class="col-sm-9">
				   
				   	<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'sms_text', 'placeholder' => 'Type here', 'rows' => 4, 'cols' => 30, 'style' => 'margin-bottom:0px !important;padding: 5px !important;', 'class' => 'form-control', 'value' => set_value('sms_text')));?>
						

                        <td> 
                        <h6  class="label label-default" id="count_message">0</h6><small  style="margin-left:10px; color:#016EC7">Number of Characters</small>
						</td>
                        <td><span class="label label-default" id="hwmnysms">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
						<div class="form_error"><?php
						
						
						 echo form_error('sms_text'); ?></div>
                    </div>
                    
		                    
                </div>
                
               
                
                <div class="form-group">
                
                    <label for="" class="col-sm-3">Mobile No </label>
                    <div class="col-sm-9 append_data">
<?php 

echo form_textarea(array('name' => 'to_mobileno', 'id' => 'to_mobileno', 'placeholder' => 'Mobile numbers (one number each line)', 'rows' => 7, 'cols' => 30, 'class' => 'form-control', 'style' => 'padding: 5px !important;', 'value' => set_value('to_mobileno')));?>
	<div class="form_error"><?php echo form_error('to_mobileno'); ?></div>

                    </div>
                    
                </div>
				
		<div class="form-group" style="text-align:left; ">
              
        
        
                    <!--this is new code-->
					 <div class="col-sm-3">
					 </div>
                    <div class="col-sm-9 col-md-9  col-xs-9">
                   <div class="form-group">
				   <ul class="check_sms_03">
				   <li>
				   
                      <span><?php echo form_checkbox(array('name' => 'remove_duplictes', 'class'=>'flat-red', 'id' => 'remove_duplictes', 
                    'value' => 1)); ?></span>
					<span>Remove Duplicate</span>
                   
				   
				   </li>
				    <li>
				  <span> <?php echo form_checkbox(array('name' => 'numbers_count', 'id' => 'numbers_count', 'value' => 1)); ?>
                  </span>
					<span>Show Count</span>
				   
				   </li>
				    <li>
				
                       <span> <?php echo form_checkbox(array('name' => 'schedule', 'id' => 'schedule', 'class' => 'col-md-1', 'value' => 1,'style'=>' ;'))?></span>
                     <span> Schedule SMS</span>
				   </li>
				   </ul>
			
					<div class="additional-info icheckbox_minimal-blue date_hide01 checked padding_ltrt col-sm-12" style="margin-top:25px;">     
                                 <label class=" col-md-4" style="padding:0px;">Date & time :</label>	            
           
         <div>
            
          <div id="datetimepicker1" class="input-append date">
            
            
            <?php echo form_input(array('name' => 'on_date', 'id' => 'on_date', 'placeholder' => 'Schedule Date & Time', 'class' => 'form-control col-md-4', 'value' => set_value('on_date'),'data-format'=>'yyyy-MM-dd hh:mm:ss','style'=>'height:30px; width:200px; padding: 0px 7px !important;margin-bottom: 0px !important;margin-left: 7px;')); ?>
            
            <span class="add-on" style=" height:30px;">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar" >
              </i>
            </span>
          </div>
           
          </div>
                                    <div class="form_error"><?php echo form_error('on_date'); ?></div>
        
        
                        </div>
					</div>
                    
                  
                 
                                </div>
       </div>
             
                     <!--this is new code-->
                    
                
                
          
                
                
                 	                        	

                <br>
     <div class="form-group">
                    
                    <div class="col-sm-9" style="float:right; margin-top: 20px;">
			<!--		
 <input type="button" class="btn warning" value="Send"  data-placement="top" tooltip-trigger="focus" style=" height:30px; width:200px; background-color:#04A8ED; border:none; color:#fff;"> -->
 
<input type="hidden" value="shorturl" name="shorturl" value="<?php echo $_REQUEST['shorturl'];?>"/>
 <input type="hidden" name="shorturl_text" id="shorturltext"  value="<?php echo $_REQUEST['shorturl_text'];?>"/>
 
                    		<?php echo form_submit(array('name' => 'sendsms','value' => 'Send', 
							'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
 	  <?php echo form_reset(array('name' => 'reset','value' => 'Cancel', 'class' => 'btn btn-default btn-sm','data-placement' => 'top','style' => ''));?>
                    </div>
                </div>
                
            </form>
                
                </div>
            </div>
        </div>
        <div class="col-md-5 ng-scope padding_rt" data-ng-controller="formConstraintsCtrl" style="margin-top:0px">
        
        
           <div class="col-md-12 padding_ltrt ng-scope" data-ng-controller="formConstraintsCtrl">
            <div class="panel panel-default" style="height:621px">
              
                 <div class="bs-example">
    <ul class="nav nav-tabs" style="padding:0px !important; text-align:left; margin-bottom: 10px !important;">
        <li class="active"><a data-toggle="tab"  href="#sectionA">Recent Templates</a></li>
	    <li><a data-toggle="tab" href="#sectionC">Groups</a></li>
   		 <li><a data-toggle="tab" href="#sectionB">Templates</a></li>         
  	 </ul>
    
    <div class="tab-content" >
	<!--fghfdghdfghfgh-->

        <div id="sectionA" class="tab-pane fade in active" style="padding:0px 10px; word-break:break-all;">
           
            <div class="box-body col-md-12 col-sm-12 col-xs-12" style=" padding-right:5px;">
			
                 <?php foreach($campaigns as $camp => $cmpval): ?>
			<div class="alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" style="overflow: hidden; "
				 title='<?php echo $cmpval->sms_text;?>' >   
			<li class="fa " style="word-wrap: break-word !important; width: 100% !important;"><!--<input type="button"  class="" style="width:auto !important; word-wrap: break-word; background-color:transparent; border:none;  font-family: 'Play', sans-serif;"  value="<?php echo $cmpval->sms_text;?>" id="checkit" >-->
            
         <p id="checkit" style=" width:auto !important; height:40px; cursor:pointer; " >  <input type="button"   style="font-family: 'Play', sans-serif;     height: 40px !important;width:100% !important; background-color:transparent; border:none; word-wrap:break-word; "  
         value="<?php echo htmlspecialchars($cmpval->sms_text);?>" id="checkit" > </p>
         
			</li>
             
                  </div>
				  <?php endforeach;?>
				  				 
				 
				
				 
                </div>
        </div>
       
<div id="sectionC" class="tab-pane fade" style="padding:0px 10px;">
		
		
            
 
  
  <div class="box-body" style="padding:0px;">
  
  
  <div class="col-md-12 check_box_sh" style= " padding:0px 0px;">
         
		   <!-- group  ================== Start===================== -->
                <div class="col-md-6 well" style= " padding:0px 0px;  ">
                 
                         
                         <div class="col-md-12" style= " padding:0px 0px; height:580px;">
        
           
          
<div style="padding:10px 10px 3px 10px; background-color:#215A94; color:#fff;"><span >
<input type="checkbox" class="group_select" style="float:left; margin-right:10px;"  
 onchange="DoAction(0)" name="group_ids[]" value="0"/></span><p style="margin-left:15px;">Group Name</p></div> 
<div class="grp_check">
<ul class="grp_list">
         <?php 
   $groups_count=0;	

foreach($groups as $group=>$groupname):
	$groups_count++;
	?>
         <li><input type="checkbox" value="<?php echo $groupname->group_id; ?>" name="group_ids[]"  onClick="DoAction(<?php echo $groupname->group_id;?>)">
		 
 <?php echo $groupname->group_name; ?> 
         
         </li>
   
               <?php  endforeach;?>  
</ul>			   
                         </div>
                                
              </div>
                        
                 </div>
          <!-- group  ================== End===================== -->
         
             <!-- contact ================== Start===================== -->
         
                <div class="col-md-6 well" style= " padding:0px 0px;  ">
                
         <div class="col-md-12" style= " padding:0px 0px; height:580px;">
       <div style="padding:10px 10px 3px 10px;  background-color:#215A94; color:#fff;"><span >
<!--    <input type="checkbox" id="checkall" style="float:left; margin-right:10px;" class="checkbox1"/>
-->    <input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"  style="float:left; margin-right:10px;"/>
</span><p style="margin-left:15px;">Check All Contacts </p></div>


<span id="contact_list"> 
</span>

<!--<div class="main select_all2">


</div>-->

</div>




</div>
              <!-- group  ================== End===================== -->
              
              
              
              
              
              <!-- Group Details ================== Start===================== -->
         
                
                 
        
        
       </div>
			
		
			
			</div>
			</div>

        <div id="sectionB" class="tab-pane fade">
		
		<a style="float:right; margin-bottom:10px; margin-right:20px;" href="#modal-add" role="button" class="btn btn-sm btn-default" data-toggle="modal">Add Template</a>
        <div class="clearfix"></div>
           
           
           
           
            <div class="box-body" style="">
		
        

                	  
<?php  foreach($templates as $temp =>$val) :?>
<div class=" col-md-12 well alert alert- alert-dismissable" style="    height: 53px !important; padding-top: 4px !important; " data-toggle="tooltip" data-placement="bottom" title="<?php echo  $val->template;?>" >   
			
               
                   <!--text-->
            
       <div class="col-md-8 well " style="padding:0px !important; background-color: transparent;    border: none; box-shadow: none;    height: 44px;    overflow: hidden;"><!--<input type="button" class=" col-md-4 col-sm-6 col-xs-10"  style="font-family: 'Play', sans-serif; "  value="<?php echo $val->template;?>" id="checkit"  >-->
            
        <p id="checkit" style="height:50px; padding:0px 5px; overflow:hidden;"> <input type="button" class=" "  style="font-family: 'Play', sans-serif; width:100% !important; background-color:transparent; border:none; height:50px; word-wrap:break-word; "  value="<?php echo $val->template;?>" id="checkit" onClick="myFunction()"  > </p>
			</div>
            
            
            
                  <!--  edit-->
            
 <div class="col-md-2 well" style="padding: 10px 0px !important; background-color: transparent; border: none; box-shadow: none;">
      <center> <a href="#<?php echo $val->template_id; ?>"  data-remodal-target="<?php echo $val->template_id; ?>" data-toggle="modal">
					<span class="btn btn-sm btn-default" style=" height: 24px;
    width: 59px;font-size: 13px;
    text-align: center;
    padding-top: 0px;">Edit</span>
                    </a>  </center>
                    </div>
                    
                   <!--delete--> 
                    
                    
 <div class="col-md-2 well" style=" padding: 10px 0px !important; background-color: transparent; border: none; box-shadow: none;">
      <center>
                    <span     
					data-toggle="confirmation" 
					data-btn-ok-label="Yes" 
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" 
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle" 
					data-btn-cancel-class="btn-danger"
					data-original-title="" title="" 
					
					data-href="<?php echo base_url(); ?>campaign/normalSMS/del/<?php echo $val->template_id; ?>";
					
                    class=" btn btn-sm btn-default" style=" height: 24px;
                        width: 65px;
                        text-align: center;font-size: 13px;
                        padding-top: 0px; margin-left:3px ;" > Delete 
                    </span>
                     
                    
                   </center>
      </div>
      
       
             
<div id="<?php echo $val->template_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top:0px !important;">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" style=" color: #FFF !important;  font-size: 17px !important; background-color:transparent !important;"><center>Edit Templates</center></h4>
        </div>
        <div class="modal-body">
 <form class="form-horizontal" name="templateform" method="post" action="normalSMS">
		  
  
    <div class="form-group">
        <label class="control-label col-md-2" for="template">Templates</label>
        <div class="col-md-8">
    <textarea rows="4" class="form-control" id="edittemp" name="edittemp" ><?php echo $val->template; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">

		<input type="hidden" name="template_id" value="<?php echo $val->template_id;?>"/>
        <button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button>
       <button type="submit" value="Submit" name="editsubmit"  class="btn btn-default btn-sm pull-right "  style="margin-right: 20px;">Save</button>
       
        </div>
    </div>
</form>
        </div>
        <!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div><!-- End of Modal -->				
			
					
 	    </div>	
                   	<?php endforeach; ?>
                    
               
				  
            
			
			
        </div>
		
		
    </div>
</div>

      </div>   
					
        </div>
        
         </div>
         </div>
		 </div>
        </section>
   
	   
	<!-- Add template -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 0px !important;">
        <div class="modal-content" style="border:0px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title"><center>Add Templates</center></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" name="templateform" method="post" action="<?php echo base_url(); ?>campaign/normalSMS">
		  
  
    <div class="form-group">
        <label class="control-label col-md-2" for="template">Templates</label>
        <div class="col-md-8">
    <textarea rows="4" class="form-control" id="addtemp" name="addtemp" ></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
<button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button>
       <button type="submit" value="Submit" name="addsubmit"  class="btn btn-default btn-sm pull-right" style="margin-right:20px;">Submit</button>
        
        </div>
    </div>
</form>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div><!-- End of Modal -->		

	   
<div class="clearfix"></div>
           <!--footer starts-->     
      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->
	</div>
</div>
  <!-- Modal -->
<div class="modal fade" id="creatForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Form</h4>
      </div>
      <div class="modal-body">
	   <div style="margin-left:10px;margin-bottom:10px;">
	    <!--
		<select name="field_names" onchange="location = this.value;">
			<option value="">Select Form Field</option>
			<option value="javascript:create_elements(1);">TEXT</option>
			<option value="javascript:create_elements(2);">PASSWORD</a></option>
			<option value="javascript:create_elements(6);">RADIO</a></option>
			<option value="javascript:create_elements(7);">CHECKBOX</option>
			<option value="javascript:create_elements(3);">SELECT</option>
			<option value="javascript:create_elements(4);">MULTIPLE SELECT</option>
			<option value="javascript:create_elements(8);">DATE</option>
		</select>		
		-->
		<center>
		<a href="javascript:create_elements(1);">TEXT</a> | <a href="javascript:create_elements(2);">PASSWORD</a> | <a href="javascript:create_elements(6);">RADIO</a> | <a href="javascript:create_elements(7);">CHECKBOX</a> | <a href="javascript:create_elements(3);">SELECT</a> | <a href="javascript:create_elements(4);">MULTIPLE SELECT</a> | <a href="javascript:create_elements(8);">DATE</a> </center>
		</div>
				
	   <div id="embedelement"></div>
	   

     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>  
   <!-- jQuery 2.1.4 -->
    
    <!-- Bootstrap 3.3.2 JS -->
    
  
    <!-- Bootstrap 3.3.2 JS -->
    
	 <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.checkAll.js"></script>
	

	<script src="<?php echo base_url();?>js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
   <!-- <script src='<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>-->
    <!-- AdminLTE App -->
 
 <!--<script src="<?php echo base_url();?>assets/js/remodal.min.js" type="text/javascript"></script>-->
<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
    <script type="text/javascript"src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>
   <!-- ChartJS 1.0.1 -->
      <!--<script src="http://www.kptemplates.com/preview/unicorn/js/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>-->

    
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.checkAll.js"></script>

<script type="text/javascript">
$(document).ready(function () {
 $("#to_mobileno").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 17, 86, 67, 27, 13, 110, 190]) !== -1 ||
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
</script>
<script type='text/javascript'>
     $(document).ready(function() {
 $('.additional-info-wrap input[type=checkbox]').click(function() {         if($(this).is(':checked')) {             $(this).closest('.additional-info-wrap').find('.additional-info').removeClass('hide').find('input,select').removeAttr('disabled');         }         else {             $(this).closest('.additional-info-wrap').find('.additional-info').addClass('hide').find('input,select').val('').attr('disabled','disabled');         }     }); 
     });
  </script>      

    <!-- text box text count code-->
		<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'en'
    });
  });
</script>

    <!-- contacts only javascript-->
    <script type="text/javascript">
	
			$(document).ready(function(){
			


			$('.menu a').click(function(e)
			{
				console.log(e);
			 hideContentDivs();
			 var tmp_div = $(this).parent().index();
			
			 $('.main div').eq(tmp_div).show();
			 
			 
		
			 
			 
		  });
			
		function hideContentDivs(){
			$('.main div').each(function(){
			$(this).hide();});
		}
		hideContentDivs();
		  });

    

		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})

	
   </script> 
   


 
   <script type='text/javascript'>
        
 $(document).ready(function() {
var text_max = 0;
$('#count_message').html(text_max + '');
$('#sms_text').keyup(function() {
  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
});
 
 
	$('#remove_duplictes').click(function() {
		
		if ($('#remove_duplictes').is(':checked') == true) {
			var to_mobileno = $("textarea#to_mobileno").val();
			var data ={to_mobileno:to_mobileno};
			$.ajax({
		        url: "<?php echo site_url('/campaign/normalSmsRemoveDublicates'); ?>", 
		        type: "POST",       
		        data: data,    
		        cache: false,
		        success: function (callback_data) {		        	
		        	var substr = callback_data.split('\n');
		        	var to_mobileno_count = to_mobileno.split('\n');
		        	alert(substr.length + " Unique Numbers out of " + to_mobileno_count.length);
		        	$('textarea#to_mobileno').val(callback_data);				    
		    	}
			});
		}
		 
	});
	
$('#recenttemp').click(function() {

if($('#recenttemp').val()!= "") {
var colum = $('#recenttemp').val();

var text = $('textarea#sms_text').val();
var s =	$('#sms_text').val(text+colum);



}
});
					 
	
	$('#numbers_count').click(function() {
		
		if ($('#numbers_count').is(':checked') == true) {
			var to_mobileno = $("textarea#to_mobileno").val();
			var data ={to_mobileno:to_mobileno};
			$.ajax({
		        url: "<?php echo site_url('/campaign/numbersCount'); ?>", 
		        type: "POST",       
		        data: data,    
		        cache: false,
		        success: function (callback_data) {		        	
		        	var substr = callback_data.split('\n');
		        	var to_mobileno_count = to_mobileno.split('\n');
		        	alert(substr);
		        	
		    	}
			});
		}
		 
	});
	

        });
        
        </script>
		

<script type='text/javascript'>	

 $(document).ready(function() {			
		$('#myDelet').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myDelet').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myDelet').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myDelet').modal('hide');
});
  }); 	

</script>


<!-- conformation-->

    <script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>
<!--<script>
 $(document).ready(function(){
 $('#on_date').datetimepicker({	
		dateFormat: 'yyyy-mm-dd HH:MM'
	});
});
 </script>-->
<?php


$api_url= 'http://'.$_SERVER['SERVER_NAME'].'/shorturl/';
//$api_url= 'http://ion.bz';

?>


 <script>
$(document).click("click", function(e) {
	if ((e.target.id == "checkit2")) 
		{ 
 
 		if((e.target.id != "if") && (e.target.id != "while")) {

				if ($(".short_input").val().match(/http:\/\//) || $(".short_input").val().match(/https?:\/\//) || $(".short_input").val().match(/www./)) {

  var txt = $.trim($(".short_input").val());
   var box = $("#sms_text");



   $.ajax({
	url: '<?php echo $api_url?>/api.php',
	type: 'POST',
      	data: {
         	get_shorturl: 'success',user_url: txt,user_id:'<?php echo $user_id ?>'
      	},
	dataType: "JSON",
	success: function(data) {
									

//box.val(box.val() + "http://ion.bz/"+data+'\n');
box.val(box.val() + '<?php echo $api_url?>'+data+'\n');


$("#shorturltext").val('<?php echo $api_url?>'+data+'\n');

var text_max = 0;
$('#count_message').html(text_max + '');  

  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
	},
	error: function(){

	//console.log('i am here');
               alert("error");
        }
   });
		}
		else
		{
			
	 alert("Invalid URL");
		}		

	
	
		}	
		
	}
});


</script>

<script>
$(document).ready(function(){
$(".short_url_btn").click(function(){
var searchInput = $('#sms_text');

var strLength = searchInput.val().length * 2;

searchInput.focus();
searchInput[0].setSelectionRange(strLength, strLength);
});
});
</script>
<script>
$(document).click("click", function(e) {
	
	if ((e.target.value != undefined) && (e.target.id == "checkit")) 
		{ 
	
			if((e.target.id != "if") && (e.target.id != "while")) {
				console.log('krishna');
				$('#sms_text').val($('#sms_text').val()+' '+ e.target.value); 
				

var text_max = 0;
$('#count_message').html(text_max + '');

  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
	
	
		}	
}
});


</script>
	 <script type="text/javascript">
	$(document).ready(function(){
	var checkboxes = $(".lc_nos01");

checkboxes.on('change', function() {
    $('#sms_text').val(
        checkboxes.find(':selected').map(function(item) {
            return this.value;
        }).get().join('\n')+'\n'
     );
}); 
	
	});
	
    </script>

	
 <script>
var maxLength = 10;
$('#to_mobileno').on('input focus keydown keyup', function() {
    var text = $(this).val();
    var lines = text.split(/(\r\n|\n|\r)/gm); 
    for (var i = 0; i < lines.length; i++) {
        if (lines[i].length > maxLength) {
            lines[i] = lines[i].substring(0, maxLength);
        }
    }
    $(this).val(lines.join(''));
});

/*
	$(document).ready(function(){
      $('#sms_text').bind("cut copy paste",function(e) {
		  alert('Dont cut copy paste');
          e.preventDefault();
      });
    });*/
</script>
<SCRIPT LANGUAGE="JavaScript">

function CheckAll(chk)
{
for (i = 0; i < chk.length; i++)
	chk[i].checked = true ;
}

function UnCheckAll(chk)
{

for (i = 0; i < chk.length; i++)
	chk[i].checked = false ;
}

</script>

<script type="text/javascript">
        function isInteger(s)
        {
        var i;s = s.toString();
        for (i = 0; i < s.length; i++)
        {
        var c = s.charAt(i);
        if (isNaN(c))
        {
        alert("Given value is not a number");return false;
        }
        }return true;
        }
        </script>

         <!--  ===============================group details javascript===================================================== -->

     <!-- group details javascript-->
   
  <!-- contacts only javascript-->
    <script type="text/javascript">
	
			$(document).ready(function(){
			


			$('.menu a').click(function(e)
			{
				console.log(e);
			 hideContentDivs();
			 var tmp_div = $(this).parent().index();
			
			 $('.main div').eq(tmp_div).show();
			 
			 
		
			 
			 
		  });
			
		function hideContentDivs(){
			$('.main div').each(function(){
			$(this).hide();});
		}
		hideContentDivs();
		  });

    

		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})

	
function DoAction(id,uid)
{
	
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>campaign/contact_list_ajax2",
		  dataType: "html",
         data: {id:id,uid:uid},
		 
		         success: function(data){
                  //   alert( "Data Saved: " + msg );
				      $('#ajax-content-container').html(data);

                  }
				  
    });
}


function DoActionGroup(id,uid)
{
	
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>contacts/group_view_details",
		  dataType: "html",
         data: {id:id,uid:uid},
		 
		         success: function(data){
                  //   alert( "Data Saved: " + msg );
				      $('#ajaxgroup-content-container').html(data);

                  }
				  
    });
}


function DoActionContact(id,cid)
{
	
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>contact_view.php",
		  dataType: "html",
         data: {id:id,cid:cid},
		 
		         success: function(data){
                  
				      $('#ajaxcontact-content-container').html(data);

                  }
				  
    });
}


   </script> 
   
   
   
   <!-- test group details javascript-->
   
    <script type="text/javascript">
	$('#menu-2 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.main-2 div').eq(tmp_div).show();
  });

function hideContentDivs(){
    $('.main-2 div').each(function(){
    $(this).hide();});
}
hideContentDivs();
   </script>  
   
   
  <!-- contact details javascript-->
   
   
  <script type="text/javascript">
   $(document).ready(function(){
$('#kk-1 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.mm-1 div').eq(tmp_div).show();
  });

function hideContentDivs(){
    $('.mm-1 div').each(function(){
    $(this).hide();});
}
hideContentDivs();
});
   </script> 

  <script type="text/javascript">
function DoAction(id)
{
	var group_ids=document.getElementsByName('group_ids[]');
	
	var group_ids_array=new Array();
	for(i=0,j=0; i<group_ids.length; i++)
	{
		if(group_ids[i].checked)
		{
			group_ids_array[j]=group_ids[i].value;
			j++;
	   }
    }
    group_ids=group_ids_array.join();
	//alert(group_ids);
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{ //alert(xmlhttp.readyState);
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		//alert('hi')
		
		document.getElementById("contact_list").innerHTML=xmlhttp.responseText;
		}
				document.getElementById("contact_list").innerHTML=xmlhttp.responseText;

		}
		

		xmlhttp.open("POST","<?php echo base_url(); ?>campaign/contact_list_ajax2?group_ids="+group_ids,true);
		xmlhttp.send();
}
</script>
<script src="<?php echo base_url();?>assets/js/wow.min.js" type="text/javascript"></script>      
      
 <script type="text/javascript">

    $(document).click(function(e){
		$('#checkall').on('click',function(){
        if(this.checked){
            $('.check_all input').each(function(){
                this.checked = true;
            });
        }else{
             $('.check_all input').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.check_all input').on('click',function(){
        if($('.check_all input:checked').length == $('.check_all input').length){
            $('#checkall').prop('checked',true);
        }else{
            $('#checkall').prop('checked',false);
        }
    });
	
	
	// 3
	$('.group_select').on('click',function(){
        if(this.checked){
            $('.grp_check input').each(function(){
                this.checked = true;
            });
        }else{
             $('.grp_check input').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.grp_check input').on('click',function(){
        if($('.grp_check input:checked').length == $('.grp_check input').length){
            $('.group_select').prop('checked',true);
        }else{
            $('.group_select').prop('checked',false);
        }
    });
	
	// data insert
	  
	var checkboxes = $("#sectionC input[type='checkbox']");

checkboxes.on('change', function() {
    $('.append_data .form-control').val(
        checkboxes.filter('.checkboxstyle:checked').map(function(item) {
            return this.value;
        }).get().join('\n')
     );
}); 
  
    
});
   </script>  
  
  
<script>
$(document).ready(function () {
	$('.date_hide01').hide();
    $('#schedule').change(function () {
		
        if (!this.checked) 
        //  ^
            $('.date_hide01').fadeOut('slow');
        else   
		$('.date_hide01').fadeIn('slow');
    });
});
 </script>
<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name=""/><select class="select_show_option"><option>text box</option><option value="txt">text area</option></select><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>

<script type="text/javascript">
$(document).ready(function(){
    $(".select_show_option").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")=="txt"){
                $(".select_show_div").show();
                
            }
			else{
                $(".select_show_div").hide();
            }
           
        });
    }).change();
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".custom_url").click(function(){
     $(".short_input").val('http://www.smsstriker.com/college_enquiryform');
    })
});
</script>
  <script type="text/javascript">
$(document).ready(function(){
    $(".custom_url").click(function(){
		var linkurl = $(this).attr("href");
     $(".short_input").val(linkurl);
    })
});
</script>   

</body>
