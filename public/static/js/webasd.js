function killErrors(){return true;}window.onerror=killErrors;
function mobileMode(){
	var mode=false;
	if(window.location.toString().indexOf('pref=padindex') != -1){}
	else {
		if(/AppleWebKit.*Mobile/i.test(navigator.userAgent)||(/Android|Windows Phone|webOS|iPhone|iPod|BlackBerry|MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))){
			try {
				if(!(/iPad/i.test(navigator.userAgent))){ mode=true;}
			}
			catch(e){}
		}
	} 
	return mode;
}	
var asd_top="";
var asd_recommend="";
var asdfoot="";
var adLeftCouple="";
var adRightCouple="";
var adLeftFloat="";
var adRightFloat="";
var adLeftCoupleTop=0;
var adLeftCoupleLeft=0;
var adLeftCoupleTxt="";
var adRightCoupleTop=0;
var adRightCoupleRight=0;
var adRightCoupleTxt="";
var adLeftFloatLeft=0;
var adLeftFloatBottom=0;
var adLeftFloatTxt="";
var adRightFloatRight=0;
var adRightFloatBottom=0;
var adRightFloatTxt="";
var tongji="";
var cssurl="";
var adhost=window.location.host.toLowerCase();
var btnClose = "";
var dyplayTxt = "";
var myDate = new Date();
var date1 = (myDate.getMonth()+1);
date1="0"+date1;
var day1 = myDate.getDate();
day1="0"+day1;
//取后2位
date1=date1.substring(date1.length-2,date1.length);
day1=day1.substring(day1.length-2,day1.length);

//关闭按钮，暂时未用
btnClose = '<div style="position:absolute;top:0px;right:0px;margin:1px;width:15px;height:15px;line-height:16px;background:#000;font-size:11px;text-align:center;"><a href="javascript:closeFloat();" style="color:white;text-decoration:none;">×</a></div>';

function scrollx(p){
	var d = document,dd = d.documentElement,db = d.body,w = window,o = d.getElementById(p.id),ie6 = /msie 6/i.test(navigator.userAgent),style,timer;
	if(o){
		o.style.cssText +=";z-index:999;position:"+(p.ofloat&&!ie6?'fixed':'absolute')+";"+(p.oleft==undefined?'':'left:'+p.oleft+'px;')+(p.otop==undefined?'':'top:'+p.otop+'px')+(p.oright==undefined?'':'right:'+p.oright+'px;')+(p.obottom==undefined?'':'bottom:'+p.obottom+'px');
		if(p.ofloat&&ie6){
			if (p.otop!=undefined){
				o.style.cssText += ';top:expression(documentElement.scrollTop + '+p.otop+' + "px" );';
			}
			if(p.oleft!=undefined){
				o.style.cssText += ';left:expression(documentElement.scrollLeft + '+p.oleft+' + "px");';
			}
			if (p.obottom!=undefined){
				o.style.cssText += ';top:expression(documentElement.clientHeight - '+o.offsetHeight+' + documentElement.scrollTop - ' +p.obottom+' + "px" );';
			}
			if (p.oright!=undefined){
				o.style.cssText += ';left:expression(documentElement.clientWidth - '+o.offsetWidth+' + documentElement.scrollLeft - ' +p.oright+' + "px" );';
			}
			dd.style.cssText +=';background-image: url(about:blank);background-attachment:fixed;';
		}else{
			if(!p.ofloat){
				w.onresize = w.onscroll = function(){
					clearInterval(timer);
					timer = setInterval(function(){
						//双选择为了修复chrome 下xhtml解析时dd.scrollTop为 0
						var st = (dd.scrollTop||db.scrollTop),c;
						c = st - o.offsetTop + (p.otop!=undefined?p.otop:(w.innerHeight||dd.clientHeight)-o.offsetHeight);
						if(c!=0){
							o.style.top = o.offsetTop + Math.ceil(Math.abs(c)/10)*(c<0?-1:1) + 'px';
						}else{
							clearInterval(timer);
						}
					},10)
				}
			}
		}
	}
}

//广告顶部通栏  
asd_top=asd_top+"<a href=\"http://www.huojidh.com/\" target=\"_blank\"><img src=\"/template/HuoJi/asset/img/asd1.jpg\" style=\"width:100%;height:80px;\"></a>";//20181201
//asd_top=asd_top+"<a href=\"http://www.huojidh.com/\" target=\"_blank\"><img src=\"https://i.imgur.com/OYn6gJa.jpg\" style=\"width:100%;height:80px;margin-bottom: 2.5px;\"></a>";//20181201

if(mobileMode()){
    asd_top="<a href=\"/\" target=\"_blank\"><img src=\"/template/HuoJi/asset/img/asd1.jpg\" style=\"width:100%;height:60px;\"></a>";
}
//广告中间通栏
asd_recommend=asd_recommend+"<a href=\"http://www.huojidh.com/\" target=\"_blank\"><img src=\"/template/HuoJi/asset/img/asd2.jpg\" style=\"width:100%;height:80px;\"></a>";
if(mobileMode()){
asd_recommend="<a href=\"http://www.huojidh.com/\" target=\"_blank\"><img src=\"/template/HuoJi/asset/img/asd2.jpg\" style=\"width:100%;height:60px;\"></a>";
}



//对联和漂浮
	adLeftFloatLeft=0;
	adLeftFloatBottom=0;
	//adLeftFloatTxt='<a href="http://www.253014.cc/yl8860/avfldh.html" target="_blank"><img src="http://wx2.sinaimg.cn/large/006y0kNhly1fcj10t0xuog305k05kjwv.gif" border="0" width="200" height="200"></a>';

	adRightFloatRight=0;
	adRightFloatBottom=0;
	//adRightFloatTxt='<a href="http://www.253014.cc/yl8860/avfldh.html" target="_blank"><img src="http://wx2.sinaimg.cn/large/006y0kNhly1fcj10t0xuog305k05kjwv.gif" border="0" width="200" height="200"></a>';

//以下代码请勿修改
//ipad|
/*
if(!navigator.userAgent.match(/Android/i) &&!navigator.userAgent.match(/iphone|mac/i)){
		if (adLeftCoupleTxt!="" && !mobileMode()){
			adLeftCouple+='<div id="leftCouple" style="position:absolute;top:'+adLeftCoupleTop+'px;left:'+adLeftCoupleLeft+'px;">'+adLeftCoupleTxt+'<div style="position:absolute;top:0px;right:0px;margin:1px;width:15px;height:15px;line-height:16px;background:#000;font-size:11px;text-align:center;"><a href="#" onclick="leftCouple.style.visibility=\'hidden\';" style="color:white;text-decoration:none;">×</a></div></div>';
			document.writeln(adLeftCouple);
			scrollx({id:'leftCouple',otop:adLeftCoupleTop,oleft:adLeftCoupleLeft,ofloat:1})
		}
  		if (adRightCoupleTxt!="" && !mobileMode()){
			adRightCouple+='<div id="rightCouple" style="position:absolute;top:'+adRightCoupleTop+'px;right:'+adRightCoupleRight+'px;">'+adRightCoupleTxt+'<div style="position:absolute;top:0px;right:0px;margin:1px;width:15px;height:15px;line-height:16px;background:#000;font-size:11px;text-align:center;"><a href="#" onclick="rightCouple.style.visibility=\'hidden\';" style="color:white;text-decoration:none;">×</a></div></div>';
			document.writeln(adRightCouple);
				scrollx({id:'rightCouple',otop:adRightCoupleTop,oright:adRightCoupleRight,ofloat:1})
		}
		if (adLeftFloatTxt!="" && !mobileMode()){
			adLeftFloat+='<div id="leftFloat" style="position:absolute;bottom:'+adLeftFloatBottom+'px;left:'+adLeftFloatLeft+'px;">'+adLeftFloatTxt+'<div style="position:absolute;top:0px;right:0px;margin:1px;width:15px;height:15px;line-height:16px;background:#000;font-size:11px;text-align:center;"><a href="#" onclick="leftFloat.style.visibility=\'hidden\';" style="color:white;text-decoration:none;">×</a></div></div>';
			document.writeln(adLeftFloat);
			scrollx({id:'leftFloat',oleft:adLeftFloatLeft,obottom:adLeftFloatBottom,ofloat:1})
		}
		if (adRightFloatTxt!="" && !mobileMode()){
			adRightFloat+='<div id="rightFloat" style="position:absolute;bottom:'+adRightFloatBottom+'px;right:'+adRightFloatRight+'px;">'+adRightFloatTxt+'<div style="position:absolute;top:0px;right:0px;margin:1px;width:15px;height:15px;line-height:16px;background:#000;font-size:11px;text-align:center;"><a href="#" onclick="rightFloat.style.visibility=\'hidden\';" style="color:white;text-decoration:none;">×</a></div></div>';
			document.writeln(adRightFloat);
			scrollx({id:'rightFloat',oright:adRightFloatRight,obottom:adRightFloatBottom,ofloat:1})
		}
	}*/

//新添加中部广告
   //var adCenterLeft='<div id="centerLeft" style="position:absolute;bottom:240px;left:0;">';
        //adCenterLeft+='<a href="http://zoro33.com" target="_blank"><img src="http://wx2.sinaimg.cn/large/006y0kNhly1ff0cw2eizyj305k05kgmu.jpg" border="0" width="200" height="200"></a>';//04-18
        //上面这行是左侧广告代码，换成你自己想要的
        //adCenterLeft+='<div style="position:absolute;top:0px;right:0px;margin:1px;width:15px;height:15px;line-height:16px;background:#000;font-size:11px;text-align:center;"><a href="#" onclick="centerLeft.style.visibility=\'hidden\';" style="color:white;text-decoration:none;">×</a></div></div>';
        
   //var adCenterRight='<div id="centerRight" style="position:absolute;bottom:240px;Right:0;">';
       //adCenterRight+='<a href="http://zoro33.com" target="_blank"><img src="http://wx2.sinaimg.cn/large/006y0kNhly1ff0cw2eizyj305k05kgmu.jpg" border="0" width="200" height="200"></a>';//04-18
        //上面这行是右侧广告代码，换成你自己想要的
      //adCenterRight+='<div style="position:absolute;top:0px;right:0px;margin:1px;width:15px;height:15px;line-height:16px;background:#000;font-size:11px;text-align:center;"><a href="#" onclick="centerRight.style.visibility=\'hidden\';" style="color:white;text-decoration:none;">×</a></div></div>';
    if (adCenterLeft!="" && !mobileMode()){
        document.writeln(adCenterLeft);
		scrollx({id:'centerLeft',otop:'50%',oleft:0,ofloat:1})
    }
    if (adCenterRight!="" && !mobileMode()){
        document.writeln(adCenterRight);
		scrollx({id:'centerRight',otop:'50%',oright:0,ofloat:1})
    }