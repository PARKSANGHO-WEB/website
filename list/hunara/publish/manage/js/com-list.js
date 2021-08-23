
$( function() {
	var availableTags = [
		"비엔시스템",
		"비엔시스템1",
		"비엔시스템2",
		"비엔시스템3",
		"비엔시스템4",
		"비엔시스템5"
	];
	$( "#tags" ).autocomplete({
		source: availableTags
	});
});