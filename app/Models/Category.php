<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Builder
 *
 */
class Category extends Model
{
    use HasFactory;
    use Slugable;

    protected $fillable = [
        'slug',
        'title'
    ];

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::creating(function (Category $category) {
//            $category->slug = $category->slug ?? str($category->title)->slug();
//        });
//    }

    public function slugSource(): string
    {
        return 'title';
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

}
