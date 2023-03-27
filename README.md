
## Pokeapp

É um pequeno sistema que consome a **API** https://pokeapi.co/

#### Iniciando o projeto

<p>comando: <b>docker compose up -d</b> ou <b>docker-compose up -d</b> </p>

#### parando o projeto

<p>comando: <b>docker compose down</b> ou <b>docker-compose down</b> </p>

### Construção

#### Primeira versão
O projeto pokeapp foi criado em 2020 baseado nos conceitos mais simples de HTML, CSS, Javascript, JQuery e PHP, trabalhando conceitos como responsabilidade e ajax.

#### Segunda versão
No inicio de 2021 foi iniciado uma migração do projeto para o Laravel na versão 8, mantendo suas bases do Front-end com todas suas tecnologia originais do inicio do projeto.

O intuito da remodelagem do Back-end para o framework Laravel foi a atualização do projeto para uma tecnologia mais robusta e madura, ao qual o mercado vinha aderindo.

#### Terceira versão
O Projeto foi atualizado para a versão 10 do Laravel e dockerizado, como forma de facilitar sua execução em ambientes variados.

![Tela Inicial](https://github.com/Anderson-sl/pokeapp/blob/master/telas/tela1_login.png?raw=true)

![Tela de Login](https://github.com/Anderson-sl/pokeapp/blob/master/telas/tela2_login.png?raw=true)

![Tela de Cadastro](https://github.com/Anderson-sl/pokeapp/blob/master/telas/tela1_cadastro.png?raw=true)

![Tela Home](https://github.com/Anderson-sl/pokeapp/blob/master/telas/tela1_principal.png?raw=true)

![Tela de dados do Usuario](https://github.com/Anderson-sl/pokeapp/blob/master/telas/tela1_perfil.png?raw=true)

![Tela de Captura de Pokémons](https://github.com/Anderson-sl/pokeapp/blob/master/telas/tela1_pokemons.png?raw=true)

O Pokeapp roda em cima do docker com containers de Laravel, Postgres, PHP Fpm,  PHP, Nginx, redis, vite, composer

O banco de dados já contem um usuario default para acesso ao sistema.

#### Acesso:
<p>*email:* default@mail.com</p>
<p>*senha:* 123456</p>

## Técnico
<p>
O projeto tem como principal objetivo abordar estratégias para otimizar a experiencia do cliente, visando uma resposta no carregamento do Front-end mais rápida.
</p>
<p>
Inicialmente a requisições para obter dados dos pokemons eram feitas diretamente para a API do POKEAPI. Esse processo causava lentidão consideravel em algumas requições e uma carga maior à API externa. Por esse motivo foi criado uma tabela que armazena os pokemons recuperados em requiseções, para uso futuro, pois esses dados não sofrem alteração constante.  
</p>
<p>
A aplicaçao possui 2 filas que processam jobs em container separador escutando em filas diferentes, sendo elas as filas pokemon e email.
</p>
<p>
No container que processa a fila pokemon, será realizado a inserção do pokemon recuparado da API no banco de dados do postgres. 
</p>
<p>
No container que processa a fila email, é simulado um processo de envio de email de forma asincrona ao se cadastra no sistema. 
</p>
<p>
Ao iniciarmos o projeto com comando <b>docker compose up -d</b> ou <b>docker-compose up -d</b> será iniciado um Job para criar pokemons default no seu banco de dados utilizando a fila do Laravel.
</p>

<p>
Ao buscar um pokemon na tela capturar pokemon, os pokemons buscados serão consultados primeiramente no banco de dados, e caso não haja, será consultado na API externa e se localizado, serã enviado para fila pokemon, para ser inserido na base de dados.
</p>


