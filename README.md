# labEncurtador

## Para utilização dessa aplicação
Um servidor rodando Ubuntu 14.04.

Acesso sudo ao servidor.

Apache e php +5.4

Acesso a um servidor de banco de dados MySql com permissão de criação de schema

## Configurando o banco de dados
O banco de dados deve ser **MySql**

Crie um schema para o sistema de encurtador

Execute o arquivo "*database.sql*" par a criação das tabelas

Crie um usuário com permissão de **SELECT**, **UPDATE**, **DELETE** 


## Instalando o Composer no Ubuntu 14.04
Em seu sistema, atualize o sistema

> sudo apt-get update

Instale as dependencias

> sudo apt-get install curl git

Instalando o composer

> curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer


## Baixe do Git a versão mais nova do aplicativo
Em seu sistema, acesse o diretorio de armazenamento do seu encurtador e efetue as seguintes etapas

> sudo git init

> sudo git remote add origin https://github.com/santoscaio/labEncurtador.git

> sudo git pull origin master


Ou baixe a versão mais nova do [Encurtador](https://github.com/santoscaio/labEncurtador.git)


## Baixando as dependencias
Em seu sistema, acesse o diretorio de armazenamento do seu encurtador e execute o comando abaixo:

> sudo composer install


## Configure o banco de dados
Em seu sistema, acesse o diretorio de configuração "*enviroments/prod/*" e edite o arquivo "*.env*"

> DB_HOST=127.0.0.1 // Endereço do servidor MySql

> DB_DATABASE=encurtador // Nome do Database

> DB_USERNAME=usuario // Nome do usuário

> DB_PASSWORD=senha // Senha do usuário


### Para teste da API
http://c.santoscaio.com/Gho