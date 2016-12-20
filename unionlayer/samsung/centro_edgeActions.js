/***********************
* Adobe Edge Animate Composition Actions
*
* Edit this file with caution, being careful to preserve 
* function signatures and comments starting with 'Edge' to maintain the 
* ability to interact with these actions from within Adobe Edge Animate
*
***********************/
(function($, Edge, compId){
var Composition = Edge.Composition, Symbol = Edge.Symbol; // aliases for commonly used Edge classes

   //Edge symbol: 'stage'
   (function(symbolName) {
      Symbol.bindElementAction(compId, symbolName, "${cerrar}", "click", function(sym, e) {
         // insert code for mouse click here
         // Play the timeline at a label or specific time. For example:
         // sym.play(500); or sym.play("myLabel");
         sym.play("sale");
         $(".pbl-union2").fadeOut();
         $("#div-gpt-ad-1450734059657-0").show();
         $("#div-gpt-ad-1450734059657-1").show();
      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${start_samsung}", "click", function(sym, e) {
         // insert code for mouse click here
         // Play the timeline at a label or specific time. For example:
         // sym.play(500); or sym.play("myLabel");
         sym.play("inicio");
      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 0, function(sym, e) {
         // insert code here
         sym.stop();

      });
      //Edge binding end

      

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1310, function(sym, e) {
         // insert code here
         sym.stop();
      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 2031, function(sym, e) {
         // insert code here
         sym.stop();
      });
      //Edge binding end

   })("stage");
   //Edge symbol end:'stage'

   //=========================================================
   
   //Edge symbol: 'cerrar'
   (function(symbolName) {   
   
      Symbol.bindElementAction(compId, symbolName, "${cerrar}", "click", function(sym, e) {
         // insert code for mouse click here
         // Play the timeline at a label or specific time. For example:
         // sym.play(500); or sym.play("myLabel");
         sym.play("play");
         $(".pbl-union2").fadeOut();
         $("#div-gpt-ad-1450734059657-0").show();
         $("#div-gpt-ad-1450734059657-1").show();

      });
      //Edge binding end

   })("cerrar");
   //Edge symbol end:'cerrar'

})(window.jQuery || AdobeEdge.$, AdobeEdge, "EDGE-11811650");
