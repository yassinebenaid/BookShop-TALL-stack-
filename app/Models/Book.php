<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory, HasUuids;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function wishlist()
    {
        return $this->belongsToMany(User::class, "wishlist", "book_id", "user_id");
    }


    public function getDiscountedPriceAttribute()
    {
        if (is_nan($this->price) || $this->discount == 0) return null;

        return $this->price - (($this->price * $this->discount) / 100);
    }



    public function scopeFilter($query, array $filters)
    {
        // search
        $query->when($filters["keywords"] ?? false, function ($query, $keywords) {
            $query->whereExists(function ($query) use ($keywords) {
                $query->whereFullText(["name", "description", "author"], $keywords);
                $query->orWhere("name", "like", "%" . $keywords . "%")->orderBy("name");
            });
        });

        // release year
        $query->when($filters["year"] ?? false, function ($query, $year) {
            $query->whereExists(fn ($query) => $query->where("release_year", $year));
        });

        // price
        $query->when($filters["price"] ?? false, function ($query, $price) {

            ["min" => $min, "max" => $max] = $price;


            if ($max && $min) $query->whereExists(fn ($query) =>  $query->whereBetween("price", [$min, $max]));
            elseif ($max) $query->whereExists(fn ($query) =>  $query->where("price", "<=", $max));
            elseif ($min) $query->whereExists(fn ($query) =>  $query->where("price", ">=", $min));
        });

        // rate
        $query->when($filters["ages"] ?? false, function ($query, $ages) {

            $query->whereExists(fn ($query) => $query->whereIn("age_class", $ages));
        });
    }
}
