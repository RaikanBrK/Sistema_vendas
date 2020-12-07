# Sistema de Vendas
 Teste Prático de PHP Jr 
 
 ## Instalação
 ### Database
 Vá até [db_sistema_vendas.sql](https://github.com/RaikanBrK/Sistema_vendas/blob/main/database/db_sistema_vendas.sql) e **import** o arquivo para o banco de dados mysql.
 
 ### Repositório
 Clone o repositório [sistema_vendas](https://github.com/RaikanBrK/Sistema_vendas.git).
  
 ## Observações
 Este é um repositório para um teste prático de PHP Jr.
 
 - [x] Sistema de procurar produtos por nome ou referência.
 - [x] Tabela contendo os produtos selecionados.
 - [x] Exibir o valor total da venda dos produtos selecionados.
 - [x] Buscar informações no webservice da ViaCEP.
 - [x] Não cadastrar venda caso não tenha fornecido os dados necessários da entrega e data da venda.
 - [x] Adaptar o banco de dados para receber alterações de preço sem alterar o valor das vendas realizadas.
 - [x] Usando método AJAX para consultar e retornar dados.
 
 ## Considerações
 Apesar de ser um teste, criei o site para ser apto a mudanças e expansões caso desejadas.
 
 Considerei não realizar commit's na branch master. Mas optei por realizar o merge nas branchs, por que ao clonar teriam que mudar a branch o que poderia levar à desavenças.
 
 ## Workbench
 Diagrama da tabela em workbench [wb_er_sistema_vendas](https://github.com/RaikanBrK/Sistema_vendas/blob/main/database/wb_er_sistema_vendas.mwb).
 
 ## Estrutura
 Em [App](https://github.com/RaikanBrK/Sistema_vendas/tree/main/sistema_vendas/App) temos a conexão ao banco de dados, rotas, models para realizar consultas no banco de dados, views para tratar layouts e arquivos de exibição, e controllers para controlar o frond-end e back-end.
 
 Em [public](https://github.com/RaikanBrK/Sistema_vendas/tree/main/sistema_vendas/public) temos tudo que é público para o usuário, por ex: scripts **.js**, styles **.css**, etc...
 
 Em [vendor](https://github.com/RaikanBrK/Sistema_vendas/tree/main/sistema_vendas/vendor) temos arquivos gerados pelo composer e a pasta MF (Miniframework) contendo classes de suporte para auxiliar no desenvolvimento da aplicação.
