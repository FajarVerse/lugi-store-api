# Settings API

## Profile Users Update

Endpoint: PUT /api/settings/update-profile

Request Body:

```json
{
    "name": "Nazwa Alfa",
    "email": "nazwa@gmail.com",
    "phone": "0838929222",
    "address": "Kec. Bekasi, JL. 20",
    "latitude": 2021323,
    "longitude": 23123132
}
```

Response Body (Success):

```json
{
    "message": "Update profile successfuly",
    "data": {
        "id": 1,
        "username": "nazwa123",
        "name": "Nazwa Alfa",
        "email": "nazwa@gmail.com",
        "phone": "0838929222",
        "address": "Kec. Bekasi, JL. 20",
        "latitude": 2021323,
        "longitude": 23123132
    }
}
```

Response Body (Failed):

```json
{
    "data": "Unauthorized, ..."
}
```
