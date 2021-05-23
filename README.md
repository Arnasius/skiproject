Project owner: Arnas Gabijunas
All the requests for a one man group project have been implemented based on the expectations.

**Customer endpoint:**

Retrieve a four week production plan summary. (With a limitation of getting the latest production plan available)

Example: GET http://127.0.0.1/yaapi/customer

Delete a given order based on id (handling of non existing orders implemented).

Example: DELETE http://127.0.0.1/yaapi/customer/{id}

**Public endpoint:**

Retrieve list of ski types with model filter.

Example: GET http://127.0.0.1/yaapi/public?model={model}

**Storekeeper endpoint: **

Create records newly produced skis

Example: POST http://127.0.0.1/yaapi/public

JSON body example (company_name needs to exist beforehand based on constraints):
`
{
    "model": "active",
    "ski_type": "skate",
    "company_name": "skicomp",
    "temp": "cold",
    "grip": "wax",
    "size": 20,
    "weight": 60,
    "description": "description",
    "historical": 0,
    "photo_url": "url",
    "msrp": 5.5
}
`
**Customer representative endpoint**

Retrieve orders with status filter set to new.

Example: GET http://127.0.0.1/yaapi/customer-rep?status={status}

Change the order state from new to open for an unassigned order (handling of non existing orders implemented).

Example: PUT http://127.0.0.1/yaapi/customer-rep/{id}

**References**

Base for the API is taken from Rune Hjelsvold https://git.gvk.idi.ntnu.no/runehj/yaapi

Implementation is based on https://git.gvk.idi.ntnu.no/runehj/sample-rest-api-project

File structure design idea is based on https://www.positronx.io/create-simple-php-crud-rest-api-with-mysql-php-pdo/

PHP and SQL related references https://www.w3schools.com/ and https://stackoverflow.com/
