<style>
#google-map {
    height: 100%;
    width: 100%;
    border-radius:.5em;
    box-shadow: 0 7px 14px 0 #3b415e1a, 0 3px 6px 0 #00000012;
}
.google-map-infowindow-content {
    padding: .4rem 1rem;
    font-weight: 500;
    font-size: 14px;
    color: black;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    line-height: 1.5; 
    a {
        color: inherit;
    }
}
.gm-style .gm-style-iw-t::after {
    top: -1px;
}
</style>
<div id="google-map"></div>
<script src="https://maps.googleapis.com/maps/api/js?callback=googleMapInit" defer></script>
<?php
    $user = \MySql::connect()->prepare("SELECT * FROM `users` WHERE `id` = '$_SESSION[user_id]'");
    $user->execute();
    $user = $user->fetch();
?>

<script type="application/json" id="google-maps-coords">
[{"location_name":"<?php echo $user['name']; ?>","latitude":"<?php echo $user['lat_coord']; ?>","longitude":"<?php echo $user['long_coord']; ?>"}]
</script>


<script>
  const GoogleMaps = function(el, coords) {
    const gm = window.google && window.google.maps;

    if (!gm) return;
    
    const map = new gm.Map(el);
    const bounds = new gm.LatLngBounds();
    const infoWindow = new gm.InfoWindow();
    
    for (let coord in coords) {
        placeMarker(coords[coord]);
    }
    
    map.fitBounds(bounds);
    
    const idleListener = gm.event.addListener(map, 'idle', function() {
        if (map.getZoom() > 14) map.setZoom(14);
        gm.event.removeListener(idleListener);
    });
    
    
    if (infoWindow) {
        gm.event.addListener(map, 'click', function() {
            infoWindow.close();
        });
    }

    
    function placeMarker(loc) {
        const marker = new gm.Marker({
            map: map,
            position: {
                lat: Number(loc.latitude),
                lng: Number(loc.longitude),
            },
        });
        
        if (infoWindow) {
            gm.event.addListener(marker, 'click', function() {
                infoWindow.close(); 
                infoWindow.setContent(infoWindowTemplate(loc));
                infoWindow.open(map, marker);
            });
        }

        bounds.extend(marker.position);
    }
    
    
    function infoWindowTemplate(data) {
        const text = data.location_name;
        const link = data.location_link;
        
        const content = link 
            ? '<a href="'+ link +'">' + text + '</a>' 
            : text;
        
        return '<div class="google-map-infowindow-content">' + content + '</div>';
    }
};


window.googleMapInit = function() {
    const el = document.getElementById('google-map');
    const coords = JSON.parse(document.getElementById('google-maps-coords').innerHTML);
    
    GoogleMaps(el, coords);
};

</script>
