# Category API

## Create Category

Endpoint: POST /api/categories

Request Body:

```json
{
    "name": "Baju"
}
```

Response Body (Success):

```json
{
    "data": {
        "id": 1,
        "name": "Baju",
        "slug": "baju"
    }
}
```

Response Body (Failed):

```json
{
    "errors": "Category name must not blank, ..."
}
```

## Get Category

Endpoint: GET /api/categories/:id

Response Body (Success):

```json
{
    "data": {
        "id": 1,
        "name": "Baju",
        "slug": "baju"
    }
}
```

Response Body (Failed):

```json
{
    "errors": "Category is not found, ..."
}
```

## Update Category

Endpoint: PUT /api/categories/:id

Request Body:

```json
{
    "name": "Baju keren"
}
```

Response Body (Success):

```json
{
    "data": {
        "id": 1,
        "name": "Baju keren",
        "slug": "baju-keren"
    }
}
```

Response Body (Failed):

```json
{
    "errors": "Category name must not blank, ..."
}
```

## Remove Category

Endpoint: DELETE /api/categories/:id

Response Body (Success):

```json
{
    "data": "ok"
}
```

Response Body (Failed):

```json
{
    "errors": "Category is not found"
}
```

## Search Category

Endpoint: GET /api/categories

Query Parameter:

-   name: string, optional

Response Body (Success):

```json
{
    "data": [
        {
            "id": 1,
            "name": "Baju keren",
            "slug": "baju-keren"
        },
        {
            "id": 2,
            "name": "Celana keren",
            "slug": "celana-keren"
        }
    ]
}
```

Response Body (Failed):

```json
{
    "errors": "Category is not found, ..."
}
```
