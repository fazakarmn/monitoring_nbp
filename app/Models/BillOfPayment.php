<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BillOfPayment extends Model {
    protected $fillable = ['project_id','payment_name','invoice_no','contract_value','work_name','total','percentage','status','due_payment','description'];
    protected $casts = ['due_payment'=>'date'];
    public function project() { return $this->belongsTo(Project::class); }
}
