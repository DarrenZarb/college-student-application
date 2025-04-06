<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student; // Import the Student model

class College extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address'];

    /**
     * Define a one-to-many relationship:
     * A college can have multiple students.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
