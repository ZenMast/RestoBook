/*
function selectedCountry(){
	var e =  document.getElementById('filterform-country');
	$.get('index.php?r=site/filterselected&getcity=1&country=' + e.options[e.selectedIndex].value, function(data) {
		$("#filterform-city").html(data);
	});
	$.get('index.php?r=site/filterselected&getname=1&country=' + e.options[e.selectedIndex].value, function(data) {
		$("#filterform-restaurant").html(data);
	});	
}
function selectedCity(){
	var e =  document.getElementById('filterform-city');
	$.get('index.php?r=site/filterselected&getname=1city=' + e.options[e.selectedIndex].value, function(data) {
		$("#filterform-restaurant").html(data);
	});
	
}

function reloadGrid(){
	$( "#filterForm").submit();
}
*/