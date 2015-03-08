$(function() {
	$(".credentials").on("click", "h3", function(){
		console.log('click');
		$(this).parent('div').toggleClass('expand');

	});
});