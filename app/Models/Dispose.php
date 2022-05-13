<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispose extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'disposes';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function inbox()
    {
        return $this->belongsTo(Inbox::class, 'inboxes_id', 'id');
    }

    public function classify()
    {
        return $this->belongsTo(Classify::class, 'classifies_id', 'id');
    }
}
