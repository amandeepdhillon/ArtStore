function initMap(latitude, longitude) {
    var loc = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 18,
        center: loc
     });
     var marker = new google.maps.Marker({
        position: loc,
        map: map
    });
}