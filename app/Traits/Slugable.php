<?php

declare(strict_types=1);

namespace App\Traits;

use App\Services\HashService;
use Hashids\Hashids;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;

/**
 * @property string $slug
 * @method Builder|static whereSlug(array $attributes)
 */
trait Slugable
{
    abstract public function slugSource(): string;

    public static function bootSlugable()
    {
        static::saving(function (self $model) {
            $model->slug = $model->generateSlug();
        });
    }

    private function generateSlug(): string
    {
        $source = $this->slugSource();
        return Str::slug($this[$source]);
    }

    /**
     * @param string $slug
     * @return string
     */
    public function getSlugAttribute(string $slug): string
    {
        $key = $this->getKeyName();
        $id = $this[$key];
        $hashids = new Hashids();
        $id = $hashids->encode($id);
        return "$id-$slug";
    }

    public function scopeWhereSlug(Builder $query, string $slug)
    {
        $table = $this->getTable();
        $key = $this->getKeyName();

        [$id] = explode('-', $slug);
        $id = HashService::decode($id);
        $query->where($table . '.' . $key, $id);
    }
    
}
