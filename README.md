# Api-Rest

Api-Rest is a simple project developed during the classes of [Marcos Marcolin](https://github.com/marcosmarcolin) present on his Youtube channel.

## Technologies used

- PHP 7.4

## How to use

### Files

After cloning the repository, just unzip (if applicable) and move the files to the local server folder and start the server, with the server started you will need to configure the database.

### Database

The api.sql file contains all the necessary commands for creating the database, just import and run it in phpmyadmin for the database to be created.
# Api-Rest

Api-Rest is a simple project developed during the classes of [Marcos Marcolin](https://github.com/marcosmarcolin) present on his Youtube channel.

## Technologies used

- PHP 7.4

## How to use

### Files

After cloning the repository, just unzip (if applicable) and move the files to the local server folder and start the server, with the server started you will need to configure the database.

### Database

The api.sql file contains all the necessary commands for creating the database, just import and run it in phpmyadmin for the database to be created.

### Consumption

After configuring the local server and database, the API will already be working, so to consume it you will need to access "localhost/api/{routes}" always informing the Bearer token, present in the "tokens_autorizados" table.

### Routes

- List users (GET)  
--/usuarios/listar  
--/usuarios/listar/{id}  

- Create Users (POST)  
--/usuarios/cadastrar  

  - json body  
	{  
    		"login": "{user}",  
		"senha": "{password}"  
	}  

- Update Users (PUT)  
-- /usuarios/atualizar/{id}  

  - json body  
	{  
		"login": "{user}",  
		"senha": "{password}"  
	}  

- Delete Users (DELETE)  
--/usuarios/deletar/{id}  
