# CakePHPBrasil Cart

Este componente deverá disponibilizar uma biblioteca para carrinho de compras e será desenvolvido pela comunidade CakePHP Brasil.

A ideia é que, em um futuro, ele possa ser adaptado para outros frameworks ou projetos que não o CakePHP 3.

## Como instalar

Você não deve usar isso em produção, ainda estamos desenvolvendo, mas para ver como está você precisa fazer duas coisas

### 1. Adicionar o pacote ao composer

Rode o comando `composer require "cakephp-brasil/cart:dev-master"`

Não esqueça de substituir `composer` por `php composer.phar` caso tenha baixado o arquivo localmente.

Para isso adicione o pacote `cakephp-brasil/cart` ao require do *composer.json*.

    "require": {
        "cakephp-brasil/cart": "dev-master"
    },

Não remove os pacotes que você já tiver, apenas adicione este novo, fique atento as virgulas!

### 2. Configure

Vá até o arquivo *config/bootstrap.php* do CakePHP 3 e adicione estas linhas no final:

	$session = new Cake\Network\Session;
	$adapter = new CakePhpBrasil\Cart\Adapter\Cake3Session($session);
	CakePhpBrasil\Cart\Cart::configure($adapter);

A ideia é que no futuro você possa trocar o `$adapter` por outro, por exemplo, para banco de dados em vez do `Session`, ou outras sugestões que a comunidade ainda poderá dar.

Prontinho, agora é só usar.

## Como usar

O carrinho tem 4 recursos atualmente, ainda vamos incrementá-lo veja:

 - add(Array $product) - Adiciona um novo produto ao carrinho
 - delete(int $id) - Remove um produto do carrinho com base no id.
 - all() - Lista todos os produtos no carrinho
 - order(ORDER_BY_VALUE, bool false) - Ordena os produtos, atualmente só funciona por valor, assim que implementado, poderemos trocar o `ORDER_BY_VALUE` para definir o que faremos, o segundo parametro pode ser true ou false e indica que queremos inverter a ordenação (por maior valor ou por menor valor), o padrão é false.

Em qualquer lugar da aplicação (de preferência em um controller) você poderá usar desta forma:

	CakePhpBrasil\Cart\Cart::get()->add($product);
	CakePhpBrasil\Cart\Cart::get()->delete($id);
	CakePhpBrasil\Cart\Cart::get()->all();
	CakePhpBrasil\Cart\Cart::get()->add(ORDER_BY_VALUE);

Separei um exemplo de controller pra você olhar, é só jogar dentro do diretório de controllers e acessar a url `\cart`, ou `\cart\add\\{1,2 ou 3}` ou `\cart\delete\\{1,2 ou 3}`.

[Aqui o controller.](https://github.com/CakePHPBrasil/cart/blob/master/CartController.php)

## Como ajudar a desenvolver

Você vai precisar conhecer Git, se não conhece aqui tem um [curso gratuito](http://www.webdevbr.com.br/gratis/git-iniciante.html) para te auxiliar.

Faça um fork do projeto e mande suas alterações via pull request.

Não esqueça de rodar um `composer install` depois de baixar este projeto.

### Quais são as tarefas?

Precisamos:

 - Validar as entradas de dados
 - Colocar mais opções de ordenação (por título, por exemplo)
 - Em vez de duplicar o produto, incrementar a quantidade
 - Outras coisas que passou batido

Na dúvida, mande uma pergunta no [Issues](https://github.com/CakePHPBrasil/cart/issues) ou converse com a equipe no [Slack](http://slack.cakephpbrasil.com.br/).

## Tradução deste documento

Se alguém quiser, pode traduzir este texto para outros idiomas, é só mandar um pull request.