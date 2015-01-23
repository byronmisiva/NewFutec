/* 
  Copyright 2007 - Certifica.com 
  $Id: certifica-js14.js 1645 2007-04-03 13:54:19Z leus $
*/
function cert_getReferrer14()
{
   var referrer = document.referrer;
   try { 
      if ( self != top ) 
         referrer = top.document.referrer;
   } catch(e) {
      referrer = document.referrer;
   }
   return referrer;
}
