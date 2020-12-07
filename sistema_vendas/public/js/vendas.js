$('body').on('click', '#itens ul li .header', function(event) {
	var element = $(event.target).closest('li');
	var desc = element.find('.desc');
	var i = element.find('.down');

	if (i.hasClass('show')) {
		i.removeClass('rotate');	
		i.removeClass('show');

		i.addClass('rotate-reverse');

	} else {
		i.addClass('show');

		i.removeClass('rotate-reverse');
		i.addClass('rotate');		
	}

	desc.slideToggle(600);
});