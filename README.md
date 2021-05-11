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
### /users
![alt text](https://github.com/Gustavo3g/financeiro-laravel/blob/main/.imgsReadme/get-users.png)
# POST
### /users
![alt text](https://github.com/Gustavo3g/financeiro-laravel/blob/main/.imgsReadme/post-users.png)


# POST
### /transaction
![alt text](https://github.com/Gustavo3g/financeiro-laravel/blob/main/.imgsReadme/post-transaction.png)



# POST
### /rollback-transaction
![alt text](https://github.com/Gustavo3g/financeiro-laravel/blob/main/.imgsReadme/post-rollback.png)

 