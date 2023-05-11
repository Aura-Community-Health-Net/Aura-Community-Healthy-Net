<?php
/**
 * @var $doctor ;
 * @var $time_slot ;
 * @var $feedback ;
 * @var $doctor_qualifications ;
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
                            <p><?php foreach ($doctor_qualifications as $value) {
                                    echo $value['qualifications'].'<br>';
                                } ?></p>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="/consumer-dashboard/services/doctor/profile-timeSlot?provider_nic=<?php echo $provider_nic; ?>"
                          method="POST">
                        <div class="consumer-dashboard-doctor-profile__top__right">
                            <h4>Available Time-Slots</h4>
                            <div class="consumer-dashboard-doctor-profile__top__right__dropdown">
                                <input type="date" id="time-slot-date" value="" onchange="timeSlotDate(this.value)">
                            </div>
                            <div class="consumer-dashboard-doctor-profile__top__right__timeslot">
                                <table id="doctor-available-slot">
                                    <thead>
                                    <th>Date</th>
                                    <th>From Time</th>
                                    <th>To Time</th>
                                    </thead>
                                    <?php foreach ($time_slot as $value) { ?>
                                        <tr>
                                            <td hidden><?php echo date('l', strtotime($value['date'])); ?></td>
                                            <td><?php echo $value['date']; ?></td>
                                            <td><?php echo $value['from_time'] ?></td>
                                            <td><?php echo $value['to_time'] ?></td>
                                            <td><?php echo " "; ?></td>
                                            <td><input type="radio" value="<?php echo $value['slot_number']; ?>"
                                                       name="available-time-slot">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <input name="destination-lat" id="destination-lat" style="opacity: 0">
                            <input name="destination-lng" id="destination-lng" style="opacity: 0">
                            <div class="consumer-dashboard-doctor-profile__top__right__location">
                                <p><b>Add Location</b></p>
                                <div>
                                    <input type="text" placeholder="Enter the address" class="doctor-input-location" id="address">
                                    <button onclick="findAddress()" type="button" id="doctor-location-search">Search</button>
                                </div>

                                <div>
                                    <select name="location_results" id="location_results" class="location_results"></select>
                                </div>
                                <div class="map" id="map" style="height:400px;width: 80%;margin-inline: auto">
                                </div>
                            </div>
                            <p class="consumer-dashboard-doctor-profile__top__right_p">You will need to pay Rs. 1500.00
                                for an appointment</p>
                            <button name="doctor-pay-btn" class="doctor-payment-btn">Continue to Pay</button>
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
                        <?php if(!$feedback){
                            echo '<h2>No Feedback Yet</h2>';
                        }else{ ?>
                        <?php foreach ($feedback as $value) { ?>
                            <div class="consumer-dashboard-doctor-profile__bottom__left__data">
                                <div style="display: flex;flex-direction: row;gap: 1rem;justify-content: center;align-items: center">
                                    <img src="<?php echo $value['profile_picture'] ?>" alt="">
                                    <h3><b><?php echo $value['name'] ?></b></h3>
                                    <p><?php echo $value['date_time'] ?></p>
                                </div>
                                <p><?php echo $value['text'] ?></p>
                            </div>
                        <?php } } ?>
                    </div>
                </td>
                <td>
                    <div class="consumer-dashboard-doctor-profile__bottom__right">
                        <h3>Give your Feedback</h3>
                        <form action="/consumer-dashboard/services/doctor/profile-feedback?provider_nic=<?php echo $_GET['provider_nic']; ?>"
                              method="POST">
                            <textarea name="doctor-feedback" class="doctor-feedback"> </textarea>
                            <button name="doctor-feedback-btn">Submit</button>
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

<script>let map, marker1;
    const destinationLatInput = document.querySelector("#destination-lat")
    const destinationLngInput = document.querySelector("#destination-lng")
    const address = document.querySelector("#address");
    const locationResultsInput = document.querySelector("#location_results")
    let results = []


    locationResultsInput.addEventListener('change', () => {
        console.log(locationResultsInput.value)
        const selectedLocation = results.find((i) => i.place_id === Number(locationResultsInput.value))
        console.log(selectedLocation)
        setMarkerAndPan({
            lat: Number(selectedLocation.lat),
            lng: Number(selectedLocation.lon)
        })
    })

        async function findAddress() {
            try{
                const response = await fetch("https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + address.value)
                const locationResults = await response.json()
                results = locationResults
                if(results.length === 1) {
                    setMarkerAndPan({
                        lat: Number(results[0].lat),
                        lng: Number(results[0].lon)
                    })
                }
                let options = locationResults.map(lR => {
                    return "<option value='"+lR.place_id +"' >" + lR.display_name + "</option>"
                }).join("")
                locationResultsInput.innerHTML = options
            } catch (e) {
                console.log(e)
            }

        }



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
            draggable: true, title: "destination", icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
            }
        })

        marker1.addListener('dragend', () => {
            const position = marker1.getPosition()
            const lat = position.lat()
            const lng = position.lng()
            destinationLatInput.value = lat
            destinationLngInput.value = lng
        })


    }

    function setMarkerAndPan(selectedLocation) {
        map.panTo(selectedLocation)
        marker1.setPosition(selectedLocation)
        destinationLatInput.value = selectedLocation.lat
        destinationLngInput.value = selectedLocation.lng
    }


    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            console.log("Latitude: " + lat + ", Longitude: " + lng);
            destinationLatInput.value = lat
            destinationLngInput.value = lng
            initMap(lat, lng);
        }, function (error) {
            console.error("Error getting location:", error);
            initMap(6.9271, 79.8612);
            destinationLatInput.value = 6.9271
            destinationLngInput.value = 79.8612
        });
    } else {
        console.error("Geolocation is not supported by this browser.");
        initMap(6.9271, 79.8612);
        destinationLatInput.value = 6.9271
        destinationLngInput.value = 79.8612
    }

</script>