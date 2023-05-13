<?php
/**
 * @var $care_rider ;
 * @var $time_slot ;
 * @var $feedback ;
 * @var $location ;
 */
if (!isset($_GET['care-rider-feedback-btn'])) {
    $provider_nic = $_GET['provider_nic'];
}


?>
<link rel="stylesheet" href="/assets/css/main.css" xmlns="http://www.w3.org/1999/html">
<div class="consumer-dashboard-doctor-profile">
    <div class="consumer-dashboard-doctor-profile__top">
        <table>
            <tr>
                <td>
                    <div class="consumer-dashboard-doctor-profile__top__left">
                        <div class="item-top-left__container">
                            <img src="<?php echo $care_rider[0]['profile_picture']; ?>" alt="">
                            <div class="care-rider__overview-detail">
                                <h2><?php echo($care_rider[0]['name']) ?></h2>
                                <p>Type of Vehicle:<?php echo($care_rider[0]['type']); ?></p>
                                <p>color:<?php echo($care_rider[0]['color']); ?></p>
                                <p>No-Plate:<?php echo($care_rider[0]['number_plate']); ?>4</p>
                                <p>MobileNo:<?php echo($care_rider[0]['mobile_number']); ?>7</p>
                            </div>
                        </div>


                    </div>
                </td>
                <td>
                    <form action="/consumer-dashboard/services/care-rider/request/location?provider_nic=<?php echo $provider_nic; ?>"
                          method="POST">
                        <div class="care-rider-dashboard-care-rider-profile__top__right">

                            <div class="care-rider-dashboard-timeslots-display" >
                                <h4 style="padding: 1rem;">Available Time-Slots</h4>
                                <div class="care-rider-timeslots-display">
                                    <table id="care-rider-available-slot">
                                        <thead>
                                        <th>Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        </thead>
                                        <tbody>
                                                <?php foreach ($time_slot as $value) { ?>
                                                    <tr>
                                                        <td hidden><?php echo date('l', strtotime($value['date'])); ?></td>
                                                        <td><?php echo $value['date']; ?></td>
                                                        <td><?php echo $value['from_time'] ?></td>
                                                        <td><?php echo $value['to_time'] ?></td>
                                                        <td><?php echo " "; ?></td>
                                                        <td><input type="radio" value="
                                                    <?php echo $value['slot_number']; ?>" name="available-time-slot">
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <label for="">Pick up time</label>
                                <input class="pickup-time" type="time" name="pickup-time" id="pickup-time">
                            </div>
                            <div class="dat-time-container ">

                                <div class="location-time">

                                </div>
                            </div>

                            <input type="text" name="pickup-lat" id="pickup-lat" style="opacity: 0">
                            <input type="text" name="pickup-lng" id="pickup-lng" style="opacity: 0">
                            <input type="text" name="drop-lat" id="drop-lat" style="opacity: 0">
                            <input type="text" name="drop-lng" id="drop-lng" style="opacity: 0">
                            <input type="text" name="distance" id="distance" style="opacity: 0">


                            <!--                    <div class="consumer-dashboard-care-rider-profile__top__right">-->

                            <p><b>Add Location</b></p>
                            <div>
                                <input type="text" placeholder="Enter the pickup address" class="care-rider-input-location" id="pickup-address">
                                <button class="care-rider-search-location-button" onclick="findPickupAddress()" type="button" id="care-rider-location-search">Search</button>
                            </div>

                            <div>
                                <select name="pickup-location_results" id="pickup-location_results" class="location_results" style="margin-top: 2.5rem"></select>
                            </div>

                            <div>
                                <input type="text" placeholder="Enter the drop address" class="care-rider-input-location" id="drop-address">
                                <button class="care-rider-search-location-button" onclick="findDropAddress()" type="button" id="care-rider-location-search">Search</button>
                            </div>

                            <div>
                                <select name="drop-location_results" id="drop-location_results" class="location_results" style="margin-top: 2.5rem"></select>
                            </div>

                            <div class="item-top-right__container">
                                <div class="map" id="map" style="height:100%;width: 80%;margin-inline: auto">

                                </div>

                            </div>

                            <button class="btn" type="submit"> Request</button>
                        </div>
                    </form>

    </div>


</div>
</div>
</td>
</tr>
</table>
</div>
<div class="consumer-dashboard-doctor-profile__bottom">
    <table>
        <tr>
            <td>
                <div class="consumer-dashboard-doctor-profile__bottom__left">
                    <?php foreach ($feedback as $value) { ?>
                        <div class="consumer-dashboard-doctor-profile__bottom__left__data">
                            <img src="<?php echo $value['profile_picture']; ?>" alt="">
                            <h3><b><?php echo $value['name'] ?></b></h3>
                            <h4><?php echo $value['date_time'] ?></h4>
                            <p><?php echo $value['text'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </td>
            <td>
                <div class="consumer-dashboard-doctor-profile__bottom__right">
                    <h3>Give your Feedback</h3>
                    <form action="/consumer-dashboard/services/care-rider/request/feedback?provider_nic= <?php echo $_GET['provider_nic']; ?>"
                          method="post">
                        <!--                        <input type="datetime-local" name="feedback-datetime" class="doctor-feedback-datetime">-->
                        <input type="text" name="feedback-msg" class="doctor-feedback">
                        <input name="provider_nic" value="<?php echo $provider_nic ?>" type="text" hidden>
                        <button class="btn" name="care-rider-feedback-btn">Submit</button>
                    </form>
                </div>
            </td>
        </tr>
    </table>

</div>
<!--<script src="/assets/js/pages/timeslots.js"></script>-->
</div>
<script>(g => {
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
    ({key: "AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg", v: "weekly"});</script>

<script>let map, marker1,marker2;
    const pickupLatInput = document.querySelector("#pickup-lat")
    const pickupLngInput = document.querySelector("#pickup-lng")
    const dropLatInput = document.querySelector("#drop-lat")
    const dropLngInput = document.querySelector("#drop-lng")
    const distanceInput = document.querySelector("#distance")
    const pickupAddress = document.querySelector("#pickup-address");
    const pickupLocationResultsInput = document.querySelector("#pickup-location_results")
    const dropAddress = document.querySelector("#drop-address");
    const dropLocationResultsInput = document.querySelector("#drop-location_results")
    let results = []

    pickupLocationResultsInput.addEventListener('change', () => {
        console.log(pickupLocationResultsInput.value)
        const selectedPickupLocation = results.find((i) => i.place_id === Number(pickupLocationResultsInput.value))
        console.log(selectedPickupLocation)
        setMarkerAndPan({
            lat: Number(selectedPickupLocation.lat),
            lng: Number(selectedPickupLocation.lon)
        })
    })

    async function findPickupAddress() {
        try{
            const pickupResponse = await fetch("https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + pickupAddress.value)
            const pickupLocationResults  = await pickupResponse.json()
            console.log(pickupLocationResults)
            results = pickupLocationResults
            if(results.length === 1) {
                setMarkerAndPan({
                    lat: Number(results[0].lat),
                    lng: Number(results[0].lon)
                })
            }
            let pickupOptions = pickupLocationResults.map(lR => {
                return "<option value='"+lR.place_id +"' >" + lR.display_name + "</option>"
            }).join("")
            pickupLocationResultsInput.innerHTML = pickupOptions
        } catch (e) {
            console.log(e)
        }

    }


    dropLocationResultsInput.addEventListener('change', () => {
        console.log(dropLocationResultsInput.value)
        const selectedDropLocation = results.find((i) => i.place_id === Number(dropLocationResultsInput.value))
        console.log(selectedDropLocation)
        setMarker1AndPan({
            lat: Number(selectedDropLocation.lat),
            lng: Number(selectedDropLocation.lon)
        })
    })

    async function findDropAddress() {
        console.log("got here")
        try{
            const dropResponse = await fetch("https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + dropAddress.value)
            const dropLocationResults = await dropResponse.json()
            console.log(dropLocationResults)
            results = dropLocationResults
            if(results.length === 1) {
                setMarkerAndPan({
                    lat: Number(results[0].lat),
                    lng: Number(results[0].lon)
                })
            }
            let dropOptions = dropLocationResults.map(lR => {
                return "<option value='"+lR.place_id +"' >" + lR.display_name + "</option>"
            }).join("")
            console.log(dropOptions)
            dropLocationResultsInput.innerHTML = dropOptions
        } catch (e) {
            console.log(e)
        }

    }



    async function initMap(lat, lng) {
        //@ts-ignore
        const {Map: GoogleMap} = await google.maps.importLibrary("maps");
        const {Marker} = await google.maps.importLibrary("marker");
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);
        map = new GoogleMap(document.getElementById("map"), {
            center: {lat: lat, lng: lng},
            zoom: 17,
        });
        marker1 = new Marker({
            map: map,
            position: {lat: lat, lng: lng},
            draggable: true, title: "pickup", icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
            }
        })
        marker2 = new Marker({
            map: map,
            position: {lat: lat, lng: lng},
            draggable: true, title: "drop", icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
            }
        })


        let polyline; // Define the Polyline variable

        function drawPolyline(origin, destination) {
            // Calculate the route using the DirectionsService
            const directionsService = new google.maps.DirectionsService();
            const request = {
                origin,
                destination,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, (result, status) => {
                if (status === google.maps.DirectionsStatus.OK) {
                    const distance = result.routes[0].legs[0].distance.value; // Get the driving distance in meters
                    console.log(`Driving distance: ${distance} meters`);
                    distanceInput.value = distance / 1000;
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

        marker1.addListener('dragend', () => {
            const position = marker1.getPosition()
            const lat = position.lat()
            const lng = position.lng()
            // console.log(lat, lng)
            pickupLatInput.value = lat
            pickupLngInput.value = lng

            clearPolyline();
            drawPolyline(marker1.getPosition(), marker2.getPosition());
        })

        marker2.addListener('dragend', () => {
            const position = marker2.getPosition()
            const lat = position.lat()
            const lng = position.lng()
            // console.log(lat, lng)
            dropLatInput.value = lat
            dropLngInput.value = lng
            clearPolyline();
            drawPolyline(marker1.getPosition(), marker2.getPosition());


        })
    }

    function setMarkerAndPan(selectedPickupLocation) {
        map.panTo(selectedPickupLocation)
        marker1.setPosition(selectedPickupLocation)
        pickupLatInput.value = selectedPickupLocation.lat
        pickupLngInput.value = selectedPickupLocation.lng
    }

    function setMarker1AndPan(selectedDropLocation) {
        map.panTo(selectedDropLocation)
        marker2.setPosition(selectedDropLocation)
        dropLatInput.value = selectedDropLocation.lat
        dropLngInput.value = selectedDropLocation.lng
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            console.log("Latitude: " + lat + ", Longitude: " + lng);
            pickupLatInput.value = lat
            pickupLngInput.value = lng
            dropLatInput.value = lat
            dropLngInput.value = lng
            initMap(lat, lng);
        }, function (error) {
            console.error("Error getting location:", error);
            initMap(6.9271, 79.8612);
            pickupLatInput.value = 6.9271
            pickupLngInput.value = 79.8612
            dropLatInput.value = 6.9271
            dropLngInput.value = 79.8612
        });
    } else {
        console.error("Geolocation is not supported by this browser.");
        initMap(6.9271, 79.8612);
        pickupLatInput.value = 6.9271
        pickupLngInput.value = 79.8612
        dropLatInput.value = 6.9271
        dropLngInput.value = 79.8612
    }

</script>