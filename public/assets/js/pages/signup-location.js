let map, marker1;
const locationLatInput = document.querySelector("#location_lat")
const locationLngInput = document.querySelector("#location_lng")

//initialize the map
async function initMap(lat, lng) {
    //@ts-ignore
    const {Map: GoogleMap} = await google.maps.importLibrary("maps");
    const {Marker} = await google.maps.importLibrary("marker");
    map = new GoogleMap(document.getElementById("map"), {
        center: {lat: lat, lng: lng},
        zoom: 17,
    });
    marker1 = new Marker({
        map: map,
        position: {lat: lat, lng: lng},
        draggable: true, title: "location", icon: {
            url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
        }
    })

    marker1.addListener('dragend', () => {
        const position = marker1.getPosition()
        const lat = position.lat()
        const lng = position.lng()
        locationLatInput.value = lat
        locationLngInput.value = lng
    })
}

if (navigator.geolocation) {
    //get the user's current location
    navigator.geolocation.getCurrentPosition(function (position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        console.log("Latitude: " + lat + ", Longitude: " + lng);
        locationLatInput.value = lat
        locationLngInput.value = lng
        initMap(lat, lng);
    }, function (error) { //if the user denies the user location set the colombo's coordinates as default location
        console.error("Error getting location:", error);
        initMap(6.9271, 79.8612);
        locationLatInput.value = 6.9271
        locationLngInput.value = 79.8612
    });
} else {
    console.error("Geolocation is not supported by this browser.");
    initMap(6.9271, 79.8612);
    locationLatInput.value = 6.9271
    locationLngInput.value = 79.8612
}