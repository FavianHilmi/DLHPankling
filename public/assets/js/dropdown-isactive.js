// Menggunakan jQuery
$(document).ready(function() {
    // Menambahkan event click ke setiap link menu
    $('.sidebar .nav li').on('click', function() {
        // Menghapus kelas 'active' dari semua item menu
        $('.sidebar .nav li').removeClass('active');

        // Menambahkan kelas 'active' pada item menu yang diklik
        $(this).addClass('active');
    });
});
