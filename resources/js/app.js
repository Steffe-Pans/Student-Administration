require('./bootstrap');
$('nav i.fas').addClass('fa-fw mr-1');

$('body').tooltip({
    selector: '[data-toggle="tooltip"]',
    html : true,
}).on('click', '[data-toggle="tooltip"]', function () {
    // hide tooltip when you click on it
    $(this).tooltip('hide');
});
