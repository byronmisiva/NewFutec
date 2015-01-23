/* 
  Copyright 2004 - Certifica.com 
  $Id$
*/

DEFAULT_PIVOT_NAME = 'cert_Pivot';
DEFAULT_REDIRECT_TIME = 3000;
DEFAULT_PERIODIC_REDIRECT_TIME = 60000;
DEFAULT_ORIGIN_COOKIE_NAME = 'cert_Origin';

var cert_CustomCounters = null;
var cert_CustomAttributes = null;

function cert_qVal(sValue) 
{
    var pos = String(document.location).indexOf('?');
    if (pos != -1) {
       var query = String(document.location).substring(pos+1);
       var vars = query.split("&");
       for (var i=0; i < vars.length; i++) {
          var pair = vars[i].split("=");
          if (pair[0] == sValue)
             return pair[1];
       }       
    }
    return null;  
}

function cert_getCookie(sName) {
  var dc = document.cookie;
  var prefix = sName + "=";
  var begin = dc.indexOf("; " + prefix);
  if (begin == -1) {
    begin = dc.indexOf(prefix);
    if (begin != 0) return null;
  } else
    begin += 2;
  var end = document.cookie.indexOf(";", begin);
  if (end == -1)
    end = dc.length;
  return unescape(dc.substring(begin + prefix.length, end));
}

function cert_setCookie(sName, sValue, dtExpires, sPath, sDomain, bSecure) {
  document.cookie = sName + "=" + escape(sValue) +
      ((dtExpires) ? "; expires=" + dtExpires.toGMTString() : "") +
      ((sPath) ? "; path=" + sPath : "") +
      ((sDomain) ? "; domain=" + sDomain : "") +
      ((bSecure) ? "; secure" : "");
}

function cert_getReferrer()
{
   var referrer = document.referrer;
   if (self.cert_getReferrer14)
      return cert_getReferrer14();
/*@cc_on
  @if(@_jscript_version >= 5 )
   try { 
      if ( self != top ) referrer = top.document.referrer;
   } catch(e) {};
  @end
  @*/
  return referrer;
}

/* Obtiene el tipo de protocolo del documento actual. */
function cert_getProtocol()
{
    if (window && window.location && window.location.protocol)
        return window.location.protocol;
    return null;
}
 
/* Crea una cookie con el contenido del referrer para evaluarlo
  en el paso final, si es necesario. */
function cert_setOrigin()
{
	var c = cert_getCookie(DEFAULT_ORIGIN_COOKIE_NAME);
	if (!c) {
		var l = cert_getReferrer();
		if (l) {
			var re = new RegExp('https?:\/\/([^\/]+)');
			var m = re.exec(l);
			if (m) {
				var m2 = re.exec(document.location);
				if (m2) {
					if (m[1] != m2[1]) {
						c = m[1];
					}
				}
			}
		}
		if (!c) {
			c = 'directo';
		}
		cert_setCookie(DEFAULT_ORIGIN_COOKIE_NAME, c);
	} 
}

function cert_getFlashVersion()
{
	var flashVersion = -1;
	if (navigator.plugins && navigator.plugins.length) {
		var objFlash = navigator.plugins["Shockwave Flash"];
		if (objFlash) {
			if (objFlash.description) {
				flashDesc = objFlash.description;
				flashVersion = flashDesc.charAt(flashDesc.indexOf('.')-1);
			}
		}

		if (navigator.plugins["Shockwave Flash 2.0"]) {
			flashVersion = 2;
		}
	} else if (navigator.mimeTypes && navigator.mimeTypes.length) {
		x = navigator.mimeTypes['application/x-shockwave-flash'];
		if (x && x.enabledPlugin) {
			flashVersion = 0; // no detectada!
		}
	}

	/*@cc_on
	for(var i = 10; i > 0; i--) {
		try {
			var flash = new ActiveXObject("ShockwaveFlash.ShockwaveFlash." + i);
			flashVersion = i;
			break;
		} catch(e){}
	}	
	@*/
	return flashVersion;
}

/* Crea la URL para obtener un pageview de Certifica. */
/* Solo necesita los parametros iSiteId y sPath       */
function cert_getURL(iSiteId, sPath, sAppend) 
{
    var referrer, url;
    referrer = 'otro';
    var o = cert_qVal('url_origen');
    var proto = cert_getProtocol();
    if (proto != 'https:')
        proto = 'http:';
    
    if (o != null && o != '')
       referrer = o;
    else 
       referrer = escape(cert_getReferrer());
    url = 
       proto + '//hits.e.cl/cert/hit.dll?sitio_id=' + iSiteId + '&path=' + sPath +
       '&referer=' + referrer ;
    url += '&java=' + navigator.javaEnabled() + '&flash=' + cert_getFlashVersion();
    if (sAppend)
        url += sAppend;
    return url;    
}

function cert_addCustomAttribute(sType, sValue)
{
	if (!cert_CustomAttributes) {
		cert_CustomAttributes = new Object();
	}

	cert_CustomAttributes[sType] = sValue;
}

function cert_addCustomCounter(sType, iValue)
{
	if (iValue && iValue > 0) {
		if (!cert_CustomCounters) {
			cert_CustomCounters = new Object();
		}

		if (cert_CustomCounters[sType]) {
			cert_CustomCounters[sType] += iValue;
		} else {
			cert_CustomCounters[sType] = iValue;
		}
	}
}


function cert_getCustomTags()
{
	var sRet = '';
	var ct_atrib = '', ct_acum = '';
	if (cert_CustomAttributes) {
		ct_atrib = 'ct_atrib=';
		for (var i in cert_CustomAttributes) {
			ct_atrib += i + ':' + cert_CustomAttributes[i] + ';';
		}
	}

	if (cert_CustomCounters) {
		ct_acum = 'ct_acum=';
		for (var i in cert_CustomCounters) {
			ct_acum += i + ':' + cert_CustomCounters[i] + ';';
		}
	}

	if (ct_atrib || ct_acum) {
		if (ct_atrib) {
			sRet += '&' + ct_atrib;
		}
		if (ct_acum) {
			sRet += '&' + ct_acum;
		}
	}
	return sRet;
}


/* Crea la URL para un sitio con e-Commerce. */
function cert_getURL_eCommerce(iSiteId, sPath, sAmount)
{
	var sOrigin = null;

	if ((sOrigin = cert_getCookie(DEFAULT_ORIGIN_COOKIE_NAME))) {
		cert_addCustomAttribute('origin', sOrigin);
	}

	if (sAmount) {
		cert_addCustomCounter('money', sAmount);
	}

	var sAppend = cert_getCustomTags();

	return cert_getURL(iSiteId, sPath, sAppend);
}
	
		
/* Efectua un hit en certifica usando una imagen pivote. */
function cert_registerHit(iSiteId, sPath, sPivotName) 
{
   var sAppend = '&cert_cachebuster=' + (1 + Math.floor (Math.random() * 10000));
   if ( !sPivotName )
      sPivotName = DEFAULT_PIVOT_NAME;
   if ( document.images )
      if ( document.images[sPivotName] )
         document.images[sPivotName].src = cert_getURL(iSiteId, sPath, sAppend);
}

/* Efectua una redireccion marcando la ruta de salida */
function cert_registerHitAndRedirect( sURL, iSiteId, sPath, sPivotName ) 
{
   cert_registerHit( iSiteId, sPath, sPivotName );
   setTimeout( "location.href = '" + sURL + "'", DEFAULT_REDIRECT_TIME );
}

/* Abre una nueva ventana, marcando el hit */
function cert_registerHitAndOpenWindow( sURL, iSiteId, sPath, sPivotName, sName, sFeatures, bReplace )
{
   cert_registerHit( iSiteId, sPath, sPivotName );
   if (!sName)
      sName = 'Downloads';
   if (!sFeatures)
      sFeatures = 'toolbar=no,location=no,directories=no,status=yes,menubar=no, scrollbars=no,resizable=no,width=425,height=510,screenX=20,screenY=20';
   window.open( sURL, 
      sName, 
      sFeatures, 
      bReplace 
   );
   return false;
}

/* Marca el hit y reemplaza/abre una URL en el frame 'sName' */
function cert_registerHitAndReplaceOtherFrame( sURL, sName, iSiteId, sPath, sPivotName ) 
{
   cert_registerHitAndOpenWindow( sURL, iSiteId, sPath, sPivotName, sName, 0, true );
}

/* Marca el hit y reemplaza/abre una URL en el frame 'sName' */
function cert_registerHitAndReplaceThisFrame( sURL, iSiteId, sPath, sPivotName ) 
{
   cert_registerHitAndRedirect( sURL, iSiteId, sPath, sPivotName );
}

/* Marca el hit y baja un archivo */
function cert_registerHitAndDownloadFile( sURL, iSiteId, sPath, sPivotName ) 
{
   cert_registerHitAndRedirect( sURL, iSiteId, sPath, sPivotName );
}

function cert_getAnchor(sUrl)
{
    return '<img src="' + sUrl + '" width="1" height="1" border="0" alt="Certifica.com">';
}

/* Marca un hit en la pagina actual */
function tagCertifica(iSiteId, sPath) 
{
	  var fragmento = sPath.split("/");
		if (fragmento.length > 4) 
		{
			sPath = fragmento[1] + "/" + fragmento[2] + "/" + fragmento[3] + "/" + fragmento[4];
	  }

    document.writeln(cert_getAnchor(cert_getURL(iSiteId, sPath)));
}

/* Marca un hit en la pagina actual, usando eCommerce */
function tagCertifica_eCommerce(iSiteId, sPath, iAmount) 
{
    document.writeln(cert_getAnchor(cert_getURL_eCommerce(iSiteId, sPath, iAmount)));
}

/* Marca un registro cada iTime milisegundos.  */
function cert_registerPeriodicHit( iSiteId, sPath, sPivotName, iTime ) 
{
   if ( !sPivotName )
      sPivotName = DEFAULT_PIVOT_NAME;
   if ( !iTime )
      iTime = DEFAULT_PERIODIC_REDIRECT_TIME;

   cert_registerHit( iSiteId, sPath, sPivotName );
   setTimeout( 'cert_registerPeriodicHit( ' + iSiteId + ', "' + sPath + '", "' + sPivotName + '", ' + iTime + ')', iTime );
}

cert_setOrigin();

