const locationButtons = document.querySelectorAll(".location-btn");


(g => {
    var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__",
        m = document, b = window;
    b = b[c] || (b[c] = {});
    var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams,
        u = () => h || (h = new Promise(async (f, n) => {
            await (a = m.createElement("script"));
            e.set("libraries", [...r] + "");
            for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
            e.set("callback", c + ".maps." + q);
            a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
            d[q] = f;
            a.onerror = () => h = n(Error(p + " could not load."));
            a.nonce = m.querySelector("script[nonce]")?.nonce || "";
            m.head.append(a)
        }));
    d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
})
({key: "AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg", v: "weekly"});

let map;
let MapMarker;
let newMarker;
let directionsService;
let directionsRenderer;
let polyline;
let doctorPosition;

async function initMap(lat, lng) {
    //@ts-ignore
    doctorPosition = {lat, lng}
    const {Map: GoogleMap} = await google.maps.importLibrary("maps");
    const {Marker} = await google.maps.importLibrary("marker");

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();

    MapMarker = Marker;
    map = new GoogleMap(document.getElementById("map"), {
        center: {lat: lat, lng: lng},
        zoom: 17,
    });

    directionsRenderer.setMap(map);


    const marker1 = new Marker({
        map: map,
        position: {lat: lat, lng: lng},
        draggable: false, title: "destination", icon: {
            url: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
        }
    })
}


if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        console.log("Latitude: " + lat + ", Longitude: " + lng);
        initMap(lat, lng);
    }, function (error) {
        console.error("Error getting location:", error);
        initMap(6.9271, 79.8612);
    });
} else {
    console.error("Geolocation is not supported by this browser.");
    initMap(6.9271, 79.8612);
}

function attachLocationButtonListener(button) {
    button.addEventListener("click", function () {

        const position = {
            lat: Number(button.dataset.lat),
            lng: Number(button.dataset.lng)
        }

        map.panTo(position)
        if (newMarker) {
            newMarker.setPosition(position);
        } else {
            newMarker = new MapMarker({
                map,
                position,
                draggable: false, title: "destination", icon: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
                }
            })
        }
        clearPolyline()
        drawPolyline(doctorPosition, position)
    });
}

function drawPolyline(origin, destination) {
    // Calculate the route using the DirectionsService
    // const directionsService = new google.maps.DirectionsService();
    const request = {
        origin,
        destination,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, (result, status) => {
        if (status === google.maps.DirectionsStatus.OK) {
            const distance = result.routes[0].legs[0].distance.value; // Get the driving distance in meters
            console.log(`Driving distance: ${distance} meters`);
            const points = [];
            const legs = result.routes[0].legs;
            for (let i = 0; i < legs.length; i++) {
                const steps = legs[i].steps;
                for (let j = 0; j < steps.length; j++) {
                    const nextSegment = steps[j].path;
                    for (let k = 0; k < nextSegment.length; k++) {
                        points.push(nextSegment[k]);
                    }
                }
            }
            // Create the Polyline object
            polyline = new google.maps.Polyline({
                path: points,
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });
            // Set the Polyline object on the map
            polyline.setMap(map);
        }
    });
}

function clearPolyline() {
    // Check if the Polyline object exists and remove it from the map
    if (polyline) {
        polyline.setMap(null);
    }
}


locationButtons.forEach(attachLocationButtonListener);