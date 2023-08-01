<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShiftScheduler extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'shift_scheduler_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shift_schedulers';

    protected $fillable = [
        'shift_scheduler_id',
        'shift_scheduler_uid',
        'employee_id',
        'shift_date',
        'shift_start_time',
        'shift_end_time',
        'shift_total_time',
        'created_from',
        'Updated_from',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'user_id');
    }

    public function leaveRequest()
    {
        return $this->hasOne(LeaveRequest::class, 'employee_id', 'employee_id');
    }
}