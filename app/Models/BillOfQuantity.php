<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BillOfQuantity extends Model {
    protected $fillable = ['project_id','material','specification','quantity','unit','unit_price','subtotal','progress_percent','info'];
    public function project() { return $this->belongsTo(Project::class); }
}
