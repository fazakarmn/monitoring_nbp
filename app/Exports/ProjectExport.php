<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProjectExport implements WithMultipleSheets, Export
{
    use Exportable;

    public function __construct(protected Project $project) {}

    public function sheets(): array
    {
        return [
            new Sheets\ProjectInfoSheet($this->project),
            new Sheets\BoqSheet($this->project),
            new Sheets\BopSheet($this->project),
            new Sheets\BomSheet($this->project),
            new Sheets\MtoSheet($this->project),
            new Sheets\ProcurementSheet($this->project),
            new Sheets\FabricationSheet($this->project),
            new Sheets\GalvanizedSheet($this->project),
            new Sheets\DeliverySheet($this->project),
        ];
    }
}
