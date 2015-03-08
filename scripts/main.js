$(function() {
	$(".credentials").on("click", "h3", function(){
		console.log('click');
		$(this).parent('div').find('ul').toggleClass('expand');

	});
});