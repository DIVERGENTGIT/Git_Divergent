var str1="",
dropdowncontent={
	disableanchorlink:true,
	hidedivmouseout:[false,2E3],
	ajaxloadingmsg:"Loading content. Please wait...",
	ajaxbustcache:true,
	getposOffset:function(a,b){
	return a.offsetParent?a[b]+this.getposOffset(a.offsetParent,b):a[b]
	},
	isContained:function(a,b){
	b=window.event||b;
	for(b=/AppleWebKit[\/\s](\d+\.\d+)/.test(navigator.userAgent)?event[(event.target==event.fromElement?"to":"from")+"Element"]:b.relatedTarget||(b.type=="mouseover"?b.fromElement:b.toElement);b&&b!=a;)
	try{b=b.parentNode}
	catch(e){b=a}
	return b==a?true:false
	},
	show:function(a,b,e){
		
			a.id=="contentlink_new"&&record_click();
			a.id=="contentlink_virgin"&&record_virgin_click();
			if(!this.isContained(a,e)){e=window.event||e;
			if(e.type=="click"&&b.style.visibility=="visible")
			b.style.visibility="hidden";
			else{
				e=b.dropposition[0]=="left"?-(b.offsetWidth-a.offsetWidth):0;g=b.dropposition[1]=="top"?-b.offsetHeight:a.offsetHeight;
				b.style.left=this.getposOffset(a,"offsetLeft")+e+"px";
				b.style.top=this.getposOffset(a,"offsetTop")+g+"px";
				b.style.zIndex=10;b.style.clip=b.dropposition[1]=="top"?"rect(auto auto auto 0)":"rect(0 auto 0 0)";
				b.style.visibility="visible";
				b.startTime=(new Date).getTime();
				b.contentheight=parseInt(b.offsetHeight);
				typeof window["hidetimer_"+b.id]!="undefined"&&clearTimeout(window["hidetimer_"+b.id]);
				this.slideengine(b,b.dropposition[1]=="top"?"up":"down")
				}
			}
			},
			curveincrement:function(a){return(1-Math.cos(a*Math.PI))/2},
			slideengine:function(a,b){
			var e=(new Date).getTime()-a.startTime;
			if(e<a.glidetime){
				e=(b=="down"?this.curveincrement(e/a.glidetime):1-this.curveincrement(e/a.glidetime))*a.contentheight+"px";
				a.style.clip=b=="down"?"rect(0 auto "+e+" 0)":"rect("+e+" auto auto 0)";
				window["glidetimer_"+a.id]=setTimeout(function()
				{
				dropdowncontent.slideengine(a,b)},10)}
				else a.style.clip="rect(0 auto auto 0)"},
				hide:function(a,b,e){
				dropdowncontent.isContained(a,e)||(window["hidetimer_"+b.id]=setTimeout(function(){
						b.style.visibility="hidden";
						b.style.left=b.style.top=0;
						clearTimeout(window["glidetimer_"+b.id])},dropdowncontent.hidedivmouseout[1]))},
						hidediv:function(a){document.getElementById(a).style.visibility="hidden"},
						ajaxconnect:function(a,b){var e=false,c="";
						if(window.XMLHttpRequest)e=new XMLHttpRequest;
						else if(window.ActiveXObject)
						try{e=new ActiveXObject("Msxml2.XMLHTTP")}
						catch(d){
						try{e=new ActiveXObject("Microsoft.XMLHTTP")}
						catch(g){}
						}
			else return false;
			document.getElementById(b).innerHTML=this.ajaxloadingmsg;
			e.onreadystatechange=function(){dropdowncontent.loadpage(e,b)};
			if(this.ajaxbustcache)c=a.indexOf("?")!=-1?"&"+(new Date).getTime():"?"+(new Date).getTime();
			e.open("GET",a+c,true);e.send(null)},
			loadpage:function(a,b){
			if(a.readyState==4&&(a.status==200||window.location.href.indexOf("http")==-1))document.getElementById(b).innerHTML=a.responseText},
			init:function(a,b,e,c){
			a=document.getElementById(a);
			var d=document.getElementById(a.getAttribute("rel")),g=a.getAttribute("rev");
			g!=null&&g!=""&&this.ajaxconnect(g,a.getAttribute("rel"));
			d.dropposition=b.split("-");
			d.glidetime=e||1E3;
			d.style.left=d.style.top=0;
			if(typeof c=="undefined"||c=="mouseover"){
			a.onmouseover=function(f){
				dropdowncontent.show(this,d,f)};
				a.onmouseout=function(f){
				dropdowncontent.hide(d,d,f)};
				if(this.disableanchorlink)a.onclick=function(){
					return false}
					}
				else a.onclick=function(f){
					dropdowncontent.show(this,d,f);
					return false
					};
				if(this.hidedivmouseout[0]==true)
					d.onmouseout=function(f){
					dropdowncontent.hide(this,d,f)
					}
			}
};

