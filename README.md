<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



## RUN PROJECT

```
$ docker-compose up -d --build
```
```
$ docker exec -it (nome da aplicação laravel rodando no docker) bash

$ php artisan migrate
```

## CONFIG
```
$ docker ps

$ docker exec -it (nome da aplicação laravel rodando no docker) bash
```
## EDITE O ARQUIVO DE CONFIGURAÇÃO
```
$ nano /etc/nginx/conf.d/default.conf
```

Procure pelo seguinte trecho:
```
location / {
        # First attempt to serve request as file, then
        # as directory, then fall back to index.php
        try_files $uri $uri/ /index.php?$query_string $uri/index.html;
    }
```
Substitua pelo seguinte trecho:

```
location / {
        # First attempt to serve request as file, then
        # as directory, then fall back to index.html
        try_files $uri $uri/ /index.php?$args;
    }
```
## RUN 
```
$ service nginx restart
```
```
$ php artisan migrate
```



## Diagrama Entidade e Relacionamento
![alt text](https://github.com/Gustavo3g/financeiro-laravel/blob/main/.imgsReadme/der-project.png)

## DOCUMENTAÇÃO
[Acessar Documentação](https://www.notion.so/DOCUMENTA-O-f0786a65deb54523af4d2a384bf90b92)


# GET
## api/users

```json
{
    "id": 4,
    "full_name": "Gustavo Barros de Sousa",
    "email": "cliente@teste.com",
    "cpf": "604183454d32",
    "shopkeeper": 0,
    "created_at": "2021-05-11T17:46:05.000000Z",
    "updated_at": "2021-05-11T17:46:05.000000Z",
    "wallet": {
      "id": 4,
      "balance": "530.47",
      "user_id": 4,
      "created_at": "2021-05-11T17:46:05.000000Z",
      "updated_at": "2021-05-11T17:49:03.000000Z"
    }
  }
```

# POST
## api/users
```json
{
	"full_name": "Gustavo Barros de Sousa",
	"cpf": "06906906934",
	"email": "cliente@teste.com",
	"password": "senhasecreta"
}
```



# POST
### api/transaction
```json
{
    "value" : 35.00,
    "payer" : 5,
    "payee" : 4
}
```



# POST
## api/rollback-transaction
```json
{
    "id_transaction" : 1 // id da transação
}
```

 