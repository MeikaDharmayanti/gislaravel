<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Rumah Sakit</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
  /* .row:after {
            content: "";
            display: table;
            clear: both;
        } */
    .container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  input[type="text"],
  textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  input[type="submit"]:hover {
    background-color: #45a049;
  }
  #map {
    height: 400px;
  }
</style>
</head>
<body>
<div id="map"></div>
<div class="container">
  <h2>Form Rumah Sakit</h2>
  <form action="/submit" method="post">
    <label for="nama">Nama Rumah Sakit:</label>
    <input type="text" id="nama" name="nama" required>

    <label for="latitude">Latitude:</label>
    <input type="text" id="latitude" name="latitude" required>

    <label for="longitude">Longitude:</label>
    <input type="text" id="longitude" name="longitude" required>

    <label for="alamat">Alamat:</label>
    <textarea id="alamat" name="alamat" required></textarea>

    <input type="submit" value="Simpan">
  </form>
</div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  var map = L.map('map').setView([-8.551, 115.401], 10);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  var hospitalNames = [
    "Rumah Sakit Meika",
    "Rumah Sakit Denpasar",
    "Rumah Sakit Klungkung",
    "Rumah Sakit Karangasem",
    "Rumah Sakit Singaraja"
  ];

  formatContent = function(lat, lng, index, hospitalName) {
    return `
      <div class="wrapper">
        <div class="row">
          <div class="cell merged" style="text-align:center">Marker [ ${index+1} ]</div>
        </div>
        <div class="row">
          <div class="col">Nama Rumah Sakit</div>
          <div class="col2">${hospitalName}</div>
        </div>
        <div class="row">
          <div class="col">Latitude</div>
          <div class="col2">${lat}</div>
        </div>
        <div class="row">
          <div class="col">Longitude</div>
          <div class="col2">${lng}</div>
        </div>
        <div class="row">
          <div class="col">Left click</div>
          <div class="col2">New marker / show popup</div>
        </div>
        <div class="row">
          <div class="col">Right click</div>
          <div class="col2">Delete marker</div>
        </div>
      </div>
    `;
  }

  var markers = [];

  map.on('click', function(e) {
    var randomHospitalName = hospitalNames[Math.floor(Math.random() * hospitalNames.length)];
    var newMarker = L.marker(e.latlng).addTo(map).bindPopup(formatContent(e.latlng.lat, e.latlng.lng, markers.length, randomHospitalName));
    markers.push(newMarker);
  });
</script>
</body>
</html>
