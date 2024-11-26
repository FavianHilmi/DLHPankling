window.onload = function() {
    // Data yang dikirim dari controller Laravel
    const tpmData = @json($TPM);  // Data TPM
    const pm10Data = @json($PM10);  // Data PM10
    const pm25Data = @json($PM2_5);  // Data PM2.5
    const labels = @json($labels);  // Labels untuk tanggal

    // Data untuk grafik
    const data = {
      labels: labels,
      datasets: [{
        label: 'TPM',
        data: tpmData,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }, {
        label: 'PM10',
        data: pm10Data,
        fill: false,
        borderColor: 'rgb(255, 99, 132)',
        tension: 0.1
      }, {
        label: 'PM2.5',
        data: pm25Data,
        fill: false,
        borderColor: 'rgb(153, 102, 255)',
        tension: 0.1
      }]
    };

    // Konfigurasi chart
    const config = {
      type: 'line',
      data: data,
    };

    // Mendapatkan konteks canvas dan membuat grafik
    const ctx = document.getElementById('lineChartKualitasUdara').getContext('2d');
    new Chart(ctx, config);
  };
