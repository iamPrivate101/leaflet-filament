<main>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7x3lw5Q1d5lz5Bz5I6p5EX6g9ca3Q59iUsQ5Hl+dXhL5SH/lT2JWgt8sQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        #map {
            height: 600px;
            /* Set a height for the map */
            width: 100%;
            /* Make the map take full width */
        }
    </style>

    <div class="row">
        <div class="col-8">
            <div id="map"></div>
        </div>
        <div class="col-4">
            <h2>District</h2>
            <p id="district">Kathmandu</p>
            <h2>Festival</h2>
            <p id="festival">No festival data</p>
        </div>
    </div>

    <script src="{{ asset('provinces/province_1.js')}}"></script>
    <script src="{{ asset('provinces/province_2.js')}}"></script>
    <script src="{{ asset('provinces/province_3.js')}}"></script>
    <script src="{{ asset('provinces/province_4.js')}}"></script>
    <script src="{{ asset('provinces/province_5.js')}}"></script>
    <script src="{{ asset('provinces/province_6.js')}}"></script>
    <script src="{{ asset('provinces/province_7.js')}}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            //initializing the map and the setview (latitude, longitude, zoom)
            let map = L.map("map").setView([28.3949, 84.124], 7);
    
            //tile layer, can use different tile layer
            let osm = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution:
                    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            });
            osm.addTo(map);
    
            let clickedDistrict = '';
    
            // Function to handle the click event and extract district data
            function handleFeatureClick(feature, layer) {
            layer.bindPopup('<b>' + feature.properties.DISTRICT + '</b>');
            layer.on('click', function (e) {
                clickedDistrict = feature.properties.DISTRICT;
                console.log('Clicked district:', clickedDistrict);
                document.getElementById('district').textContent = clickedDistrict;
                
                // AJAX request to fetch festival data
                $.ajax({
                    url: '/festival/' + clickedDistrict,
                    method: 'GET',
                    success: function (response) {
                        if (response.festivals) {
                            let festivals = response.festivals.map(festival => festival.event_name).join(', ');
                            document.getElementById('festival').textContent = festivals;
                        } else {
                            document.getElementById('festival').textContent = response.festival;
                        }
                    },
                    error: function (error) {
                        console.error('Error fetching festival data:', error);
                        document.getElementById('festival').textContent = 'Error fetching festival data';
                    }
                });
            });
        }
    
            //GEOJSON
            let provinceOneData = L.geoJson(provinceOneJson, {
                onEachFeature: handleFeatureClick
            }).addTo(map);
    
            let provinceTwoData = L.geoJson(provinceTwoJson, {
                onEachFeature: handleFeatureClick
            }).addTo(map);
    
            let provinceThreeData = L.geoJson(provinceThreeJson, {
                onEachFeature: handleFeatureClick
            }).addTo(map);
    
            let provinceFourData = L.geoJson(provinceFourJson, {
                onEachFeature: handleFeatureClick
            }).addTo(map);
    
            let provinceFiveData = L.geoJson(provinceFiveJson, {
                onEachFeature: handleFeatureClick
            }).addTo(map);
    
            let provinceSixData = L.geoJson(provinceSixJson, {
                onEachFeature: handleFeatureClick
            }).addTo(map);
    
            let provinceSevenData = L.geoJson(provinceSevenJson, {
                onEachFeature: handleFeatureClick
            }).addTo(map);
    
            //Layer Controller
            var baseMaps = {
                OSM: osm,
            };
    
            var overlayMaps = {
                "Province 1": provinceOneData,
                "Province 2": provinceTwoData,
                "Province 3": provinceThreeData,
                "Province 4": provinceFourData,
                "Province 5": provinceFiveData,
                "Province 6": provinceSixData,
                "Province 7": provinceSevenData,
            };
    
            var layerControl = L.control
                .layers(baseMaps, overlayMaps, { collapsed: true, sortLayers: true })
                .addTo(map);
        });
    </script>




</main>