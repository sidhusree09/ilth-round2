<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','short_description','description','video_url','start_date','end_date','user_id'];
    
    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function getCoverPicture()
    {
        if($this->image != ''){
            return asset('storage/cover/'.$this->image);
        }else{
            return asset('storage/defaults/cover.png');
        }     
    }
    
    public function deleteCoverImage()
    {
        if ($this->image) {
            Storage::delete('cover/'.$this->image);
            $this->image = '';
            $this->save();
        }
    }
    
    public function totalEnrollments()
    {
        return $this->belongsTo(Enrollment::class)->count();
    }
        
}
