<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    // Define any relationships or additional methods as needed'

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
