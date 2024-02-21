# SAPb1
A simple and easy to use PHP library for SAP Business One Service Layer API.

# Fork story time
This repository is a fork from [syedhussim/php-sapb1](https://github.com/syedhussim/php-sapb1). A sponsor button has been added to help with furthering the development of the library.  
_Please consider sponsoring the original repository / developer first or, at the least, as well._

The roadmap for this fork can be found in [roadmap.md](/roadmap.md)

Development will be done according to [development.md](/development.md)

# Current SAP B1S Layer version
See [releases section](http://github.com/TowelMarkII/) and the [changelog](/changelog.md). It is backwards compatible with SAP Business One Service Layer v10.00.140 by using a version config property. See [Usage and Examples](#usage-and-examples) for details.

# Usage and examples

You can find more examples and the full documentation at https://syedhussim.com/sap-b1/php-sapb1-library-documentation-v1.html

Create an array to store your SAP Business One Service Layer configuration details. 
```php
$config = [
    'host' => 'IP or Hostname',
    'port' => 50000,
    'https' => true,
    'sslOptions' => [
        "cafile" => "path/to/certificate.crt",
        "verify_peer" => true,
        "verify_peer_name" => true,
    ],
    'version' => 2
];
```

## B1S Layer version
If your B1S Layer is version 10.00.140 or lower you must add the config property
```php
$config = [
    ...,
    'b1s_version' => 'v10.00.140',
    ...
]
```

The default for the config property is 'v10.00.210' or higher. If you don't set it.

## Create a new Service Layer session.

```php
$sap = SAPClient::createSession($config, 'SAP UserName', 'SAP Password', 'Company');
```

The static `createSession()` method will return a new instance of `SAPClient`. The SAPClient object provides a `service($name)` method which returns a new instance of Service with the specified name. Using this Service object you can perform CRUD actions.

## Querying A Service

The `queryBuilder()` method of the Service class returns a new instance of Query. The Query class allows you to use chainable methods to filter the requested service.

The following code sample shows how to filter Sales Orders using the Orders service.

```php
$sap = SAPClient::createSession($config, 'SAP UserName', 'SAP Password', 'Company');
$orders = $sap->getService('Orders');

$result = $orders->queryBuilder()
    ->select('DocEntry,DocNum')
    ->orderBy('DocNum', 'asc')
    ->limit(5)
    ->findAll(); 
```
The `findAll()` method will return a collection of records that match the search criteria. To return a specific record using an `id` use the `find($id)` method.

```php
...
$orders = $sap->getService('Orders');

$result = $orders->queryBuilder()
    ->select('DocEntry,DocNum')
    ->find(123456); // DocEntry value
```
Depending on the service, `$id` may be a numeric value or a string. If you want to know which field is used as the id for a service, call the `getMetaData()` method on the Service object as shown below.

```php
...
$meta = $orders->getMetaData();
```

## Creating A Service

The following code sample shows how to create a new Sales Order using the create() method of the Service object.

```php
...
$orders = $sap->getService('Orders');

$result = $orders->create([
    'CardCode' => 'BP Card Code',
    'DocDueDate' => 'Doc due date',
    'DocumentLines' => [
        [
            "ItemCode" => "Item Code",
            "Quantity" => 100,
        ]
    ]
]);
```
You must provide any User Defined Fields that are required to create a Sales Order. If successful, the newly created Sales Order will be returned as an object.

## Updating A Service

The following code sample demonstrates how to update a service using the `update()` method of the Service object.

```php
...
$orders = $sap->getService('Orders');

$result = $orders->update(19925, [
    'Comments' => 'Comment added here'
]);
```
Note that the first argument to the update() method is the `id` of the entity to update. In the case of a Sales Order the `id` is the DocEntry field. If the update is successful a boolean true value is returned.

## Adding Headers

You can specify oData headers by calling the headers() method on a Service instance with an array of headers.

```php
...
$orders = $sap->getService('Orders');
$orders->headers(['Prefer' => 'odata.maxpagesize=0']);

$result = $orders->queryBuilder()
    ->select('DocEntry,DocNum')
    ->find(123456); // DocEntry value
```