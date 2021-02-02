$(document).ready(function(){
	$('.list-view').addClass("active");
	$('#grid_view').hide();

	$('#list-btn').click(function(event){
	    $('.grid-view').removeClass("active");
	    $('.list-view').addClass("active");
	    $('#grid_view').hide();
	    $('#list_view').show();
	});

	$('#grid-btn').click(function(event){
    	$('.grid-view').addClass("active");
		$('.list-view').removeClass("active");
    	$('#grid_view').show();
    	$('#list_view').hide();
	});

});