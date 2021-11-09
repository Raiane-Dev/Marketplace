for (var i = 0; i < document.links.length; i++) {
  if (document.links[i].href == document.URL) {
  document.links[i].parentElement.classList.add('active');
  }
}

function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }
  
  function showPosition(position) {
    const lat_coord = position.coords.latitude;
    const long_coord = position.coords.longitude;

    document.getElementById('lat_coord').value = lat_coord;
    document.getElementById('long_coord').value = long_coord;
  }
  
    getLocation();