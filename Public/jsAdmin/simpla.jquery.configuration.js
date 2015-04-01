
$(document).ready(function(){
	
	//Sidebar Accordion Menu:
		
		//$("#main-nav li ul").hide(); 
		$("#main-nav li a.current").parent().find("ul").show(); // Slide down the current menu item's sub menu

		
	
		$("#main-nav li a.nav-top-item").click( // When a top menu item is clicked...
			function () {
				//$("#main-nav li ul").hide("normal");
				$(this).parent().siblings().find("ul").slideUp("normal"); // Slide up all sub menus except the one clicked
				$(this).next().slideToggle("normal"); // Slide down the clicked sub menu
				return false;
			}
		);
		
	

    // Sidebar Accordion Menu Hover Effect:
		
		$("#main-nav li .nav-top-item").hover(
			function () {
				$(this).stop().animate({ paddingRight: "25px" }, 200);
			}, 
			function () {
				$(this).stop().animate({ paddingRight: "15px" });
			}
		);


});
  
  
  