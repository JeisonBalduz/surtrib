var mapa = L.map("mapa").setView([10.09180731, -68.0929854], 14)
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png?", {}).addTo(mapa)

var marcador = L.marker([10.0918073, -68.0929854],{draggable: true}).addTo(mapa)
marcador.bindPopup("Referencia")

marcador.on('drag', function(e){
    document.getElementById('longitud').value = marcador.getLatLng().lat;
    document.getElementById('latitud').value = marcador.getLatLng().lng;
    mapa.setView(e.target.getLatLng());
});

const circulo = L.circle([10.0918073, -68.0929854], {
    radius: 1000,
    color: "green"
}).addTo(mapa)
circulo.bindPopup("Casco Central")

console.log(mapa)
console.log(marcador)
console.log(circulo)

  