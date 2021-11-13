<h5>Olá mundo! Venho aqui com esse projetinho simples, mas que pode ajudar muitos da nossa comunidade.</h5>
<p>Front-end de mercado de código aberto com tecnologia Stripe API e Split de pagamento, incluindo integração com a Web Services do Correios, automação de plataforma, gerenciamento de pagamentos, gerenciamento de conta, monitoramento de usuários, transações, cadastro de cupom de desconto, classificações e muito mais ⚡</p>
<span>Aplicação de alta performance, código de fácil manutenção com orientação a objetos e muito bem estruturado! 🔥</span>



<ul>
<li>
  <strong>Languages: <br /></strong>
  <i>PHP, Javascript e SQL.</i>
 </li>

<li>
  <strong>Database: </br /></strong>
  <i>PHPMyAdmin.</i>
</li>

<li>
  <strong>Library: <br /></strong>
  <i>jQuery.</i>
</li>

<li>
  <strong>Style: <br /></strong>
  <i>Cascading Style Sheets.</i>
</li>

<li>
  <strong>Markup Language: <br /></strong>
  <i>HTML.</i>
</li>
</ul>


##


<span>Uma plataforma de multi fornecedores requer muitas verificações e detalhes que devem ser atendidos para que o dinheiro não caia na conta errada. Então para a integração do Stripe eu utilizei o cURL, e criei duas classes (uma para pagamentos e a outra para o split), a classe split se estende com a classe de pagamentos. Primeiro precisa criar um cliente, segundo precisa atribuir um método de pagamento a esse cliente e por último realizar a cobrança. Mas para isso funcionar em um checkout transparente, precisamos interligar essas três funções, para que o usuário cadastrado tenha a forma de pagamento cadastrado com o mesmo id e em seguida realizar o pagamento. E para não entrar dentro de um loop infinito chamamos as funções com duas verificações... No if() verificamos se o endpoint é igual a tal endpoint da função, se for
igual chama a outra função e passa como parâmetro o retorno id que a resposta do servidor nos dá. Isso fará com que ele realize cada passo enviando para um único cURL, não é demais o quanto uma boa lógica é uma organização pode fazer por nós?
A Web service dos correios requer que passemos os parâmetros via GET, então apenas criamos um formulário onde a pessoa preenche suas informações, e enviamos como forma de AJAX para o nosso PHP realizar o trabalho de chamar a resposta da Web service.
Na database eu tenho uma tabela com o nome de "coupons", essa tabela tem três colunas, dentro delas são: shop_id, code e o discount. Ao usuário inserir o post do coupon eu realizo a seguinte verificação: Se o código do cupom e o id da loja existirem na tabela (utilizo o ->rowCount para contar de existe uma linha assim na tabela), se essa validação for true, criamos três $_SESSION que terá o id da loja, o código do cupom e o valor desse desconto para podermos utilizar durante o checkout.
Chegando no
checkout verificamos se a loja contém algum cupom de desconto compatível com aquele código e se o id da loja é o mesmo id da loja que foi para o checkout, se essa validação for true criamos uma conta básica de matemática contendo o valor do envio, mais o valor do amount e menos a porcentagem de desconto que essa loja ofereceu.
Para o checkout eu fiz os pedidos serem separados, pois é muito mais seguro.</span>

<h5>Agradeço a quem ficou até aqui, até logo.</h5>
