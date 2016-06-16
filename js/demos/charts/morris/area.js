$(function () {

	if (!$('#area-chart').length) { return false; }
	
	area ();	

	$(window).resize (target_admin.debounce (area, 250));

});

function area () {
	$('#area-chart').empty ();

	Morris.Area ({
		element: 'area-chart',
		data: [
			{period: '2012', Carlos: 34, Adrian: 22, Pedro: 41},

			{period: '2013', Carlos: 10, Adrian: 19, Pedro: 22},

			{period: '2014', Carlos: 48, Adrian: 37, Pedro: 58},

			{period: '2015', Carlos: 45, Adrian: 46, Pedro: 50}
		],
		xkey: 'period',
		ykeys: ['Carlos', 'Adrian', 'Pedro'],
		labels: ['Carlos', 'Adrian', 'Pedro'],
		pointSize: 3,
		hideHover: 'auto',
		lineColors: target_admin.layoutColors
	});
}