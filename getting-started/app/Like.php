<?php
//php artisan make:model Like -m
//Para añadir una migracion a un modelo existente: php artisan make:migration create_posts_table

//Para correr la migracion (Realizar las acciones a la bd) : php artisan migrate
//Para rollback: php artisan migrate:rollback a la ultima migracion
//rollback de todas las migraciones: php artisan migrate: reset

//para correr migraciones despues de realizar una actualizacion en las tablas
//php artisan migrate:refresh --seed
namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function post(){
        return $this->belongsTo('App\Post', 'post_id');
    }
}
