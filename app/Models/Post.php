<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // ? Relación un post pertenece a un usuario
    // public function autor()
    public function user()
    {
        // return $this->belongsTo(User::class);
        // ? Podemos restringir que ver
        // return $this->belongsTo(User::class, 'user_id')->select(['name', 'username']);
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
}
