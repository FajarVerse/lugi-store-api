# Product API

## Create Product

Endpoint: POST /api/products

Request Body:

```json
{
    "name": "barang 1",
    "description": "lorem ipsum dolor si amet",
    "price": 50000,
    "stock": 10,
    "image": "image.png",
    "category_id": 1
}
```

Response Body (Success):

```json
{
    "data": {
        "id": 1,
        "name": "barang 1",
        "slug": "barang-1",
        "description": "lorem ipsum dolor si amet",
        "price": 50000,
        "stock": 10,
        "image": "image.png",
        "category_id": 1
    }
}
```

Response Body (Failed):

```json
{
    "errors": "Name must not blank, ..."
}
```

## Get Product

Endpoint: GET /api/products/:id

Response Body (Success):

```json
{
    "data": {
        "id": 1,
        "name": "barang 1",
        "slug": "barang-1",
        "description": "lorem ipsum dolor si amet",
        "price": 50000,
        "stock": 10,
        "image": "image.png",
        "category_id": 1
    }
}
```

Response Body (Failed):

```json
{
    "errors": "Product is not found, ..."
}
```

## Update Product

Endpoint PUT /api/products/:id

Request Body:

```json
{
    "name": "barang2",
    "description": "lorem ipsum dolor si amet",
    "price": 40000,
    "stock": 11,
    "image": "image1.png",
    "category_id": 2
}
```

Response Body (Success):

```json
{
    "data": {
        "id": 1,
        "name": "barang2",
        "description": "lorem ipsum dolor si amet",
        "price": 40000,
        "stock": 11,
        "image": "image1.png",
        "category_id": 2
    }
}
```

Response Body (Failed):

```json
{
    "errors": "Name must not blank, ..."
}
```

## Remove Product

Endpoint: DELETE /api/products/:id

Response Body (Success):

```json
{
    "data": "ok"
}
```

Response Body (Failed):

```json
{
    "errors": "Products is not found, ..."
}
```

## Search Product

Endpoint: GET /api/products

Query Parameter:

-   name: string, optional

Response Body (Success):

```json
{
    "data": [
        {
            "id": 1,
            "name": "barang1",
            "description": "lorem ipsum dolor si amet",
            "price": 40000,
            "stock": 11,
            "image": "image1.png",
            "category_id": 2
        },
        {
            "id": 2,
            "name": "barang2",
            "description": "lorem ipsum dolor si amet",
            "price": 50000,
            "stock": 11,
            "image": "image2.png",
            "category_id": 2
        }
    ]
}
```

Response Body (Failed):

```json
{
    "errors": "Product is not found,..."
}
```
