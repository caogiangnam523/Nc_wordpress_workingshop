

jQuery(document).ready(function($) {
	$(".filter-extras").css("display", "none");
	$(".iso-item").css("visibility", "visible");

	var $container = $(".filter").next('.iso-container'),
		$items = $(".iso-item", $container),
		selector = null;
		
	$(".filter-categories a").each(function(){
		$(this).on('click', function(e) {
			e.preventDefault();
			selector = $(this).attr('data-filter');
			$items.css("display", "none");
			$items.filter(selector).css("display", "block");
		});
	});

});