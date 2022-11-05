<?php

namespace App\Http\Traits;

trait RequestWithIdTrait
{
    public function all( $keys = null ): array
    {
        $results = parent::all();
        $results['id'] = $this->route('id');

        return $results;
    }
}
