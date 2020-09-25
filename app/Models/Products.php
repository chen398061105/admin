<?php

namespace App\Models;

use App\Models\Interfaces\AdminMenuInterface;
use App\Models\Traits\AdminMenuTrait;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $guarded = [];

    //时间维护
    public $timestamps = false;
}
