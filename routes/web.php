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
    $router->get('/exceptions', 'SupplierController@exceptions'); // Exception reporting
    $router->get('/cost-efficiency', 'SupplierController@costEfficiency'); // Cost efficiency analysis
    $router->patch('/{id}/compliance', 'SupplierController@updateCompliance'); // Update compliance/certification
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
    $router->post('/{id}/approve', 'PurchaseOrderController@approve'); // Approve PO
    $router->post('/{id}/reject', 'PurchaseOrderController@reject');   // Reject PO
    $router->post('/{id}/match', 'PurchaseOrderController@match'); // Three-way match
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
    $router->patch('/{id}/schedule', 'AuditController@scheduleNextAudit'); // Schedule next audit
});

// ----------------------------------------
// Supplier Classification Routes
// ----------------------------------------
$router->group(['prefix' => 'api/sup-clas'], function () use ($router) {
    $router->get('/', 'SupplierClassificationController@index');
    $router->post('/', 'SupplierClassificationController@store');
    $router->get('/{id}', 'SupplierClassificationController@show');
    $router->put('/{id}', 'SupplierClassificationController@update');
    $router->patch('/{id}', 'SupplierClassificationController@update');
    $router->delete('/{id}', 'SupplierClassificationController@destroy');
});

// ----------------------------------------
// Supplier Communication Routes
// ----------------------------------------
$router->group(['prefix' => 'api/sup-comm'], function () use ($router) {
    $router->get('/', 'SupplierCommunicationController@index');
    $router->post('/', 'SupplierCommunicationController@store');
    $router->get('/{id}', 'SupplierCommunicationController@show');
    $router->put('/{id}', 'SupplierCommunicationController@update');
    $router->patch('/{id}', 'SupplierCommunicationController@update');
    $router->delete('/{id}', 'SupplierCommunicationController@destroy');
});

// ----------------------------------------
// Supplier Performance Routes
// ----------------------------------------
$router->group(['prefix' => 'api/sup-perf'], function () use ($router) {
    $router->get('/', 'SupplierPerformanceController@index');
    $router->post('/', 'SupplierPerformanceController@store');
    $router->get('/{id}', 'SupplierPerformanceController@show');
    $router->put('/{id}', 'SupplierPerformanceController@update');
    $router->patch('/{id}', 'SupplierPerformanceController@update');
    $router->delete('/{id}', 'SupplierPerformanceController@destroy');
    $router->get('/scorecard/{supplierId}', 'SupplierPerformanceController@scorecard'); // Supplier scorecard
});

// ----------------------------------------
// Contract Management Routes
// ----------------------------------------
$router->group(['prefix' => 'api/contracts'], function () use ($router) {
    $router->get('/', 'ContractController@index');
    $router->post('/', 'ContractController@store');
    $router->get('/{id}', 'ContractController@show');
    $router->put('/{id}', 'ContractController@update');
    $router->patch('/{id}', 'ContractController@update');
    $router->delete('/{id}', 'ContractController@destroy');
    $router->get('/alerts/payment', 'ContractController@checkPaymentAlerts'); // Payment alerts
});

// ----------------------------------------
// User Management Routes
// ----------------------------------------
$router->group(['prefix' => 'api/users'], function () use ($router) {
    $router->get('/', 'UserController@index');
    $router->post('/', 'UserController@store');
    $router->get('/{id}', 'UserController@show');
    $router->put('/{id}', 'UserController@update');
    $router->patch('/{id}', 'UserController@update');
    $router->delete('/{id}', 'UserController@destroy');
});
