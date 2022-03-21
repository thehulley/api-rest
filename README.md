# ApiRest em PHP
<fig>
<img src="https://files.tecnoblog.net/wp-content/uploads/2021/01/o_que_e_php_unsplash-700x467.jpg" alt="Um notebook aberto em cima de uma mesa de madeira, um editor de código está aberto no notebook e em cima do teclado está um elefante de pelúcia azul com PHP escrito em seu corpo.">
</fig>

## Tecnologias utilizadas

Foram utilizadas as seguintes tecnologias.

- [PHP](https://www.php.net)
- [MySQL](https://www.mysql.com)

## Inicialização
Para executar o projeto, utilize as etapas descritas abaixo.

* Clone o repositório do projeto.
* Execute o `api.sql` no MySQL.
* Atualize o `bootstrap.php` substituindo o valor de HOST, DB, USER e PASS pelas credenciais do seu banco de dados.
* Mova os arquivos para local de execução do servidor web.

Após isso o projeto estará rodando :blush:

## Links importantes
* [Marcos Marcolin](https://github.com/marcosmarcolin) :blue_heart:
* [XAMPP](https://www.apachefriends.org/pt_br/download.html) - Download Xampp, utilizado para executar o código PHP.

# ApiRest em PHP

## Introdução

> Este projeto foi desenvolvido durante um minicurso ofertado por Marcos Marcolin em seu canal no YouTube.

Este projeto tem como principal objetivo a criação de uma plataforma para o gerenciamento de usuários.

### Endpoints

| Nome | Funcionalidade|
|------|---------------|
|```GET``` /usuarios/listar|Informa o usuário buscado ou todos os usuários cadastrados.|
|```POST``` /usuarios/cadastrar|Realiza a criação de um usuário.|
|```PUT``` /usuarios/atualizar/|Atualiza um usuário.|
|```DELETE``` /usuarios/deletar/|Deleta um usuário.|
