# labEncurtador

## Para utilização dessa aplicação
Um servidor rodando Ubuntu 14.04.

Acesso sudo ao servidor.

Apache e php +5.4

Acesso a um servidor com permissão de criação de schema


## Instalando o Composer no Ubuntu 14.04
Atualize o sistema

sudo apt-get update

Instale as dependencias

sudo apt-get install curl git

Instalando o composer

curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer


## Baixe do Git a versão mais nova do aplicativo
Em seu sistema, acesse o diretorio de armazenamento do seu encurtador.

> git init

> git remote add origin https://github.com/santoscaio/labEncurtador.git

> git pull origin master


Ou baixe a versão mais nova do [Encurtador](https://github.com/santoscaio/labEncurtador.git)


## Baixando as dependencias
Em seu sistema, acesse o diretorio de armazenamento do seu encurtador e execute o comando abaixo:

sudo composer install


## Configure o banco de dados
Em seu sistema, acesse o diretorio de configuração *enviroments/prod/* e edite o arquivo *.env*

> DB_HOST=127.0.0.1 // Endereço do servidor MySql

> DB_DATABASE=encurtador // Nome do Database

> DB_USERNAME=usuario // Nome do usuário

> DB_PASSWORD=senha // Senha do usuário