<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    use Slugable;

    protected $fillable = [
        'slug',
        'title',
        'thumbnail',
    ];

    public function slugSource(): string
    {
        return 'title';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
