const cartShop = document.querySelector('#icon-shop');
const menu = document.querySelector('#menu');
const help = document.querySelector('#help-div');

const groupItens = document.querySelector('#group-itens');

cartShop.addEventListener('mouseenter', () => {
	help.classList.remove('d-none');
	showCart();
})

menu.addEventListener('mouseleave', () => {
	help.classList.add('d-none');
	hideCart();
})

function showCart() {
	let notification = document.querySelector('#notification');

	if (notification) {
		notification.remove();
	}

	if (sessionStorage.getItem('produtos')) {
		const produtos = JSON.parse(sessionStorage.getItem('produtos'));

		if (produtos.length > 0) {
			groupItens.innerHTML = '';

			let more = 0;
			for (let key in produtos) {

				if (key < 3) {
					const produto = produtos[key];
					var preco = produto.preco.replace('.', ',');

					const li = document.createElement('li');
					li.innerHTML = `
						<span class="produto">${produto.nome}</span>
						<span class="preco">R$ ${preco}</span>
					`;

					groupItens.appendChild(li);
				} else {
					more++;
				}
			}
			calTotal(produtos);

			if (more != 0) {
				const btnMore = document.createElement('div');
				btnMore.classList = 'btn-more';
				btnMore.innerHTML = `
					<a href="/registrar_venda" id="more-item" class="order-3">
						<i class="fas fa-sort-down icon-more-down"></i>
						Mais ${more}
					</a>
				`;

				groupItens.appendChild(btnMore);
			}

			if (produtos.length > 0 ) {
				const finalizarVenda = document.createElement('a');
				finalizarVenda.href = "/registrar_venda";
				finalizarVenda.classList = "btn btn-block btn-primary mt-3 btn-venda";
				finalizarVenda.innerHTML = "Finalizar Venda";
				groupItens.appendChild(finalizarVenda);
			}

		}
	} else {
		groupItens.innerHTML = '<em class="d-block text-center text-info">Nenhum produto adicionado</em>';
	}

}

function hideCart() {
	groupItens.innerHTML = '';
}

function calTotal(produtos) {
	var total = 0;

	for (let key in produtos) {
		const produto = produtos[key];
		var preco = produto.preco.replace(',', '.');

		total += parseFloat(preco);
	}

	total = total.toFixed(2).toString().replace('.', ',');

	const li = document.createElement('li');
	li.style.border = '0';
	li.classList = 'my-3';
	li.innerHTML = `
		<span class="produto">Total</span>
		<span class="preco">R$ ${total}</span>
	`;
	groupItens.appendChild(li);
}