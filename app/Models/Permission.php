<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'permission_id';

    /**
     * The timestamps set timestamps value.
     *
     * @var string
     */
    public $timestamps = false;

    protected $fillable = [
        'permission_id',
        'user_id',
        'role_id',
        'permission_action_id',
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

    //Get the user permission action
    public function permissionAction()
    {
        return $this->hasOne(PermissionAction::class, 'permission_action_id', 'permission_action_id');
    }
}