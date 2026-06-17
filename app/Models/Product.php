<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getId()         { return $this->attributes['id']; }
    public function getName()       { return $this->attributes['name']; }
    public function getPrice()      { return $this->attributes['price']; }
    public function getDescription(){ return $this->attributes['description']; }
    public function getImage()      { return $this->attributes['image']; }

    public function setName($name)        { $this->attributes['name'] = $name; }
    public function setPrice($price)      { $this->attributes['price'] = $price; }
    public function setDescription($desc) { $this->attributes['description'] = $desc; }
    public function setImage($image)      { $this->attributes['image'] = $image; }
}