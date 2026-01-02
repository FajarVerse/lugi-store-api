# Order API

## Create Order

Endpoint: POST /api/orders

Request Body:

```json
{
    "shipping_address": "Jl. Kebon Jeruk No. 10, Jakarta",
    "payment_method": "COD"
}
```

Response Body (Success):

```json
  "id": 12,
  "order_code": "ORD-20260101-0012",
  "status": "pending",
  "total_price": 250000,
  "payment_method": "COD",
  "shipping_address": "Jl. Kebon Jeruk No. 10, Jakarta",
  "created_at": "2026-01-01T10:15:00Z"
```

Response Body (Failed):

```json
{
    "errors": "Order failed something wrong, ..."
}
```

## Get All Order

Endpoint: GET /api/orders

Response body :

```json
{
    "data": [
        {
            "id": 12,
            "order_code": "ORD-20260101-0012",
            "user_id": 5,
            "status": "pending",
            "total_price": 250000,
            "payment_method": "COD",
            "created_at": "2026-01-01T10:15:00Z"
        }
    ]
}
```

Repsponse Body (Failed):

```json
{
    "errors": "Unauthorized, ..."
}
```

## Get Order User

Endpoint: GET /api/orders/:username

Response Body (Success):

```json
{
    "data": [
        {
            "id": 12,
            "order_code": "ORD-20260101-0012",
            "user_id": 5,
            "status": "pending",
            "total_price": 250000,
            "payment_method": "COD",
            "created_at": "2026-01-01T10:15:00Z"
        }
    ]
}
```

Response Body (Failed):

```json
{
    "errors": "Unauthorized, ..."
}
```

## Get Order Detail

Endpoint: GET /api/orders/:id

Repsonse Body (Success):

```json
{
    "id": 12,
    "order_code": "ORD-20260101-0012",
    "status": "pending",
    "total_price": 250000,
    "items": [
        {
            "product_variant_id": 3,
            "product_name": "Kaos Hitam",
            "variant_name": "L",
            "price": 125000,
            "quantity": 2,
            "subtotal": 250000
        }
    ]
}
```

Response Body (Failed):

```json
{
    "errors": "Order is not found, ..."
}
```
