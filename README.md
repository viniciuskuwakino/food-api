# Food REST API

Nesse desafio trabalharemos no desenvolvimento de uma REST API para utilizar os dados do projeto Open Food Facts, que é um banco de dados aberto com informação nutricional de diversos produtos alimentícios.

O projeto tem como objetivo dar suporte a equipe de nutricionistas da empresa Fitness Foods LC para que eles possam revisar de maneira rápida a informação nutricional dos alimentos que os usuários publicam pela aplicação móvel.

### Ferramentas necessárias para este projeto:

- [Composer](https://getcomposer.org/);
- [Docker](https://docs.docker.com/engine/install/ubuntu/);
- [PHP](https://www.php.net/downloads.php);

### Preparando o ambiente:

- Inicialmente clone o este repositório;

- Em seguida, na raiz do projeto, copie e cole o arquivo `.env.example` e altere o nome da cópia para `.env`;

- Ainda na raiz do projeto execute o seguinte comando para instalar as dependências do projeto:

  ```bash
  composer install
  ```

- Executar os seguintes comandos para criar diretórios `data` e `scripts` no diretório `postgres` (ainda na raiz do projeto):

  ```bash
  mkdir .docker/postgres/data
  mkdir .docker/postgres/scripts
  ```

- A seguir, para iniciar os containers da aplicação, execute o comando:

  ```bash
  docker-compose up -d
  ```

- Será necessário dar permissões para os diretórios `storage` e `bootstrap` e limpar o cache de otimização da aplicação:

  ```bash
  chmod -R 777 storage
  chmod -R 777 bootstrap
  php artisan optimize:clear
  ```

- Execute este comando para executar as migrations:

  ```bash
  docker exec -it food-api-php php artisan migrate
  ```

- Execute o seguinte comando para importar os nomes dos arquivos compactados para a tabela de `product_files`:

  ```bash
  docker exec -it food-api-php php artisan import:product-files
  ```

- Acesse o arquivo `crontab`:

  ```bash
  crontab -e
  ```

- Adicione a seguinte linha no final do arquivo:

  ```bas
  * * * * * docker exec food-api-php php artisan schedule:run
  ```

### Testar a API no Postman ou Insomnia

Url: http://127.0.0.1:8201/api/

`GET /`: Detalhes da API, se conexão leitura e escritura com a base de dados está OK, horário da última vez que o CRON foi executado, tempo online e uso de memória; <br/>
`PUT /products/:code`: Recebe atualizações do Projeto Web; <br/>
`DELETE /products/:code`: Mudar o status do produto para `trash`; <br/>
`GET /products/:code`: Obter a informação somente de um produto da base de dados; <br/>
`GET /products`: Listar todos os produtos da base de dados, com sistema de paginação para não sobrecarregar o `REQUEST`. <br/>
