<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
  

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'address',
    ];


     /**
     * Define la relación uno a muchos con las ventas (Sales).
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // /**
    //  * Define la relación uno a muchos con las facturas (Invoices).
    //  */
    // public function invoices()
    // {
    //     return $this->hasMany(Invoice::class);
    // }


}
