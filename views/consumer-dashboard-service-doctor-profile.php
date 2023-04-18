<?php
/**
 * @var $doctor;
 * @var $time_slot;
 * @var $feedback;
 * @var $doctor_qualifications;
 */

$provider_nic = $_GET['provider_nic'];
//print_r($doctor_qualifications);die();

?>
<div class="consumer-dashboard-doctor-profile">
    <div class="consumer-dashboard-doctor-profile__top">
        <table>
            <tr>
                <td>
                    <div class="consumer-dashboard-doctor-profile__top__left">
                        <img src="<?php echo $doctor['profile_picture']; ?>">
                        <div class="consumer-dashboard-doctor-profile__top__left__data">
                            <h3><b><?php echo $doctor['name']; ?></b></h3><br>
                            <h4><?php echo $doctor['field_of_study']; ?></h4>
                            <h4>SLMC Reg.No: <?php echo $doctor['slmc_reg_no']; ?></h4>
                            <p><?php echo $doctor_qualifications[0]['qualifications'] ." , ". $doctor_qualifications[1]['qualifications']; ?></p>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="/consumer-dashboard/services/doctor/profile-timeSlot?provider_nic=<?php echo $provider_nic;?>" method="POST">
                        <div class="consumer-dashboard-doctor-profile__top__right">
                            <h4>Available Time-Slots</h4>
                            <div class="consumer-dashboard-doctor-profile__top__right__dropdown">
                                <input type="date" id="time-slot-date" value="" onchange="timeSlotDate(this.value)">
                            </div>
                            <div class="consumer-dashboard-doctor-profile__top__right__timeslot">
                                <table id="doctor-available-slot">
                                    <?php foreach ($time_slot as  $value) { ?>
                                        <tr>
                                            <td hidden><?php echo date('l', strtotime($value['date']));?></td>
                                            <td><?php echo $value['date'];?></td>
                                            <td><?php echo $value['from_time']?></td>
                                            <td><?php echo $value['to_time']?></td>
                                            <td><?php echo " ";?></td>
                                            <td><input type="radio" value="<?php echo $value['slot_number'];?>" name="available-time-slot">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="consumer-dashboard-doctor-profile__top__right__location">
                                <p>Add Location</p>
                                <div class="map" id="map" style="height:100%;width: 80%;margin-inline: auto">
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                    okrninfiiiiiiiiiiiiiiiiiiiiiii<br>
                                </div>
                            </div>
                            <p class="consumer-dashboard-doctor-profile__top__right_p">You will need to pay Rs. 1500.00 for an appointment</p>
                                <button name="doctor-pay-btn">Continue to Pay</button>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>
    <div class="consumer-dashboard-doctor-profile__bottom">
        <table>
            <tr>
                <td>
                    <div class="consumer-dashboard-doctor-profile__bottom__left">
                        <?php foreach ($feedback as  $value) { ?>
                        <div class="consumer-dashboard-doctor-profile__bottom__left__data">
                            <img src="<?php echo $value['profile_picture']?>">
                            <h3><b><?php echo $value['name']?></b></h3>
                            <h4><?php echo $value['date_time']?></h4>
                            <p><?php echo $value['text']?></p>
                        </div>
                        <?php } ?>
                    </div>
                </td>
                <td>
                    <div class="consumer-dashboard-doctor-profile__bottom__right">
                        <h3>Give your Feedback</h3>
                        <form action="/consumer-dashboard/services/doctor/profile-feedback?provider_nic=<?php echo $_GET['provider_nic']; ?>" method="POST">
                            <textarea name="doctor-feedback" class="doctor-feedback"> </textarea>
                            <button name="doctor-feedback-btn" >Submit</button>
                        </form>
                    </div>
                </td>
            </tr>
        </table>

    </div>
    <script src="/assets/js/pages/timeslots.js"></script>
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

<script>let map;
    const pickupLatInput = document.querySelector("#pickup-lat")
    const pickupLngInput = document.querySelector("#pickup-lng")
    const dropLatInput = document.querySelector("#drop-lat")
    const dropLngInput = document.querySelector("#drop-lng")

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
        const marker1 = new Marker({
            map: map,
            position: {lat: lat, lng: lng},
            draggable: true, title: "pickup", icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
            }
        })
        const marker2 = new Marker({
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
            // let request = {
            //     origin: marker1.getPosition(),
            //     destination: marker2.getPosition(),
            //     travelMode: 'DRIVING'
            // };
            // directionsService.route(request, function (result, status) {
            //     console.log(result,status)
            //     if (status === 'OK') {
            //         // Display the route on the map
            //         // directionsRenderer.setDirections(result);
            //         const points = [];
            //         const legs = result.routes[0].legs;
            //         for (let i = 0; i < legs.length; i++) {
            //             const steps = legs[i].steps;
            //             for (let j = 0; j < steps.length; j++) {
            //                 const nextSegment = steps[j].path;
            //                 for (let k = 0; k < nextSegment.length; k++) {
            //                     points.push(nextSegment[k]);
            //                 }
            //             }
            //         }
            //         // Create the polyline.
            //         const polyline = new google.maps.Polyline({
            //             path: points,
            //             geodesic: true,
            //             strokeColor: '#FF0000',
            //             strokeOpacity: 1.0,
            //             strokeWeight: 2
            //         });
            //         // Set the polyline on the map.
            //         polyline.setMap(map);
            //     }
            // });
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
            // let request = {
            //     origin: marker1.getPosition(),
            //     destination: marker2.getPosition(),
            //     travelMode: 'DRIVING'
            // };
            // directionsService.route(request, function (result, status) {
            //     console.log(result,status)
            //     if (status === 'OK') {
            //         // Display the route on the map
            //         //
            //         const points = [];
            //         const legs = result.routes[0].legs;
            //         for (let i = 0; i < legs.length; i++) {
            //             const steps = legs[i].steps;
            //             for (let j = 0; j < steps.length; j++) {
            //                 const nextSegment = steps[j].path;
            //                 for (let k = 0; k < nextSegment.length; k++) {
            //                     points.push(nextSegment[k]);
            //                 }
            //             }
            //         }
            //         // Create the polyline.
            //         const polyline = new google.maps.Polyline({
            //             path: points,
            //             geodesic: true,
            //             strokeColor: '#FF0000',
            //             strokeOpacity: 1.0,
            //             strokeWeight: 2
            //         });
            //         // Set the polyline on the map.
            //         polyline.setMap(map);
            //     }
            // });

        })


    }


    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            console.log("Latitude: " + lat + ", Longitude: " + lng);
            pickupLatInput.value=lat
            pickupLngInput.value=lng
            dropLatInput.value=lat
            dropLngInput.value=lng
            initMap(lat, lng);
        }, function (error) {
            console.error("Error getting location:", error);
            initMap(6.9271, 79.8612);
            pickupLatInput.value=6.9271
            pickupLngInput.value=79.8612
            dropLatInput.value=6.9271
            dropLngInput.value=79.8612
        });
    } else {
        console.error("Geolocation is not supported by this browser.");
        initMap(6.9271, 79.8612);
        pickupLatInput.value=6.9271
        pickupLngInput.value=79.8612
        dropLatInput.value=6.9271
        dropLngInput.value=79.8612
    }

</script>
