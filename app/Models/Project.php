<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'customer', 'bridge_type', 'work_order', 'contract_value', 'timeline_start', 'timeline_end',
        'bill_of_quantity_ton', 'status',
        'prog_bill_of_payment', 'prog_design_engineering', 'prog_bill_of_material',
        'prog_material_take_off', 'prog_material_procurement',
        'prog_fabrication', 'prog_galvanized', 'prog_delivery',
        'mto_data', 'bom_data', 'boq_data', 'fabrication_data', 'galvanized_data',
        'design_document', 'design_documents', 'design_date',
    ];

    protected $casts = [
        'timeline_start'    => 'date',
        'timeline_end'      => 'date',
        'mto_data'          => 'array',
        'bom_data'          => 'array',
        'boq_data'          => 'array',
        'fabrication_data'  => 'array',
        'galvanized_data'   => 'array',
        'design_documents'  => 'array',
        'design_date'       => 'date',
    ];

    protected static function booted()
    {
        static::saving(function ($project) {
            $progressFields = [
                'prog_bill_of_payment', 'prog_design_engineering', 'prog_bill_of_material',
                'prog_material_take_off', 'prog_material_procurement',
                'prog_fabrication', 'prog_galvanized', 'prog_delivery',
            ];

            $allEmptyOrZero = true;
            $allHundred = true;

            foreach ($progressFields as $field) {
                $value = $project->$field;
                if ($value === null || $value === '' || (int)$value === 0) {
                    $allHundred = false;
                } else {
                    $allEmptyOrZero = false;
                    if ((int)$value < 100) {
                        $allHundred = false;
                    }
                }
            }

            if ($allEmptyOrZero) {
                $project->status = 'pending';
            } elseif ($allHundred) {
                $project->status = 'done';
            } else {
                $project->status = 'on-going';
            }
        });
    }

    public function billOfQuantities(): HasMany
    {
        return $this->hasMany(BillOfQuantity::class);
    }

    public function billOfPayments(): HasMany
    {
        return $this->hasMany(BillOfPayment::class);
    }

    public function designEngineerings(): HasMany
    {
        return $this->hasMany(DesignEngineering::class);
    }

    public function billOfMaterials(): HasMany
    {
        return $this->hasMany(BillOfMaterial::class);
    }

    public function materialTakeOffs(): HasMany
    {
        return $this->hasMany(MaterialTakeOff::class);
    }

    public function materialProcurements(): HasMany
    {
        return $this->hasMany(MaterialProcurement::class);
    }

    public function fabrications(): HasMany
    {
        return $this->hasMany(Fabrication::class);
    }

    public function galvanizeds(): HasMany
    {
        return $this->hasMany(Galvanized::class);
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'done'     => 'badge-done',
            'on-going' => 'badge-ongoing',
            default    => 'badge-pending',
        };
    }
}
