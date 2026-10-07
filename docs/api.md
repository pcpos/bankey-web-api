# Bankey API v1

## Login

POST `/api/v1/auth/login`

Request:
```json
{"cif":"123456789012","password":"secret","device_id":"web-device-uuid","language":"en_US"}
```

The default `BANK_MODE=mock` returns a normalized mock customer/account response.

## Security

Customer passwords are request-only and must never be persisted or logged. Raw upstream credentials and bank secrets must never be returned to browser clients. Live mode remains unimplemented until an authorized upstream specification is provided.
