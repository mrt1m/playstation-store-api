## 2.3.0 - 2026-06-14

- Migrated to psr/http-client interfaces for improved interoperability with PSR-compatible HTTP clients.
- Removed cookie handling from the getResponse() method. Cookies should now be configured and managed by the underlying HTTP client implementation.

## 2.2.1 - 2025-05-25

fix CategoryEnum

## 2.2.0 - 2025-04-30

Add NEW_GAMES for CategoryEnum

## 2.1.3 - 2025-04-15

fix Access Denied

## 2.1.2 - 2024-08-18

add new required headers

- content-type
- origin

## 2.1.1 - 2024-04-07

update composer json

- change guzzlehttp/guzzle
- update license
- add description and keywords

## 2.1.0 - 2024-01-11

- Added new method for get star rating information
- Added category id with all concepts
- Update parameters for RequestProductList

## 2.0.1 - 2023-06-18

- Added new method for create next page request
- Added examples

## 2.0.0 - 2023-04-30

- Switching to a new API client
- Refusal of rest-api
- Added examples
- Added make commands

## 0.3 - 2022-12-14

- changed the logic of region and language parsing
- fix support php7.4
- Added docker-compose.yaml
- Added examples
