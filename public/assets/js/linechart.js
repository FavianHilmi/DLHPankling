document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('airQualityChart').getContext('2d');

    // Extract data from the DOM
    const labels = JSON.parse(document.getElementById('chart-data').dataset.labels);
    const PM10 = JSON.parse(document.getElementById('chart-data').dataset.pm10);
    const PM2_5 = JSON.parse(document.getElementById('chart-data').dataset.pm25);

    // Initialize Chart.js with the data
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels, // Use the dates from the labels
            datasets: [
                {
                    label: 'PM10',
                    data: PM10,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                },
                {
                    label: 'PM2.5',
                    data: PM2_5,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Prediksi Kualitas Udara',
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal',
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'Konsentrasi',
                    },
                    beginAtZero: true,
                },
            },
        },
    });
});
