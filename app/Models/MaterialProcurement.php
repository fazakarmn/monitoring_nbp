<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MaterialProcurement extends Model {
    protected $fillable = [
        'project_id', 'part_no', 'no_po', 'supplier',
        'qty_ordered', 'qty_received', 'harga_satuan',
        'tanggal_po', 'eta', 'tanggal_tiba',
        'mtc', 'no_surat_jalan', 'termin_pembayaran', 'status',
        'deskripsi', 'qty', 'grade'
    ];
    
    protected $casts = [
        'tanggal_po' => 'date',
        'eta' => 'date',
        'tanggal_tiba' => 'date',
        'harga_satuan' => 'decimal:2',
    ];
    public function project() { return $this->belongsTo(Project::class); }
}
