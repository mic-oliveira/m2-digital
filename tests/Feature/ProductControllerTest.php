<?php

it('has productcontroller page', function () {
    $response = $this->get('/productcontroller');

    $response->assertStatus(200);
});
