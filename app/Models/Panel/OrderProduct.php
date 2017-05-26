<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = "orders_products";

    protected $fillable = ["order_id", "product_id", "quantity"];

    protected $guarded = ["created_at", "updated_at"];
}
