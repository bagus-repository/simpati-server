<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Efilling extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'public_services';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'service_no';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['file_link'];

    /**
     * Get the File
     *
     * @param  string  $value
     * @return string
     */
    public function getFileLinkAttribute($value)
    {
        return asset('efilling/' . $this->service_code . '/' . $this->file);
    }

    public function filling_type()
    {
        return $this->belongsTo(LookupModel::class, 'service_code', 'lookup_value');
    }

    public function request_by()
    {
        return $this->belongsTo(User::class, 'requestor', 'id');
    }

    public function approval_by()
    {
        return $this->belongsTo(User::class, 'apv_by', 'id');
    }
    
    /**
     * Get Next PK
     *
     * @return string
     */
    public static function getNextPK()
    {
        $result = DB::selectOne('select case
            when coalesce(max(right(service_no, 3)), 0) + 1 = 1000 then 1
            else coalesce(max(right(service_no, 3)), 0) + 1 end as maxId, yearweek(curdate()) as yearweek
            from public_services where substring(service_no, 2, 6) = yearweek(curdate())');
        return 'E' . $result->yearweek . sprintf('%03d', $result->maxId);
    }
}
