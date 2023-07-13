<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionModule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'permission_module_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permission_modules';

    protected $fillable = [
        'permission_module_id',
        'permission_module_name',
        'permission_module_status',
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

    /**
     * The timestamps set timestamps value.
     *
     * @var string
     */
    public $timestamps = false;

    public function permissionAction()
    {
        return  $this->hasMany(\App\Models\PermissionAction::class, 'permission_module_id', 'permission_module_id');
    }
}