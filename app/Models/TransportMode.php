<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportMode extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function submodes(){
        return $this->hasMany(TransportSubmode::class, 'transport_mode_id', 'id');
    }
}
