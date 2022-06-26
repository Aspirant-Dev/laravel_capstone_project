function initMap() {
    const directionRenderer = new google.maps.directionRenderer();
    const directionService = new google.maps.directionService();
    const map = new google.maps.map(document.getElementById("map"), {
        zoom: 14,
        conter: { lat: 14.756952871239124, lng: 120.95274809028321 },
    });
    directionRenderer.setMap(map);

}