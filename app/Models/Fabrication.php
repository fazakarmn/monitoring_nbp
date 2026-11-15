<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Fabrication extends Model {
    protected $fillable = ['project_id','process','date','vendor','status','description'];
    protected $casts = ['date'=>'date'];
    public function project() { return $this->belongsTo(Project::class); }
}
