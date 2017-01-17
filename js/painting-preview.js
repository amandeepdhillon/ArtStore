$(function (){ 
// Setting up listeners
	$('div.doubling.cards img, div.item a img,image').on("mouseover", createPreview);
    $("div.doubling.cards img, div.item a img,image").on("mouseleave", removePreview);
    $("div.doubling.cards img, div.item a img,image").on("mousemove", movePreview);

/*
* Construct preview filename based on existing img
*/
   function createPreview() { 
		var alt = $(this).attr('alt');
		var src = $(this).attr('src');
		var newsrc = src.replace("square-medium","average");

		var preview = $('<div id="preview"></div>');
		var header = $('<h1>Preview: </h1>');
		var image = $('<img src="' + newsrc + '">');
		preview.append(header);
		preview.append(image);
		$('main').append(preview);

		$(this).addClass("gray");
		$('#preview h1').css("color", "white");
		$("#preview").fadeIn(1000);
   } 
/*
* Positions preview on screen
*/
   function movePreview() {
    	$("#preview")
    		.css("top", (30) + "px")
    		.css("left", (30) + "px")
    		.css("position", "fixed");
    }
   
/*
* Removes the dynamic element and the gray class
*/ 
	function removePreview() {
	    $(this).removeClass("gray");
	    $("#preview").remove();
    }
});