# WebDevBr Cart

[![Build Status](https://travis-ci.org/WebDevBr/cart.svg?branch=master)](https://travis-ci.org/WebDevBr/cart)

Este componente deverá disponibilizar uma biblioteca que facilite a criação de carrinhos de compra nos mais diversos Frameworks.

## Como instalar

Você não deve usar isso em produção, ainda estamos desenvolvendo, mas para ver como está você precisa fazer duas coisas

### 1. Adicionar o pacote ao composer

Rode o comando `composer require "webdevbr/cart:dev-master"`

Não esqueça de substituir `composer` por `php composer.phar` caso tenha baixado o arquivo localmente.

### 2. Instanciar

Para instanciar:

	use WebDevBr\Cart\ProductManager;
	use WebDevBr\Cart\Cart;

	$cart = new WebDevBr\Cart\Cart(new ProductManager);

Prontinho, agora é só usar.

## Como usar

O carrinho tem 4 recursos atualmente, ainda vamos incrementá-lo veja:

 - add(Array $product) - Adiciona um novo produto ao carrinho
 - delete(int $id) - Remove um produto do carrinho com base no id.
 - all() - Lista todos os produtos no carrinho
 - order(ORDER_BY_VALUE, bool false) - Ordena os produtos, atualmente só funciona por valor, assim que implementado, poderemos trocar o `ORDER_BY_VALUE` para definir o que faremos, o segundo parametro pode ser true ou false e indica que queremos inverter a ordenação (por maior valor ou por menor valor), o padrão é false.

Veja alguns exemplos:

	$cart->add($product);
	$cart->delete($id);
	$cart->all();
	$cart->add(ORDER_BY_VALUE);

## Como ajudar a desenvolver

Você vai precisar conhecer Git, se não conhece aqui tem um [curso gratuito](http://www.webdevbr.com.br/gratis/git-iniciante.html) para te auxiliar.

Faça um fork do projeto e mande suas alterações via pull request.

Não esqueça de rodar um `composer install` depois de baixar este projeto.

### Quais são as tarefas?

Precisamos:

 - Validar as entradas de dados
 - Colocar mais opções de ordenação (por título, por exemplo)
 - Ideias!!!

Na dúvida, mande uma pergunta no [Issues](https://github.com/WebDevBr/cart/issues) ou converse comigo se cadastrando no [WebDevBr](http://www.webdevbr.com.br/).

## Tradução deste documento

Se alguém quiser, pode traduzir este texto para outros idiomas, é só mandar um pull request.