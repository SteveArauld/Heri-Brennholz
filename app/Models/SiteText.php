<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteText extends Model
{
    /** @var list<string> */
    protected $fillable = ['locale', 'key', 'value'];
}
