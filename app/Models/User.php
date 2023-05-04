<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function deleteProfilePicture()
    {
        if ($this->profile_picture) {
            Storage::delete('profile_picture/'.$this->profile_picture);
            $this->profile_picture = '';
            $this->save();
        }
    }
    
    
    public function getProfilePicture()
    {
        if($this->profile_picture != ''){
            return asset('storage/profile_pictures/'.$this->profile_picture);
        }else{
            return asset('storage/defaults/profile.jpg');
        }     
    }
    
    public function courseCount()
    {
        return $this->hasMany(Course::class)->count();
    }
    
    public function isAdmin()
    {        
            return $this->hasRole('Admin');
    }
    
    public function isInstructor()
    {
            return $this->hasRole('Instructor');
    }
    
    public function isStudent()
    {
            return $this->hasRole('Student');
    }
    
    public function enrollments()
    {
        return $this->hasMany('App\Models\Enrollment');
    }
    
    public function isEnrolled($course_id)
    {
        return $this->enrollments()->where('course_id', $course_id)->exists();
    }
        
}
