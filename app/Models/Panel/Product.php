<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = ["name", "price", "stock_quantity"];

    protected $guarded = ["created_at", "updated_at"];
}
