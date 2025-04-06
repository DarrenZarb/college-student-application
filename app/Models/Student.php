<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\College; 

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'dob', 'college_id'];

    /**
     * Define the inverse relationship:
     * A student belongs to one college.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function college()
    {
        return $this->belongsTo(College::class);
    }
}
