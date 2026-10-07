# Bankey API v1

Default mode: `BANK_MODE=mock`.

For session-based mock endpoints send:
`X-Bank-Session: mock-session`

## Authentication
- POST `/api/v1/auth/login`

## Accounts
- GET `/api/v1/accounts`
- GET `/api/v1/accounts/{account}/mini-statement`
- GET `/api/v1/accounts/{account}/statement?from=2026-10-01&to=2026-10-07&type=ALL`

## Transfers
- POST `/api/v1/transfers/own`
  - `from_account`, `to_account`, `amount`, optional `comment`
- POST `/api/v1/transfers/other`
  - `from_account`, `to_account`, `amount`, optional `beneficiary_name`, `mobile`, `comment`
- POST `/api/v1/transfers/p2p`
  - `from_account`, `recipient`, `amount`, optional `comment`
- POST `/api/v1/transfers/confirm`
  - `transaction_id`, `otp`

## Bill payment
- GET `/api/v1/billers`
- POST `/api/v1/bills/inquiry`
  - `biller_id`, `customer_reference`
- POST `/api/v1/bills/pay`
  - `account`, `biller_id`, `customer_reference`, `amount`

## Password recovery
- POST `/api/v1/password/forgot`
  - `cif`
- POST `/api/v1/password/verify-otp`
  - `recovery_id`, `otp`
- POST `/api/v1/password/reset`
  - `recovery_token`, `new_password`

## Authorized device reset
- POST `/api/v1/device/reset`
  - `cif`, `device_id`
- POST `/api/v1/device/reset/verify`
  - `reset_id`, `otp`

## Login example
```json
{
  "cif": "123456789012",
  "password": "secret",
  "device_id": "web-device-uuid",
  "language": "en_US"
}
```

## Response contract
Successful operations use:
```json
{"success":true,"data":{},"message":"optional"}
```

Errors use:
```json
{"success":false,"data":{},"error":{"code":"ERROR_CODE","message":"Description"}}
```

## Security and live integration
Customer passwords must never be persisted or logged. Browser clients should not receive raw upstream credentials or secrets. The bank-specific live transport is isolated in `app/Banking/Bankak`. Live mappings for authentication, transfers, recovery, and device operations must be implemented from an authorized upstream specification rather than inferred security secrets or device-binding bypasses.
