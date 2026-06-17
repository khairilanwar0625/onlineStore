<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function product() { return $this->belongsTo(Product::class); }

    public function getId()        { return $this->attributes['id']; }
    public function getQuantity()  { return $this->attributes['quantity']; }
    public function getPrice()     { return $this->attributes['price']; }
    public function getOrderId()   { return $this->attributes['order_id']; }
    public function getProductId() { return $this->attributes['product_id']; }
    public function getProduct()   { return $this->product; }

    public function setQuantity($qty)        { $this->attributes['quantity'] = $qty; }
    public function setPrice($price)         { $this->attributes['price'] = $price; }
    public function setOrderId($orderId)     { $this->attributes['order_id'] = $orderId; }
    public function setProductId($productId) { $this->attributes['product_id'] = $productId; }
}