<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = ["total_price"];

    protected $guarded = ["created_at", "updated_at"];
}
