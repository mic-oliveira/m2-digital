<?php

namespace App\Http\Resources;

trait IncludesTrait
{

    public function includes($include): bool
    {
        $request = request();
        $includes = array_flip(explode(',', $request->query('include')));
        return array_key_exists($include,$includes);
    }
}
