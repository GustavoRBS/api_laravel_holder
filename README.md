# API Laravel Holder

Teste prático de criação de API.

Devido a minha disponbilidade de tempo, entreguei sem o front (opcional), porem não usei todo o tempo disponibilizado.

Grato, Gustavo Bailon.

## Getting com Curl

```
    $ curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X GET http://127.0.0.1:8000/api/transaction
    $ curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X GET http://127.0.0.1:8000/api/transaction/:id
    $ curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X POST -d '{"start_date": "2023-04-10", "end_date": "2023-04-13", "price_buy": "65",         "price_sell": "85", "description": "test"}' http://127.0.0.1:8000/api/transaction
    $ curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X PUT -d '{"start_date": "2023-04-10", "end_date": "2023-04-13", "price_buy": "65",         "price_sell": "85", "description": "test"}' http://127.0.0.1:8000/api/transaction/:id
    $ curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X DELETE http://127.0.0.1:8000/api/transaction/:id
```

## Autenticação com username

```
    $ curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X GET http://127.0.0.1:8000/api/transaction  -H 'Authorization:Basic username:password'
```

## Autenticação com email

```
    $ curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X GET http://127.0.0.1:8000/api/transaction -H 'Authorization:Basic email:password'
```
