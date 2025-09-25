# Teste Pratico - JHE

Antes de subir a aplicação copiar os aquivos [**.env.example**](.env.example) e [**app/.env.example**](./app/.env.example) e criar os arquivos respectivos **.env**;

```bash
# env do docker-compose com dados configurações do banco
cp .env.example .env
# env do laravel
cp app/.env.example app/.env
```

Para rodar o projeto com docker, executar os seguintes comando na raiz do projeto.

```bash
docker compose up -d --build
```

Após terminar a criação dos contianer e os mesmos estiverem rodando. Executar o comando:
```bash
docker exe -it teste_pratico_php php artisan migrate
```
Para criar as tabelas no banco.

---

Acessar a api na url: [http://localhost/api/clientes](http://localhost/api/clientes).

--- 

### Postman
[Coleção do postman para fazer import](./teste-pratico-JHE.postman_collection.json)

### Erros do laravel
Caso de algum erro de permissão das pastas storage ou bootstrap executar o comando:

```bash
docker exe -it teste_pratico_php chmod -R 775 storage bootstrap/cache
```