  
$(function() {
  var search = [];
  var url = "service-painting.php"; 
  
  // Query web service for all paintings
  $.get(url)
      .done(function(data) {
        var results = JSON.parse(data);
        // processes web service JSON object, adds to search array
        for(var i = 0; i < results.length;i++){
          var obj = new Object();
          obj.title = results[i].Title;
          obj.description = results[i].ArtistName;
          obj.url = 'single-painting.php?id=' + results[i].PaintingID;
          search.push(obj);
        }
        
        // Initialize search through local array "search"
        $('.ui.search').search({
          source: search,
            fields : {
              title: 'title',
              description: 'description',
              url: 'url'
            },
            searchFields : [
              'title'
              ],
            searchFullText: false,
            cache: true,
            minCharacters : 2,
            maxResults: 20
          });
    })
    .fail(function(xhr,status,error) 
    {
			alert("failed loading data - status=" + status + " error=" + error);
	  });
});