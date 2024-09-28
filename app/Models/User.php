<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;



class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $logAttributes = ['name', 'email'];
    protected static $logName = 'user';

    protected static function booted()
    {
        static::created(function ($user) {
            activity()
                ->performedOn($user)
                ->causedBy(auth()->user())
                ->log('User created.');
        });

        static::updated(function ($user) {
            Log::info('Update event triggered for user ID: ' . $user->id);
            activity()
                ->performedOn($user)
                ->causedBy(auth()->user())
                ->log('User updated.');
        });
    }
}
