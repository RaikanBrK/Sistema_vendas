window.onload = function () {
	$('body').prepend(`
		<div class='mensagem'>
			<span class='text-center d-block text-white'>${msg}</span>
		</div>`
	);

	setTimeout(() => {
		$('.mensagem').slideUp('slow');
	}, 3000)
} 