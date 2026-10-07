# Bankey Web API

Laravel middleware API for the Bankey web application.

Initial scope: authentication, accounts/statements, transfers, bill payment, password/PIN recovery, and device reset.

The upstream banking transport is isolated behind a bank adapter. Development starts in mock mode until an authorized upstream API specification is configured.
