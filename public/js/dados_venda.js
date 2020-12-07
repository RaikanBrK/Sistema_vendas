const cep = document.querySelector('#cep');
var total = 0;
const produtos = JSON.parse(sessionStorage.getItem('produtos'));

cep.addEventListener('keypress', event => {
	let element = event.target;
	let text = element.value;

	if (text.length == 5) {
		element.value += '-';
	}

	if ((event.keyCode < 48 || event.keyCode > 57) || text.length > 8) {
		event.preventDefault();
	}

	if (text.length == 8) {
		getDadosPorCep(text + event.key);
	}
});

cep.addEventListener('blur', event => {
	getDadosPorCep(event.target.value);
})



function getDadosPorCep(cep) {
	var url = `https://viacep.com.br/ws/${cep}/json/`;

	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		success: dados => {
			$('#uf').val(dados.uf);
			$('#bairro').val(dados.bairro);
			$('#cidade').val(dados.localidade);
			$('#rua').val(dados.logradouro);
		},
		error: erro => {
		}
	})
}