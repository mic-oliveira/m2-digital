<?php

it('should return a list of products', function () {
    $response = $this->get('/api/products');

    $response->assertOk();
});
