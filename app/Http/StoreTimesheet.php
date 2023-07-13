<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreTimesheet extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'store_timesheet_id';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'store_timesheets';
    
    protected $fillable = [
        'store_timesheet_id',
        'store_start_at',
        'store_end_at',
        'created_from',
        'update_from',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
