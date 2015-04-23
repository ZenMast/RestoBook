function selectedCountry(){
	var e =  document.getElementById('filterform-country');
	$.get('index.php?r=site/filterselected&country=' + e.options[e.selectedIndex].value, function(data) {
		$("#filterform-city").html(data);
	});
	
}

