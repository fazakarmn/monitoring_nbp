<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BillOfMaterial extends Model {
    protected $fillable = ['project_id','item','category','description_qty','specification','nominal_weight','note'];
    public function project() { return $this->belongsTo(Project::class); }
}
