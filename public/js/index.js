const search = document.querySelector('#search');

function getProdutos(url) {
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
				var preco = produto.preco.replace('.', ',');

				query += `
					<tr class="container-tr">
						<th scope="row">${produto.referencia}</th>
						<td>${produto.nome}</td>
						<td>${preco}</td>
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

	ajax.open("GET", url);
	ajax.send();
}

getProdutos('/get_produtos');

search.addEventListener('keyup', () => {
	getProdutos('/get_produto?search='+search.value);
});