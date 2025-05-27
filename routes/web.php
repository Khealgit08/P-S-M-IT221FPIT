<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// ----------------------------------------
// Supplier Module Routes
// ----------------------------------------
$router->group(['prefix' => 'api/suppliers'], function () use ($router) {
    $router->get('/', 'SupplierController@index');           // Get all suppliers
    $router->post('/', 'SupplierController@store');          // Add new supplier
    $router->get('/{id}', 'SupplierController@show');        // Get supplier by ID
    $router->put('/{id}', 'SupplierController@update');      // Update supplier
    $router->patch('/{id}', 'SupplierController@update');    // Update supplier
    $router->delete('/{id}', 'SupplierController@destroy');  // Delete supplier
});

// ----------------------------------------
// Purchase Order Module Routes
// ----------------------------------------
$router->group(['prefix' => 'api/purchase-orders'], function () use ($router) {
    $router->get('/', 'PurchaseOrderController@index');
    $router->post('/', 'PurchaseOrderController@store');
    $router->get('/{id}', 'PurchaseOrderController@show');
    $router->put('/{id}', 'PurchaseOrderController@update');
    $router->patch('/{id}', 'PurchaseOrderController@update');
    $router->delete('/{id}', 'PurchaseOrderController@destroy');
});

// ----------------------------------------
// Invoice Module Routes
// ----------------------------------------
$router->group(['prefix' => 'api/invoices'], function () use ($router) {
    $router->get('/', 'InvoiceController@index');
    $router->post('/', 'InvoiceController@store');
    $router->get('/{id}', 'InvoiceController@show');
    $router->put('/{id}', 'InvoiceController@update');
    $router->patch('/{id}', 'InvoiceController@update');
    $router->delete('/{id}', 'InvoiceController@destroy');
});

// ----------------------------------------
// Goods Receipt Note (GRN) Routes
// ----------------------------------------
$router->group(['prefix' => 'api/grns'], function () use ($router) {
    $router->get('/', 'GoodsReceiptController@index');
    $router->post('/', 'GoodsReceiptController@store');
    $router->get('/{id}', 'GoodsReceiptController@show');
    $router->put('/{id}', 'GoodsReceiptController@update');
    $router->patch('/{id}', 'GoodsReceiptController@update');
    $router->delete('/{id}', 'GoodsReceiptController@destroy');
});

// ----------------------------------------
// Audit Routes
// ----------------------------------------
$router->group(['prefix' => 'api/audits'], function () use ($router) {
    $router->get('/', 'AuditController@index');
    $router->post('/', 'AuditController@store');
    $router->get('/{id}', 'AuditController@show');
    $router->put('/{id}', 'AuditController@update');
    $router->patch('/{id}', 'AuditController@update');
    $router->delete('/{id}', 'AuditController@destroy');
});
