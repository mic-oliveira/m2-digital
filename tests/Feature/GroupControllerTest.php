<?php

it('has groupcontroller page', function () {
    $response = $this->get('/groupcontroller');

    $response->assertStatus(200);
});
