const produtos = JSON.parse(sessionStorage.getItem('produtos'));
const bodyTable = document.querySelector('#body-table');
const buttonStep1 = document.querySelector('#btn-finalizar');

if (produtos != null) {
	let query = '';
	for (let key in produtos) {
		const produto = produtos[key];
		var preco = produto.preco.replace('.', ',');

		query += `
			<tr class="container-tr">
				<th class="referencia" scope="row">${produto.referencia}</th>
				<td class="nome">${produto.nome}</td>
				<td class="preco">${preco}</td>
				<td>${produto.fornecedores}</td>
			</tr>
		`;
	}

	bodyTable.innerHTML = query;
}

const send = document.querySelector('#btn-finalizar');
send.addEventListener('click', event => {
	event.preventDefault();

	let produtos = JSON.parse(sessionStorage.getItem('produtos'));

	let referencias = {};
	for (let key in produtos) {
		let produto = produtos[key];
		referencias[key] = produto.referencia;
	}

	$.ajax({
		url: '/registrar_produto',
		type: 'GET',
		dataType: 'html',
		data: referencias,
		success: dados => {
			window.location = event.target.href;
		},
		error: erro => {
		}
	});		
})