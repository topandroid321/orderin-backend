<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'redirect_to',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'role_id', 'id');
    }
    
}
