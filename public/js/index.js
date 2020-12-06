const ajax = new XMLHttpRequest();
const bodyTable = document.querySelector('#body-table');

ajax.onreadystatechange = function() {
	if (ajax.readyState == 4 && ajax.status == 200) {
		try {
			var response = JSON.parse(ajax.responseText)
		} catch(e) {
			console.log(e);
		}

		let query = '';
		for (let key in response) {
			const produto = response[key];

			query += `
				<tr class="container-tr">
					<th scope="row">${produto.referencia}</th>
					<td>${produto.nome}</td>
					<td>${produto.preco}</td>
					<td>${produto.fornecedores}</td>
					<td>
						<button type="button" class="btn btn-warning text-white">Adicionar</button>
					</td>
				</tr>
			`;
		}

		bodyTable.innerHTML = query;

	} else if(ajax.readyState == 4 && ajax.status == 404) {
		console.log('Erro 404');
	}
}

ajax.open("GET", '/get_produtos');
ajax.send();