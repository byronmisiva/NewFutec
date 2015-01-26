//v1.7
// Flash Player Version Detection
// Detect Client Browser type
// Copyright 2005-2007 Adobe Systems Incorporated.  All rights reserved.
var isIE  = (navigator.appVersion.indexOf("MSIE") != -1) ? true : false;
var isWin = (navigator.appVersion.toLowerCase().indexOf("win") != -1) ? true : false;
var isOpera = (navigator.userAgent.indexOf("Opera") != -1) ? true : false;
var popup=0;


function abrir_popup(direccion, pantallacompleta, herramientas, direcciones, estado, barramenu, barrascroll, cambiatamano, ancho, alto, izquierda, arriba, sustituir){
    var opciones = "fullscreen=" + pantallacompleta +
                ",toolbar=" + herramientas +
                ",location=" + direcciones +
                ",status=" + estado +
                ",menubar=" + barramenu +
                ",scrollbars=" + barrascroll +
                ",resizable=" + cambiatamano +
                ",width=" + ancho +
                ",height=" + alto +
                ",left=" + izquierda +
                ",top=" + arriba;
    var ventana = window.open(direccion,'popup'+popup,opciones,sustituir);
    popup=popup+1;
};

function ControlVersion()
{
	var version;
	var axo;
	var e;

	// NOTE : new ActiveXObject(strFoo) throws an exception if strFoo isn't in the registry

	try {
		// version will be set for 7.X or greater players
		axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
		version = axo.GetVariable("$version");
	} catch (e) {
	}

	if (!version)
	{
		try {
			// version will be set for 6.X players only
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");
			
			// installed player is some revision of 6.0
			// GetVariable("$version") crashes for versions 6.0.22 through 6.0.29,
			// so we have to be careful. 
			
			// default to the first public version
			version = "WIN 6,0,21,0";

			// throws if AllowScripAccess does not exist (introduced in 6.0r47)		
			axo.AllowScriptAccess = "always";

			// safe to call for 6.0r47 or greater
			version = axo.GetVariable("$version");

		} catch (e) {
		}
	}

	if (!version)
	{
		try {
			// version will be set for 4.X or 5.X player
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
			version = axo.GetVariable("$version");
		} catch (e) {
		}
	}

	if (!version)
	{
		try {
			// version will be set for 3.X player
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
			version = "WIN 3,0,18,0";
		} catch (e) {
		}
	}

	if (!version)
	{
		try {
			// version will be set for 2.X player
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
			version = "WIN 2,0,0,11";
		} catch (e) {
			version = -1;
		}
	}
	
	return version;
}

// JavaScript helper required to detect Flash Player PlugIn version information
function GetSwfVer(){
	// NS/Opera version >= 3 check for Flash plugin in plugin array
	var flashVer = -1;
	
	if (navigator.plugins != null && navigator.plugins.length > 0) {
		if (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]) {
			var swVer2 = navigator.plugins["Shockwave Flash 2.0"] ? " 2.0" : "";
			var flashDescription = navigator.plugins["Shockwave Flash" + swVer2].description;
			var descArray = flashDescription.split(" ");
			var tempArrayMajor = descArray[2].split(".");			
			var versionMajor = tempArrayMajor[0];
			var versionMinor = tempArrayMajor[1];
			var versionRevision = descArray[3];
			if (versionRevision == "") {
				versionRevision = descArray[4];
			}
			if (versionRevision[0] == "d") {
				versionRevision = versionRevision.substring(1);
			} else if (versionRevision[0] == "r") {
				versionRevision = versionRevision.substring(1);
				if (versionRevision.indexOf("d") > 0) {
					versionRevision = versionRevision.substring(0, versionRevision.indexOf("d"));
				}
			}
			var flashVer = versionMajor + "." + versionMinor + "." + versionRevision;
		}
	}
	// MSN/WebTV 2.6 supports Flash 4
	else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.6") != -1) flashVer = 4;
	// WebTV 2.5 supports Flash 3
	else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.5") != -1) flashVer = 3;
	// older WebTV supports Flash 2
	else if (navigator.userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 2;
	else if ( isIE && isWin && !isOpera ) {
		flashVer = ControlVersion();
	}	
	return flashVer;
}

// When called with reqMajorVer, reqMinorVer, reqRevision returns true if that version or greater is available
function DetectFlashVer(reqMajorVer, reqMinorVer, reqRevision)
{
	versionStr = GetSwfVer();
	if (versionStr == -1 ) {
		return false;
	} else if (versionStr != 0) {
		if(isIE && isWin && !isOpera) {
			// Given "WIN 2,0,0,11"
			tempArray         = versionStr.split(" "); 	// ["WIN", "2,0,0,11"]
			tempString        = tempArray[1];			// "2,0,0,11"
			versionArray      = tempString.split(",");	// ['2', '0', '0', '11']
		} else {
			versionArray      = versionStr.split(".");
		}
		var versionMajor      = versionArray[0];
		var versionMinor      = versionArray[1];
		var versionRevision   = versionArray[2];

        	// is the major.revision >= requested major.revision AND the minor version >= requested minor
		if (versionMajor > parseFloat(reqMajorVer)) {
			return true;
		} else if (versionMajor == parseFloat(reqMajorVer)) {
			if (versionMinor > parseFloat(reqMinorVer))
				return true;
			else if (versionMinor == parseFloat(reqMinorVer)) {
				if (versionRevision >= parseFloat(reqRevision))
					return true;
			}
		}
		return false;
	}
}

function AC_AddExtension(src, ext)
{
  if (src.indexOf('?') != -1)
    return src.replace(/\?/, ext+'?'); 
  else
    return src + ext;
}

function AC_Generateobj(objAttrs, params, embedAttrs) 
{ 
  var str = '';
  if (isIE && isWin && !isOpera)
  {
    str += '<object ';
    for (var i in objAttrs)
    {
      str += i + '="' + objAttrs[i] + '" ';
    }
    str += '>';
    for (var i in params)
    {
      str += '<param name="' + i + '" value="' + params[i] + '" /> ';
    }
    str += '</object>';
  }
  else
  {
    str += '<embed ';
    for (var i in embedAttrs)
    {
      str += i + '="' + embedAttrs[i] + '" ';
    }
    str += '> </embed>';
  }

  document.write(str);
}

function AC_FL_RunContent(){
  var ret = 
    AC_GetArgs
    (  arguments, ".swf", "movie", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
     , "application/x-shockwave-flash"
    );
  AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
}

function AC_SW_RunContent(){
  var ret = 
    AC_GetArgs
    (  arguments, ".dcr", "src", "clsid:166B1BCA-3F9C-11CF-8075-444553540000"
     , null
    );
  AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
}

function AC_Generateobj2(objAttrs, params, embedAttrs,destino) 
{ 
  var str = '<object ';
  for (var i in objAttrs)
    str += i + '="' + objAttrs[i] + '" ';
  str += '>';
  for (var i in params)
    str += '<param name="' + i + '" value="' + params[i] + '" > ';
  str += '<embed ';
  for (var i in embedAttrs)
    str += i + '="' + embedAttrs[i] + '" ';
  str += ' ></embed></object>';

	document.getElementById(destino).innerHTML=str;
}

function AC_FL_RunContent2(name,destino){
  var now = new Date();
  var minutes = Math.round(now.getMinutes()/30);
  var ret = 
    AC_GetArgs
    (  arguments, ".swf", "movie", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
     , "application/x-shockwave-flash"
    );
  AC_Generateobj2(ret.objAttrs, ret.params, ret.embedAttrs,destino);
}

function AC_GetArgs(args, ext, srcParamName, classid, mimeType){
  var ret = new Object();
  ret.embedAttrs = new Object();
  ret.params = new Object();
  ret.objAttrs = new Object();
  for (var i=0; i < args.length; i=i+2){
    var currArg = args[i].toLowerCase();    

    switch (currArg){	
      case "classid":
        break;
      case "pluginspage":
        ret.embedAttrs[args[i]] = args[i+1];
        break;
      case "src":
      case "movie":	
        args[i+1] = AC_AddExtension(args[i+1], ext);
        ret.embedAttrs["src"] = args[i+1];
        ret.params[srcParamName] = args[i+1];
        break;
      case "onafterupdate":
      case "onbeforeupdate":
      case "onblur":
      case "oncellchange":
      case "onclick":
      case "ondblClick":
      case "ondrag":
      case "ondragend":
      case "ondragenter":
      case "ondragleave":
      case "ondragover":
      case "ondrop":
      case "onfinish":
      case "onfocus":
      case "onhelp":
      case "onmousedown":
      case "onmouseup":
      case "onmouseover":
      case "onmousemove":
      case "onmouseout":
      case "onkeypress":
      case "onkeydown":
      case "onkeyup":
      case "onload":
      case "onlosecapture":
      case "onpropertychange":
      case "onreadystatechange":
      case "onrowsdelete":
      case "onrowenter":
      case "onrowexit":
      case "onrowsinserted":
      case "onstart":
      case "onscroll":
      case "onbeforeeditfocus":
      case "onactivate":
      case "onbeforedeactivate":
      case "ondeactivate":
      case "type":
      case "codebase":
      case "id":
        ret.objAttrs[args[i]] = args[i+1];
        break;
      case "width":
      case "height":
      case "align":
      case "vspace": 
      case "hspace":
      case "class":
      case "title":
      case "accesskey":
      case "name":
      case "tabindex":
        ret.embedAttrs[args[i]] = ret.objAttrs[args[i]] = args[i+1];
        break;
      default:
        ret.embedAttrs[args[i]] = ret.params[args[i]] = args[i+1];
    }
  }
  ret.objAttrs["classid"] = classid;
  if (mimeType) ret.embedAttrs["type"] = mimeType;
  return ret;
}

function MM_swapImgRestore() { //v3.0
	  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
	}

function MM_preloadImages() { //v3.0
	  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
		}

function MM_findObj(n, d) { //v4.01
	  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
	    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
	  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
	  if(!x && d.getElementById) x=d.getElementById(n); return x;
	}

function MM_swapImage() { //v3.0
	  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
	   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
	}

function MM_showHideLayers() { //v6.0
	  var i,p,v,obj,args=MM_showHideLayers.arguments;
	  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
	    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
	    obj.visibility=v; }
	}

function MM_timelinePlay(tmLnName, myID) { //v1.2
	  //Copyright 1997, 2000 Macromedia, Inc. All rights reserved.
	  var i,j,tmLn,props,keyFrm,sprite,numKeyFr,firstKeyFr,propNum,theObj,firstTime=false;
	  if (document.MM_Time == null) MM_initTimelines(); //if *very* 1st time
	  tmLn = document.MM_Time[tmLnName];
	  if (myID == null) { myID = ++tmLn.ID; firstTime=true;}//if new call, incr ID
	  if (myID == tmLn.ID) { //if Im newest
	    setTimeout('MM_timelinePlay("'+tmLnName+'",'+myID+')',tmLn.delay);
	    fNew = ++tmLn.curFrame;
	    for (i=0; i<tmLn.length; i++) {
	      sprite = tmLn[i];
	      if (sprite.charAt(0) == 's') {
	        if (sprite.obj) {
	          numKeyFr = sprite.keyFrames.length; firstKeyFr = sprite.keyFrames[0];
	          if (fNew >= firstKeyFr && fNew <= sprite.keyFrames[numKeyFr-1]) {//in range
	            keyFrm=1;
	            for (j=0; j<sprite.values.length; j++) {
	              props = sprite.values[j]; 
	              if (numKeyFr != props.length) {
	                if (props.prop2 == null) sprite.obj[props.prop] = props[fNew-firstKeyFr];
	                else        sprite.obj[props.prop2][props.prop] = props[fNew-firstKeyFr];
	              } else {
	                while (keyFrm<numKeyFr && fNew>=sprite.keyFrames[keyFrm]) keyFrm++;
	                if (firstTime || fNew==sprite.keyFrames[keyFrm-1]) {
	                  if (props.prop2 == null) sprite.obj[props.prop] = props[keyFrm-1];
	                  else        sprite.obj[props.prop2][props.prop] = props[keyFrm-1];
	        } } } } }
	      } else if (sprite.charAt(0)=='b' && fNew == sprite.frame) eval(sprite.value);
	      if (fNew > tmLn.lastFrame) tmLn.ID = 0;
	  } }
	}

function MM_initTimelines() { //v4.0
	    //MM_initTimelines() Copyright 1997 Macromedia, Inc. All rights reserved.
	    var ns = navigator.appName == "Netscape";
	    var ns4 = (ns && parseInt(navigator.appVersion) == 4);
	    var ns5 = (ns && parseInt(navigator.appVersion) > 4);
	    var macIE5 = (navigator.platform ? (navigator.platform == "MacPPC") : false) && (navigator.appName == "Microsoft Internet Explorer") && (parseInt(navigator.appVersion) >= 4);
	    document.MM_Time = new Array(1);
	    document.MM_Time[0] = new Array(2);
	    document.MM_Time["Timeline1"] = document.MM_Time[0];
	    document.MM_Time[0].MM_Name = "Timeline1";
	    document.MM_Time[0].fps = 15;
	    document.MM_Time[0][0] = new String("sprite");
	    document.MM_Time[0][0].slot = 1;
	    if (ns4)
	        document.MM_Time[0][0].obj = document["FDWcapa"];
	    else if (ns5)
	        document.MM_Time[0][0].obj = document.getElementById("FDWcapa");
	    else
	        document.MM_Time[0][0].obj = document.all ? document.all["FDWcapa"] : null;
	    document.MM_Time[0][0].keyFrames = new Array(5, 70);
	    document.MM_Time[0][0].values = new Array(2);
	    if (ns5 || macIE5)
	        document.MM_Time[0][0].values[0] = new Array("640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px", "640px");
	    else
	        document.MM_Time[0][0].values[0] = new Array(640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640,640);
	    document.MM_Time[0][0].values[0].prop = "left";
	    if (ns5 || macIE5)
	        document.MM_Time[0][0].values[1] = new Array("320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px", "320px");
	    else
	        document.MM_Time[0][0].values[1] = new Array(320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320,320);
	    document.MM_Time[0][0].values[1].prop = "top";
	    if (!ns4) {
	        document.MM_Time[0][0].values[0].prop2 = "style";
	        document.MM_Time[0][0].values[1].prop2 = "style";
	    }
	    document.MM_Time[0][1] = new String("behavior");
	    document.MM_Time[0][1].frame = 250;
	    document.MM_Time[0][1].value = "MM_showHideLayers('FDWcapa','','hide')";
	    document.MM_Time[0].lastFrame = 250;
	    for (i=0; i<document.MM_Time.length; i++) {
	        document.MM_Time[i].ID = null;
	        document.MM_Time[i].curFrame = 0;
	        document.MM_Time[i].delay = 1000/document.MM_Time[i].fps;
	    }
	};

function change_font(i,t,color1, color2) {
	ex=document.getElementById(i);
	ex.style.backgroundColor=color1;
	ex.style.color=color2;
};

function login_member(current_url){
	console.log("login_member");
	FB.getLoginStatus(function(response) {
         console.log( "In login status response" );
         if (response.session) {
             // logged in and connected user, someone you know
             console.log( "We have a session" );
             redir_fblogin(current_url);
             
         } else {
             // no user session available, someone you dont know
             console.log( "We don't have a session" );
             //window.location='http://apps.facebook.com/gritagol';
         }
     });
	
	/*
	FB.login(function(response) {
		  if (response.session) {
		    if (response.perms) {
		    	console.log("Logeado y con permisos");
		    	
		    } else {
		      // user is logged in, but did not grant any permissions
		    }
		  } else {
		    // user is not logged in
		  }
		});*/
   }


function redir_fblogin(current_url){
	console.log("fblogin");
	document.location.href = '/users/fblogin';	
}

function open_matchcenter(base){
	var w = (window.open(base+'scoreboards/match_center','MarcadorenVivo','width=760,height=755,menubar=no,scrollbars=no,resizable=no,toolbar=no,screenx=100,screeny=100',false));
}

function firstClear(obj)
{
  if(obj.clearThis == undefined)
  {
    obj.value = '';
    obj.clearThis = true;
  }
}