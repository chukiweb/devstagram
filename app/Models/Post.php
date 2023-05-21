<?php

namespace App\Models;

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

    //Relación de un post pertenece a un usuairo
    public function user()
    {
        return $this->belongsTo(User::class)->select(['username','name']);
    }

    //Creamos la relacion de los comentarios con los post 
    //Un post puede tener muchos comentarios pero un comentario 
    //pertenece a un post
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    /**
     * Relacion de los like con el post 
     * Un post tiene muchoa likes
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Función que comprueba si el usuario le a dado like a la publicación
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }


}
