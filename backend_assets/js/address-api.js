function initialize() {
    var input = document.getElementById('address');
    new google.maps.places.Autocomplete(input);
  }
  
  google.maps.event.addDomListener(window, 'load', initialize);