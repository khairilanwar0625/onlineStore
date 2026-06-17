<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items()  { return $this->hasMany(Item::class); }
    public function user()   { return $this->belongsTo(User::class); }

    public function getId()       { return $this->attributes['id']; }
    public function getTotal()    { return $this->attributes['total']; }
    public function getUserId()   { return $this->attributes['user_id']; }
    public function getCreatedAt(){ return $this->attributes['created_at']; }
    public function getItems()    { return $this->items; }
    public function getUser()     { return $this->user; }

    public function setTotal($total)   { $this->attributes['total'] = $total; }
    public function setUserId($userId) { $this->attributes['user_id'] = $userId; }
}