<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'location',
        'contact_info',
        'organisation_id'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'warehouse_id');
    }
}
