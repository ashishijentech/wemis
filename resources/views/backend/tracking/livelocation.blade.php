<!DOCTYPE html>
<html>
<head>
    <title>Live GPS Tracking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map { height: 400px; width: 100%; }
    </style>
</head>
<body>

    <h2>Live Location Tracking</h2>
    <div id="map" style="height:100vh"></div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
   <script>
    var map = L.map('map').setView([20.5937, 78.9629], 5); // India center
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © OpenStreetMap contributors'
    }).addTo(map);

    let marker = null;
    let lastLatLng = null;
    let animationFrame = null;
    const imei = "{{ $imei }}";

    function animateMarker(from, to, duration = 1000) {
        const startTime = performance.now();

        function animate(time) {
            const elapsed = time - startTime;
            const t = Math.min(elapsed / duration, 1); // progress from 0 to 1

            const lat = from.lat + (to.lat - from.lat) * t;
            const lng = from.lng + (to.lng - from.lng) * t;

            marker.setLatLng([lat, lng]);

            if (t < 1) {
                animationFrame = requestAnimationFrame(animate);
            }
        }

        cancelAnimationFrame(animationFrame);
        animationFrame = requestAnimationFrame(animate);
    }

    function fetchLocation() {
        fetch(`/device/location/${imei}`)
            .then(res => res.json())
            .then(data => {
                if (data.latitude && data.longitude) {
                    const newLatLng = L.latLng(data.latitude, data.longitude);

                    if (!marker) {
                        marker = L.marker(newLatLng).addTo(map).bindPopup("Live Location").openPopup();
                        map.setView(newLatLng, 15);
                        lastLatLng = newLatLng;
                    } else {
                        animateMarker(lastLatLng, newLatLng, 1000); // 1s animation
                        lastLatLng = newLatLng;
                    }
                }
            })
            .catch(err => console.error('Location fetch failed:', err));
    }

    setInterval(fetchLocation, 5000);
    fetchLocation();
</script>


</body>
</html>
