// Inisialisasi peta
var map = L.map('map').setView([-7.250445, 112.768845], 13);

// Tambahkan tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Ambil data dari global variable
if (typeof window.uji_air_eksternals !== 'undefined' && typeof window.uji_air_internals !== 'undefined') {
    // Gabungkan data
    var allData = [...window.uji_air_eksternals, ...window.uji_air_internals];

    // Tambahkan marker
    allData.forEach(function (coord) {
        var popupContent = `
            <b>Lokasi:</b> ${coord.lokasi ?? 'Tidak diketahui'}<br>
            <b>Pelepasan:</b> ${coord.pelepasan ?? 'N/A'}<br>
            <b>Pemasangan:</b> ${coord.pemasangan ?? 'N/A'}
        `;
        L.marker([coord.latitude, coord.longitude])
            .addTo(map)
            .bindPopup(popupContent)
            .bindTooltip(`Klik untuk info: ${coord.lokasi ?? 'Lokasi tidak diketahui'}`);
    });
} else {
    console.error('Data passives atau uji_air_internals tidak ditemukan!');
}
