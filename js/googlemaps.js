function initMap() {
    // Mapa San José
    var sanJose = { lat: 9.9281, lng: -84.0907 };
    var mapSanJose = new google.maps.Map(document.getElementById('map-sanjose'), {
        zoom: 12,
        center: sanJose
    });
    var markerSanJose = new google.maps.Marker({
        position: sanJose,
        map: mapSanJose,
        title: 'Centro de Acopio San José'
    });

    // Mapa Alajuela
    var alajuela = { lat: 10.0169, lng: -84.2233 };
    var mapAlajuela = new google.maps.Map(document.getElementById('map-alajuela'), {
        zoom: 12,
        center: alajuela
    });
    var markerAlajuela = new google.maps.Marker({
        position: alajuela,
        map: mapAlajuela,
        title: 'Centro de Acopio Alajuela'
    });

    // Mapa Heredia
    var heredia = { lat: 9.9924, lng: -84.1181 };
    var mapHeredia = new google.maps.Map(document.getElementById('map-heredia'), {
        zoom: 12,
        center: heredia
    });
    var markerHeredia = new google.maps.Marker({
        position: heredia,
        map: mapHeredia,
        title: 'Centro de Acopio Heredia'
    });
}

// Cargar el mapa cuando la página se haya cargado
window.onload = initMap;
