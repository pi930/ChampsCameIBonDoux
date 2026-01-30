<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
    public function panier()
{
    return $this->hasOne(\App\Models\Panier::class);
}

}
