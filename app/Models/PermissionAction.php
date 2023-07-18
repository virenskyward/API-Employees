<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionAction extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permission_actions';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'permission_action_id';

    /**
     * The timestamps set timestamps value.
     *
     * @var string
     */
    public $timestamps = false;

    protected $fillable = [
        'permission_action_id',
        'permission_module_id',
        'permission_action_name',
        'permission_action_status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
        'permission_action_label'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // // Return the Action
    // public function permission()
    // {
    //     return $this->hasMany(\App\Models\Permission::class, 'permission_action_id', 'permission_action_id');
    // }

    // Return the Action
    public function permissionModule()
    {
        return $this->hasMany(\App\Models\PermissionModule::class, 'permission_module_id', 'permission_module_id');
    }
}