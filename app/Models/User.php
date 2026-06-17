<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getId()      { return $this->attributes['id']; }
    public function getName()    { return $this->attributes['name']; }
    public function getEmail()   { return $this->attributes['email']; }
    public function getIsAdmin() { return $this->attributes['is_admin']; }

    public function isAdmin()
    {
        return $this->attributes['is_admin'] == true;
    }
}