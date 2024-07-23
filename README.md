# Projeto Laravel com Docker

Este projeto utiliza Laravel e Docker para criar um ambiente de desenvolvimento isolado e consistente. Inclui configurações para o PHP, MariaDB e os comandos básicos para iniciar o ambiente de desenvolvimento.

## Requisitos

Antes de começar, certifique-se de ter os seguintes softwares instalados:
- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

Caso você não tenha o Docker instalado, você pode configurar o projeto manualmente. As versões usadas são:
- **PHP**: 8.2
- **Laravel**: 11.x

## Configuração do Ambiente

### Usando Docker

1. **Clone o Repositório**

    ```sh
    git clone https://github.com/GustaVasconcelos/teste-php-dev.git
    cd teste-php-dev
    ```

2. **Construa e Inicie os Contêineres**

    Use o Docker Compose para construir a imagem e iniciar os serviços definidos no `docker-compose.yml`.

    ```sh
    docker-compose up -d --build
    ```

    Isso criará e iniciará dois contêineres: um para o PHP e outro para o banco de dados MySQL.

3. **Verifique o Status dos Contêineres**

    Verifique se os contêineres estão rodando corretamente.

    ```sh
    docker-compose ps
    ```

4. **Acesse o Aplicativo**

    O aplicativo estará acessível em `http://localhost:8080`. Use o navegador para visualizar a aplicação Laravel.

### Configuração Manual (Sem Docker)

Caso você não possa usar Docker, você pode configurar o ambiente manualmente. Aqui estão os passos:

1. **Instale o PHP 8.2**

    Certifique-se de ter o PHP 8.2 instalado. Você pode verificar a versão do PHP com o comando:

    ```sh
    php -v
    ```

2. **Instale o Composer**

    O Composer é necessário para gerenciar as dependências do Laravel. Você pode baixá-lo e instalá-lo seguindo as instruções em [getcomposer.org](https://getcomposer.org/).

3. **Clone o Repositório**

    ```sh
    git clone https://github.com/GustaVasconcelos/teste-php-dev.git
    cd teste-php-dev
    ```

4. **Copie o Arquivo de Configuração do Ambiente**

    Renomeie o arquivo de exemplo `.env.example` para `.env` e ajuste as configurações conforme necessário.

    ```sh
    cp .env.example .env
    ```

5. **Instale as Dependências do Composer**

    ```sh
    composer install
    ```

6. **Configure o Banco de Dados**

    Configure o banco de dados no arquivo `.env` conforme suas necessidades. As configurações padrão são para MySQL.

7. **Gere a Chave da Aplicação**

    ```sh
    php artisan key:generate
    ```

8. **Aplique as Migrations**

    ```sh
    php artisan migrate
    ```

9. **Inicie o Servidor**

    ```sh
    php artisan serve --host=0.0.0.0 --port=8000
    ```

    O aplicativo estará acessível em `http://localhost:8000`. Use o navegador para visualizar a aplicação Laravel.

## Estrutura dos Arquivos

- `Dockerfile`: Define a imagem do PHP e configura o ambiente.
- `docker-compose.yml`: Define e configura os serviços Docker (PHP e MariaDB).
- `.docker/entrypoint.sh`: Script de inicialização que prepara o ambiente, gera a chave da aplicação e aplica as migrations.
- `.env`: Configuração do ambiente Laravel. Deve ser ajustado para refletir suas configurações locais.

## Comandos Úteis

- **Construir e Iniciar os Contêineres**

    ```sh
    docker-compose up -d --build
    ```

- **Parar e Remover os Contêineres**

    ```sh
    docker-compose down
    ```

- **Verificar Logs**

    ```sh
    docker-compose logs -f
    ```

- **Acessar o Contêiner PHP**

    ```sh
    docker-compose exec testephp-app bash
    ```

## Configuração do Banco de Dados

A configuração do banco de dados é feita no arquivo `.env`. As variáveis de ambiente configuram a conexão com o banco de dados MariaDB.
