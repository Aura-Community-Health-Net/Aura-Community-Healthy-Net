<?php
/**
 * @var array $appointments
 * @var array $doctor
 * @var array $appointments_details
 */
//$provider_nic = $_SESSION['nic'];
//$lat = $location[0]['lat'];


print_r($appointments_details[0]['location']);
$done = 1;
?>

<div class="doctor-appointments_container" xmlns="http://www.w3.org/1999/html">
    <div class="doctor-appointments__left__container">
        <table>
            <tr>
                <th>Profile pic</th>
                <th>Name</th>
                <th>Time Slot</th>
                <th>Mobile No</th>
                <th>Location</th>
            </tr>
        </table>

        <div class="doctor-appointments__left__background">
            <?php foreach ($appointments_details as  $value) { ?>
            <div class="doctor-appointments__left">
                <form>
                    <div class="doctor-appointments__left__data">
                        <img src="<?php echo $value['profile_picture'];?>">
                        <p><?php echo $value['name'];?></p>
                        <p><?php echo $value['from_time']. " - " . $value['to_time'];?></p>
                        <p><?php echo $value['mobile_number'];?></p>
<!--                        <p>--><?php //echo json_decode($value['location'])?><!--</p>-->

                        <?php $appointment_id = $value['appointment_id']?>
                        <button  style="" type="button" data-lat="" data-lng="" class="action-btn action-btn--location location-btn"><i class="fa-solid fa-location-dot"></i></button>
                    </div>
                    <div class="doctor-appointments__buttons">
                            <div class="doctor-appointments__buttons-consulted">
                                <button value="Done" formaction="<?php echo"/doctor-dashboard/appointments-consulted?appointment_id=$appointment_id&id=$done"?>" type="submit" style="background-color: #0002A1;align-items: center">Consulted</button>
                            </div>
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>


    <input name="destination-lat" id="destination-lat" type="hidden" style="">
    <input name="destination-lng" id="destination-lng" type="hidden" style="opacity: 0">
        <div class="doctor-appointments__right">
            <div class="map" id="map" style="height:500px;width: 400px;margin-inline: auto"></div>
        </div>
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
    const destinationLatInput = document.querySelector("#destination-lat")
    const destinationLngInput = document.querySelector("#destination-lng")

    async function initMap(lat, lng) {
        //@ts-ignore
        const {Map: GoogleMap} = await google.maps.importLibrary("maps");
        const {Marker} = await google.maps.importLibrary("marker");
        map = new GoogleMap(document.getElementById("map"), {
            center: {lat: lat, lng: lng},
            zoom: 17,
        });
        const marker1 = new Marker({
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