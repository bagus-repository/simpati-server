<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'outboxes';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
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
     * @param int $id
     * @return int
     */
    public function scopeDeactivate($query, $id)
    {
        return $query->where('id', $id)->update(['sts' => 0]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
