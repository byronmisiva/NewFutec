$(document).ready(function() {
	
   	setTimeout(frame1, 3000);
	function frame1() {
		$(".copy").removeClass("CopyIn").addClass("CopyOut");
		$(".ace").removeClass("AceIn").addClass("AceOut");
		$(".rosa").addClass("RosaIn");
		$(".zapa_z").addClass("Zapa_zIn");
	}
	
	setTimeout(frame2, 3500);
	function frame2() {
		$(".copy").removeClass("CopyOut").addClass("CopyIn");
		$(".ace").removeClass("AceOut").addClass("AceIn");
	}
	
});