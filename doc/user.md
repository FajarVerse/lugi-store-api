# User API spec

## Register User

Endpoint : POST /api/users

Request Body:

```json
{
    "username": "nazwa123",
    "password": "rahasia",
    "name": "Nazwa Alfadillah",
    "email": "nazwa@gmail.com",
    "phone": "083888888"
}
```

Response Body (Success):

```json
{
    "data": {
        "username": "nazwa123",
        "name": "Nazwa Alfadillah",
        "email": "nazwa@gmail.com",
        "phone": "083888888"
    }
}
```

Response Body (Failed):

```json
{
    "errors": "Username must not blank, ..."
}
```

## Login User

Endpoint : POST api/users/login

Request Body:

```json
{
    "username": "nazwa123",
    "password": "rahasia"
}
```

Response Body (Success):

```json
{
    "data": {
        "username": "nazwa123",
        "name": "Nazwa Alfadillah",
        "token": "uuid"
    }
}
```

## Get User

Endpoint: GET /api/users/current

Response Body (Success):

```json
{
    "data": {
        "username": "nazwa123",
        "name": "Nazwa Alfadillah",
        "email": "nazwa@gmail.com",
        "phone": "083888888",
        "address": ""
    }
}
```

Response Body (Failed):

```json
{
    "errors": "Unauthorized, ..."
}
```

## Update User

Endpoint: PATCH /api/users/current

Request Body:

```json
{
    "password": "rahasia",
    "name": "Nazwa Alfa",
    "email": "nazwa123@gmail.com",
    "phone": "0838999999",
    "address": "Jl. Bekasi 12",
    "latitude": 0823823,
    "longitude": 2301392
}
```

Response Body (Success):

```json
{
    "data": {
        "name": "Nazwa Alfa",
        "email": "nazwa123@gmail.com",
        "phone": "0838999999",
        "address": "Jl. Bekasi 12",
        "latitude": 0823823,
        "longitude": 2301392
    }
}
```

Response Body (Failed):

```json
{
    "errors": "Unauthorized, ..."
}
```

## Delete User

Endpoint: DELETE /api/users/current

Reponse Body (Success):

```json
{
    "data": "ok"
}
```

Response Body (Failed):

```json
{
    "errors": "Unauthorized, ..."
}
```
