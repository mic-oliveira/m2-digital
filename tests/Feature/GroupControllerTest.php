<?php

it('should return a list of Groups', function () {
    $response = $this->get('/api/groups');

    $response->assertOk();
});
