<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    // Un post puede tener muchos comentarios
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    // likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
