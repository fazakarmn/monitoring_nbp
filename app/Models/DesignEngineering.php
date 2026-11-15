<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class DesignEngineering extends Model {
    protected $fillable = ['project_id','activity','drawing_no','presentation','percent'];
    public function project() { return $this->belongsTo(Project::class); }
}
