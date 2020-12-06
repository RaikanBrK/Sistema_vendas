const search = document.querySelector('#search');

function getProdutos(url) {
	const ajax = new XMLHttpRequest();
	const bodyTable = document.querySelector('#body-table');

	// Ajax com javascript puro.
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
						<th class="referencia" scope="row">${produto.referencia}</th>
						<td class="nome">${produto.nome}</td>
						<td class="preco">${preco}</td>
						<td>${produto.fornecedores}</td>
						<td>
							<button onclick="add_venda()" type="button" class="btn btn-warning text-white btn-add">Adicionar</button>
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

function add_venda() {
	let element = event.target;
	let tr = $(element.closest('.container-tr'));

	let elemNome = tr.find('.nome');
	let elemPreco = tr.find('.preco');
	let elemReferencia = tr.find('.referencia');

	tr.find('.btn-add').prop("disabled", true);
	let sessionProdutos = JSON.parse(sessionStorage.getItem('produtos'));


	var newProduto = [
		{
			nome: elemNome.html(),
			preco: elemPreco.html(),
			referencia: elemReferencia.html()
		}
	]

	if (sessionProdutos != null) {

		for (let key in sessionProdutos) {
			let produto = sessionProdutos[key];

			if (produto.referencia == newProduto[0].referencia) {
				return false;
			}
		}

		sessionProdutos.push(newProduto[0]);

		var produtos = sessionProdutos;
	} else {
		var produtos = newProduto;
	}

	if (produtos != undefined) {
		$('#icon-shop').html('<div id="notification"></div>');

		sessionStorage.setItem('produtos', JSON.stringify(produtos));
	}
}