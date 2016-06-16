$(function () {
	
    if (!$('#donut-chart').length) { return false; }

	donut ();

	$(window).resize (target_admin.debounce (donut, 325));

});

function donut () {
	$('#donut-chart').empty ();

	Morris.Donut({
        element: 'donut-chart',
        data: [
            {label: 'Vive', value: 60 },
            {label: 'Subastas', value: 25 },
            {label: 'Particulares', value: 15 }
        ],
        colors: target_admin.layoutColors,
        hideHover: true,
        formatter: function (y) { return y + "%" }
    });
}