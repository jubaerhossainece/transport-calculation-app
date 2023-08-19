<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportSubmode extends Model
{
    use HasFactory;

    public function modes() {
        return $this->belongsTo(TransportMode::class);
    }
}
