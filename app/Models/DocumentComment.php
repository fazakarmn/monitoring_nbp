<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order',
        'section',
        'user_id',
        'comment',
    ];

    public function user()
    {
        return $table = $this->belongsTo(User::class);
    }
}