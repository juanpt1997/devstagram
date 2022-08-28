<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ? Crearemos la  para los posts
    public function posts()
    {
        return $this->hasMany(Post::class);
        // ? En caso de que me salga de la convención que entiende laravel
        // return $this->hasMany(Post::class, 'id_usuario');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // ? ALMACENA LOS SEGUIDORES DE UN USUARIO
    // ? Acá nos salimos un poco de la convención
    public function followers()
    {
        // El método followers en la tabla de followers pertenece a muchos usuarios
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')->withTimestamps();
        //The third argument is the foreign key name of the model on which you are defining the relationship, while the fourth argument is the foreign key name of the model that you are joining to:
    }

    // ALMACENAR LOS QUE SEGUIMOS
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')->withTimestamps();
    }

    // Comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user)
    {
        return $this->followers->contains($user->id);
    }

}
