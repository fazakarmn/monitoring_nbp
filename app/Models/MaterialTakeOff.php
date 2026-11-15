<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MaterialTakeOff extends Model {
    protected $fillable = ['project_id','material','length','area','total_weight_kg','allowance_percent','status'];
    public function project() { return $this->belongsTo(Project::class); }
}
