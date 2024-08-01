$(document).ready(function(){
    $('.dropdown-toggle').dropdown()
});

$(document).ready(function() {
    $('#myTable').dataTable();
});

$(function() {
    $('.chosen').chosen();
});

$(".sidebar ul li a").on('click', function(e) {
    // Hapus kelas "active" dari semua elemen li dalam sidebar
    $(".sidebar ul li").removeClass('active');

    // Tambahkan kelas "active" ke li yang berisi link yang ditekan
    $(this).closest("li").addClass('active');
});

$('.open-btn').on('click', function() {
    $('.sidebar').addClass('active');
});

$('.close-btn').on('click', function() {
    $('.sidebar').removeClass('active');
});

