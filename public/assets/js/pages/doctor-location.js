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

async function initMap(lat, lng) {
    //@ts-ignore
    const {Map: GoogleMap} = await google.maps.importLibrary("maps");
    const {Marker} = await google.maps.importLibrary("marker");

    MapMarker= Marker;
    map = new GoogleMap(document.getElementById("map"), {
        center: {lat: lat, lng: lng},
        zoom: 17,
    });
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
            lat:Number(button.dataset.lat),
            lng: Number(button.dataset.lng)
        }

        map.panTo(position)
        const newMarker = new MapMarker({
            map,
            position,
            draggable: true, title: "destination", icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
            }
        })

    });

}

locationButtons.forEach(attachLocationButtonListener);