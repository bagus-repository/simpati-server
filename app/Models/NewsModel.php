<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['thumbnail'];

    /**
     * Scope a query to only include active
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('sts', 1);
    }

    /**
     * Scope a query to deactivate
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return int
     */
    public function scopeDeactivate($query, $id)
    {
        return $query->where('id', $id)->update(['sts' => 0]);
    }

    /**
     * Get the Thumbnail Attribute
     *
     * @param  string  $value
     * @return string
     */
    public function getThumbnailAttribute($value)
    {
        return asset('uploads/' . $this->image_url);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
