<?php

namespace App\Http\Controllers;

use App\Models\Registrant;

class DataController extends Controller
{
    public function searchEmail($email)
    {
        $client = Registrant::where('email', 'like', $email.'%')->first();
        if (! empty($client) && $client->count() == 1) {
            return json_encode((object) $client->toArray());
        } else {
            return '';
        }
    }
}
