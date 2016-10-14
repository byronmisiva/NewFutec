$(document).ready(function() {
	
   	setTimeout(frame1, 3000);
	function frame1() {
		$(".copy").removeClass("CopyIn").addClass("CopyOut");
		$(".ace").removeClass("AceIn").addClass("AceOut");
		$(".rosa").addClass("RosaIn");
		$(".zapa_z").addClass("Zapa_zIn");
	}
	
	setTimeout(frame2, 5000);
	function frame2() {
		$(".rosa").removeClass("RosaIn").addClass("RosaIn2");
		$(".zapa_d").addClass("Zapa_dIn");
		$(".copy").removeClass("CopyOut").addClass("CopyIn");
		$(".ace").removeClass("AceOut").addClass("AceIn");
	}
	
});