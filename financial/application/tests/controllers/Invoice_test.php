<?php
class Invoice_test extends TestCase
{
    // function to load on every test
    public function setUp(): void {

    }

    public function test_get_all(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'getInvoice' => [
                            [
                                'id' => '1',
                                'order_id' => '1',
                                'total' => '10000',
                                'status' => 'incomplete'
                            ],
                            [
                                'id' => '1',
                                'order_id' => '2',
                                'total' => '20000',
                                'status' => 'waiting'
                            ]
                        ]
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('GET', 'api/v1/invoices/');

        // assert response code and message
        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);

    }

    public function test_get_one(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'getInvoice' => 
                        [
                            'id' => '1',
                            'order_id' => '1',
                            'total' => '10000',
                            'status' => 'incomplete'
                        ]
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('GET', 'api/v1/invoices/1');

        // assert response code and message
        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);

    }

    public function test_get_not_found(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'getInvoice' => NULL
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('GET', 'api/v1/invoices/1');

        // assert response code and message
        $this->assertResponseCode(404);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_post_success(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'createInvoice' => 1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set data to be sent
        $data = json_encode([
            'id' => '1',
            'order_id' => '1',
            'total' => '10000',
            'status' => 'incomplete'
        ]);

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('POST', 'api/v1/invoices/', $data);

        // assert response code and message
        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);

    }

    public function test_post_failed(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'createInvoice' => -1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set data to be sent
        $data = json_encode([
            'id' => '1',
            'order_id' => '1',
            'total' => '10000',
            'status' => 'incomplete'
        ]);

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('POST', 'api/v1/invoices/', $data);

        // assert response code and message
        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_put_success(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'updateInvoice' => 1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set data to be sent
        $data = json_encode([
            'status' => 'pending'
        ]);

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('PUT', 'api/v1/invoices/1', $data);

        // assert response code and message
        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);

    }

    public function test_put_failed(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'updateInvoice' => -1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set data to be sent
        $data = json_encode([
            'status' => 'pending'
        ]);

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('PUT', 'api/v1/invoices/1', $data);

        // assert response code and message
        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_put_null_id(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'updateInvoice' => -1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set data to be sent
        $data = json_encode([
            'status' => 'pending'
        ]);

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('PUT', 'api/v1/invoices/', $data);

        // assert response code and message
        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_delete_success(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'deleteInvoice' => 1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('DELETE', 'api/v1/invoices/1');

        // assert response code and message
        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);

    }

    public function test_delete_failed(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'deleteInvoice' => -1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('DELETE', 'api/v1/invoices/1');

        // assert response code and message
        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_delete_null_id(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'deleteInvoice' => -1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('DELETE', 'api/v1/invoices/');

        // assert response code and message
        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_put_order_success(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'updateInvoiceByOrderId' => 1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set data to be sent
        $data = json_encode([
            'status' => 'pending'
        ]);

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('PUT', 'api/v1/invoices/orders/1', $data);

        // assert response code and message
        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);

    }

    public function test_put_order_failed(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'updateInvoiceByOrderId' => -1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set data to be sent
        $data = json_encode([
            'status' => 'pending'
        ]);

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('PUT', 'api/v1/invoices/orders/1', $data);

        // assert response code and message
        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_put_order_null_id(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'updateInvoiceByOrderId' => -1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set data to be sent
        $data = json_encode([
            'status' => 'pending'
        ]);

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('PUT', 'api/v1/invoices/orders/', $data);

        // assert response code and message
        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_delete_order_success(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'deleteInvoiceByOrderId' => 1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('DELETE', 'api/v1/invoices/orders/1');

        // assert response code and message
        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);

    }

    public function test_delete_order_failed(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'deleteInvoiceByOrderId' => -1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('DELETE', 'api/v1/invoices/orders/1');

        // assert response code and message
        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_delete_order_null_id(){
        // mock model on tested class' constructor and mock model's function
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'deleteInvoiceByOrderId' => -1
                    ]
                );
                // use mocked model to be loaded
                $CI->Invoice_model = $model;
            }
        );

        // set request as JSON
        $this->request->setHeader('Content-type', 'application/json');

        // send request
        $output = $this->request('DELETE', 'api/v1/invoices/orders/');

        // assert response code and message
        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);

    }

    public function test_create_success()
    {
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'createInvoice' => 1
                    ]
                );
                $CI->Invoice_model = $model;
            }
        );

        $this->request->setHeader('Content-type', 'application/json');

        $data = [
            'order_id' => '1',
            'total' => '10000',
            'status' => 'incomplete'
        ];

        $output = $this->request('POST', 'api/v1/invoices', $data);

        $this->assertResponseCode(201);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);
        $this->assertStringContainsStringIgnoringCase('created successfully', $output);
    }

    public function test_create_fail()
    {
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'createInvoice' => 0
                    ]
                );
                $CI->Invoice_model = $model;
            }
        );

        $this->request->setHeader('Content-type', 'application/json');

        $data = [
            'order_id' => '1'
            // Datos incompletos
        ];

        $output = $this->request('POST', 'api/v1/invoices', $data);

        $this->assertResponseCode(400);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);
    }

    public function test_update_success()
    {
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'updateInvoice' => 1,
                        'getInvoice' => [
                            'id' => '1',
                            'order_id' => '1',
                            'total' => '10000',
                            'status' => 'complete'
                        ]
                    ]
                );
                $CI->Invoice_model = $model;
            }
        );

        $this->request->setHeader('Content-type', 'application/json');

        $data = [
            'status' => 'complete'
        ];

        $output = $this->request('PUT', 'api/v1/invoices/1', $data);

        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);
        $this->assertStringContainsStringIgnoringCase('updated successfully', $output);
    }

    public function test_update_not_found()
    {
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'updateInvoice' => 0,
                        'getInvoice' => NULL
                    ]
                );
                $CI->Invoice_model = $model;
            }
        );

        $this->request->setHeader('Content-type', 'application/json');

        $data = [
            'status' => 'complete'
        ];

        $output = $this->request('PUT', 'api/v1/invoices/999', $data);

        $this->assertResponseCode(404);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);
    }

    public function test_delete_success()
    {
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'deleteInvoice' => 1,
                        'getInvoice' => [
                            'id' => '1',
                            'order_id' => '1',
                            'total' => '10000',
                            'status' => 'incomplete'
                        ]
                    ]
                );
                $CI->Invoice_model = $model;
            }
        );

        $this->request->setHeader('Content-type', 'application/json');
        $output = $this->request('DELETE', 'api/v1/invoices/1');

        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);
        $this->assertStringContainsStringIgnoringCase('deleted successfully', $output);
    }

    public function test_delete_not_found()
    {
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'deleteInvoice' => 0,
                        'getInvoice' => NULL
                    ]
                );
                $CI->Invoice_model = $model;
            }
        );

        $this->request->setHeader('Content-type', 'application/json');
        $output = $this->request('DELETE', 'api/v1/invoices/999');

        $this->assertResponseCode(404);
        $this->assertStringContainsStringIgnoringCase('FALSE', $output);
    }

    public function test_update_by_order_id_success()
    {
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'updateInvoiceByOrderId' => 1
                    ]
                );
                $CI->Invoice_model = $model;
            }
        );

        $this->request->setHeader('Content-type', 'application/json');

        $data = [
            'status' => 'complete'
        ];

        $output = $this->request('PUT', 'api/v1/invoices/order/1', $data);

        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);
    }

    public function test_delete_by_order_id_success()
    {
        $this->request->setCallable(
            function ($CI) {
                $model = $this->getDouble(
                    'Invoice_model', [
                        'deleteInvoiceByOrderId' => 1
                    ]
                );
                $CI->Invoice_model = $model;
            }
        );

        $this->request->setHeader('Content-type', 'application/json');
        $output = $this->request('DELETE', 'api/v1/invoices/order/1');

        $this->assertResponseCode(200);
        $this->assertStringContainsStringIgnoringCase('TRUE', $output);
    }
}