<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    /** @use HasFactory<\Database\Factories\CvFactory> */

    use HasFactory;
    protected $fillable = [
        'filename',
        'file_path',
        'user_id',
        'file_type',
        'file_size'
    ];

    protected $table = "cvs";

    public function user(){
        return $this->belongsto(User::class);
    }

    
}
