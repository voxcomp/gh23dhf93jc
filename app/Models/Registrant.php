<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice', 'fname', 'lname', 'email', 'phone', 'cell', 'address', 'city', 'state', 'zip', 'country', 'gender', 'dob', 'wristband', 'group', 'econtact', 'enumber', 'medical', 'paid', 'option', 'towel', 'recumbent', 'camping', 'payid', 'paytype', 'discount', 'startdate', 'enddate', 'jersey', 'signature', 'signdate', 'adminnotes', 'ragbrais', 'charters', 'shower',
    ];
}
