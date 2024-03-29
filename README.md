﻿# Twitter Clone

## Objetivo:

Projeto realizado com objetivo de colocar em prática conhecimentos PHP, entender e praticar arquitetura MVC (model view controller), e colocar em prática conhecimentos em banco de dados relacionais (MySQL).

Essa aplicação utiliza models para consulta no banco de dados, controllers para a interceptação e trativas das rotas e requisições, e views que são populadas com os dados vindo das consultas.

## Como rodar o projeto localmente

#### Requesitos:
- PHP >= 7.0
- MySQL
- Servidor Web (Apache)

#### Iniciando...

Rode o seguinte código no terminal para acessar a pasta public:
```
cd public
```

Estando na pasta public do projeto, incie o servidor com o seguinte comando:
```
php -S localhost:8080
```


Adicione o banco de dados em sua aplicação e crie um usuário para testes. Use encripitação MD5 na senha para funcionar.
![Adicionando-Usuário](public/img/bancodedados.gif)



Acesse o endereço: localhost:8080 no navegador e a aplicação já estará disponível.

![Login](public/img/twiiter1.gif)


