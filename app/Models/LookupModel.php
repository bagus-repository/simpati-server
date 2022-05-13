<?php

namespace App\Models;

use App\Domains\LookupCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookupModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lookups';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'lookup_id';

    /**
     * Scope a query to only include by category id
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetCategoryById($query, $id)
    {
        return $query->where([
            'category_id' => $id,
            'sts' => 1
        ]);
    }

    public function lcontent()
    {
        return $this->hasOne(Content::class, 'name', 'lookup_value');
    }
}
