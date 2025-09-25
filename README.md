# Teste Pratico - JHE

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
[Coleção do postman para fazer import](./Teste Pratico - JHE.postman_collection.json)

### Erros do laravel
Caso de algum erro de permissão das pastas storage ou bootstrap executar o comando:

```bash
docker exe -it teste_pratico_php chmod -R 775 storage bootstrap/cache
```