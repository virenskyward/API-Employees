<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'email',
        'phone_no',
        'gender',
        'date_of_birth',
        'marital_status',
        'pin',
        'clock_status',
        'user_status',
        'created_by',
        'created_at',
        'emergency_contact_person',
        'emergency_contact_number',
        'relationshipe',
        'registration_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Appends the day status field in user response.
     *
     * @return int
     */
    protected $appends = ['day_status'];

    /**
     * Return the store status if store start then return 1 otherwise return 0.
     *
     * @return int
     */
    public function getDayStatusAttribute()
    {
        return StoreTimesheet::whereNull('store_end_at')->orderBy('store_timesheet_id', 'DESC')->exists() ? 1 : 0 ;
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function usertimesheet()
    {
        return $this->belongsTo(UserTimesheet::class, 'user_id', 'user_id');
    }
}