// JavaScript Document
var sqltype_array={1:"CHAR",2:"VARCHAR",3:"TINYINT",4:"DATE",5:"SMALLINT",6:"MEDIUMINT",7:"INT",8:"BIGINT",9:"FLOAT",10:"DECIMAL",11:"DATETIME",12:"TIME",13:"YEAR",14:"TINYTEXT",15:"MEDIUMTEXT",16:"TEXT",17:"LONGTEXT",18:"ENUM",19:"SET",20:"BOOL",21:"BINARY",22:"VARBINARY"};
var dateformat_array={1:'mm/dd/yyyy',2:'dd/mm/yyyy',3:'yyyy/mm/dd'};
var isnull_array={1:'not null',2:'null'};

function DOCID(id)	{
	if(id==false || id=='' || id==='undefined')
		return false;
	return document.getElementById(id);
}


//Trim Space at ends
trim=function(str){
	return str.replace(/^\s+|\s+$/g,''); 
}
//Function Replace null value other than alpha numeric
ReplaceInput=function(inputobj)	{
var valtyped=inputobj.getAttribute("valtype");

var input=inputobj.value;

if(valtyped=='integers')
	input=input.replace(/[^\d]/g,'');
else
	input=input.replace(/[^\w_ ]/g,'');
	
	input=trim(input);
	input=input.replace(/\s{2,}/g,' ');
inputobj.value=input;
}

ValidateAlphanumeric=function(inputobj)	{
var input=inputobj.value;
var valtyped=inputobj.getAttribute("valtype");
//alert(valtyped);
	if (input.length>0)	{

if(valtyped=='integers')
		var re = /^[0-9]+$/;
else
		var re = /^[a-zA-Z_0-9 ]+$/;
		
		if (input.length>0 && re.test(input)==true)
		{
			ReplaceInput(inputobj);
			//inputobj.value=trim(inputobj.value);
			return true;
		} else {
			ReplaceInput(inputobj);
			return false;
		}
	}
	
}

function removeElement(id) {
	id=parseInt(id);
	if(id>1)
	$('#trnode'+id).remove();
}

function getArray2List(arr,def)	{
var opt='';	
//var def=parseInt($def);
//console.log(arr.size());
//console.log(arr.length);

	if(typeof arr=="object")
	for(key in arr)    {
		
	//console.log(arr[key]);
	$key=(typeof def=='integer' && parseInt(def)>0)?(def++):key;
	
		opt+='<option value="'+key+'"';
		if(def==key)    opt+=' selected="selected"';
		opt+='>'+arr[key]+'</option>';
	}
	return opt;
}

function simplePreload()	{ 

var args = simplePreload.arguments;

document.imageArray = new Array(args.length);

	for(var i=0; i<args.length; i++)	{
	document.imageArray[i] = new Image;
	document.imageArray[i].src = args[i];
	
	}

}

trim=function(str){
	return (str.length>0 && str!='undefined' && str!='')?str.replace(/^\s+|\s+$/g,''):null; 
}

$.fn.CDYN_chkbox_multipleselect=function(type)	{

	if(type==='select')
		return $("select[name="+$(this).attr("name")+"] option:selected").val();
	else if(type==='mulselect')
		return 	$("select[name="+$(this).attr("name")+"] option:selected").map(function() {return $(this).val();}).get().join();
	else if(type==='checkbox')
		return 	$("input[name="+$(this).attr("name")+"]:checked").map(function() {return $(this).val();}).get().join();
	
	return false;
}
function copysnippets_id(id)	{

DOCID(id).focus();
DOCID(id).select();

}