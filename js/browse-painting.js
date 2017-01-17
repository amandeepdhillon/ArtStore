$(function() 
{
    // When page finishes loading, initiate loading of initial values
    populateResults();
    
    // When the select element is changed, update 
   $('#dropdownitem select').on("change", function(e) 
   {
       var val = $(this).val();
       var name = $(this).attr('name');
       var type = name.toLowerCase();
        
        // Update filter identifier (located just below "Paintings" title)
       $('#filter').html(name.toUpperCase() + ' = ' + $(this).find(':selected').text().toUpperCase());
        
        resetDropdowns(name);
        populateResults(type, val);
   });
   
/*
* Resets dropdowns that weren't selected to their default values
*/
   function resetDropdowns (name) {
       if (name != "Artist") { $('#dropdownitem div.field#ArtistFilter div.ui.dropdown div.text').html('Select Artist'); }
       if (name != "Gallery") { $('#dropdownitem div.field#GalleryFilter div.ui.dropdown div.text').html('Select Gallery'); }
       if (name != "Shape") { $('#dropdownitem div.field#ShapeFilter div.ui.dropdown div.text').html('Select Shape'); }
   }
   
/*
* Empties current list, queries web service, and processes results
*/
    function populateResults (type, val) {
        transitionOutList();
        var url = "service-painting.php?type=" + type + "&id=" + val; 
        $.get(url)
        .done(function(data)
        {
            $('#paintingsResults').empty();
            $.each(JSON.parse(data), function(index, item) 
            {
                if (index < 20) { createPaintingItem(index, item);}
                else { return false; }
            });
        })
        .fail(function(xhr,status,error) 
        {
				alert("failed loading data - status=" + status +
				" error=" + error);
		})
		.always(function(data){
		    $('.ui.active.dimmer').removeClass('active');
		    $('#paintingsResults .painting.item').transition('hide').transition('slide right', '1000ms');
		});
    }
	
/*
* Checks to see if any items are in the list and transitions them out	
*/
	function transitionOutList() {
        if ($('#paintingsResults').children().length != 0 ) { 
            $('#paintingsResults .painting.item').transition('slide left', '1000ms'); 
            $('.ui.dimmer').addClass('active');
        }
	}
	
/*
* Creates HTML elements and populates them; adds elements to the document
*/
	function createPaintingItem(index, item) {
	    var current = '#paintingsResults .painting.item#' + parseInt(index);

        $('<div>').addClass('painting item').attr('id', index).appendTo('#paintingsResults');
        var imageLink = $('<a>').addClass('image').attr('href', 'single-painting.php?id=' + item.PaintingID).appendTo(current);
        $('<img>').attr('src', 'images/art/works/square-medium/' + item.ImageFileName + '.jpg').appendTo(imageLink);
        
        var content = $('<div>').addClass('content').appendTo(current);
        $('<h3>').addClass('header').html(item.Title).appendTo(content);
        $('<div>').addClass('meta').append($('<span>').addClass('artistName').html(item.ArtistName)).appendTo(content);
        $('<div>').addClass('description').append($('<p>').html(item.Description)).appendTo(content);
        
        var extra = $('<div>').addClass('extra').appendTo(content);
        $('<p>').addClass('cost').html(parseFloat(item.MSRP).toLocaleString('en-US', {style: 'currency', currency: 'USD'})).appendTo(extra);
        
        var cartButton = $('<button>').addClass('ui orange icon button').append($('<i>').addClass('shop icon'));
        $('<a>').attr('href', "add-to-cart.php?id=" + item.PaintingID).attr('id', 'cart').append(cartButton).appendTo(extra);
        
        var favButton = $('<button>').addClass('ui icon button').append($('<i>').addClass('book icon'));
        $('<a>').attr('href', '../addFavorite.php?id=' + item.PaintingID + '&type=painting&action=add').attr('id', 'fav').append(favButton).appendTo(extra);
	}
});