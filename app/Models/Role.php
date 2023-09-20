<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $array)
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
