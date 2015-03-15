//weather map
function initialize(lat, longi) {

  var mapOptions = {
    zoom: 6,
    center: new google.maps.LatLng(lat, longi)
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var weatherLayer = new google.maps.weather.WeatherLayer({
    temperatureUnits: google.maps.weather.TemperatureUnit.FAHRENHEIT
  });
  weatherLayer.setMap(map);

  var cloudLayer = new google.maps.weather.CloudLayer();
  cloudLayer.setMap(map);
}

//get longitude and latitude and show the weather map
  function showWeather(){
    if (navigator.geolocation){
      navigator.geolocation.getCurrentPosition(showPosition);
    }
  }
  function showPosition(position){
    google.maps.event.addDomListener(window, 'load', initialize( position.coords.latitude,  position.coords.longitude)); 
  }