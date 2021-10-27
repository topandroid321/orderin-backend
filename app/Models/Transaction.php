<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'atas_nama',
        'no_meja',
        'payment',
        'total_price',
        'catatan',
        'status',
    ];

     public function user(){
         return $this->belongsTo(User::class, 'user_id', 'id');
     }

     public function items(){
        return $this->hasMany(Transactionitems::class, 'transaction_id', 'id');
     }
}
