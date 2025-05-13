<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'ingredients', 'steps', 'duration', 'difficulty', 'image', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get all favorites for this recipe.
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'item_id')
            ->where('item_type', self::class);
    }

    /**
     * Get all of the users who favorited this recipe.
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'item_id', 'user_id')
            ->wherePivot('item_type', self::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
