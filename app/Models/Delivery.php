<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Delivery extends Model {
    protected $fillable = [
        'project_id','product' ,'work_order', 'delivery_date', 'status', 'received_by', 'location',
        'document_no', 'customer', 'section', 'rev', 'assembly_no', 'quantity', 'class', 'description',
        'length_mm', 'weight_kg', 'total_weight_kg', 'remark'
    ];
    protected $casts = ['delivery_date'=>'date'];
    public function project() { return $this->belongsTo(Project::class); }
}
