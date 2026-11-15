<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\BillOfMaterial;
use App\Models\BillOfPayment;
use App\Models\BillOfQuantity;
use App\Models\Delivery;
use App\Models\DesignEngineering;
use App\Models\Fabrication;
use App\Models\Galvanized;
use App\Models\MaterialProcurement;
use App\Models\MaterialTakeOff;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@nbp.com'],
            [
                'name'     => 'Edward Lore',
                'password' => Hash::make('password'),
            ]
        );

        // Additional users
        // $users = [
        //     ['name' => 'Paljo',   'email' => 'paljo@nbp.com',   'password' => Hash::make('password')],
        //     ['name' => 'Michael', 'email' => 'michael@nbp.com', 'password' => Hash::make('password')],
        //     ['name' => 'Rodri',   'email' => 'rodri@nbp.com',   'password' => Hash::make('password')],
        // ];
        foreach ($users as $u) {
            User::firstOrCreate(['email' => $u['email']], $u);
        }

        // Projects data
        $projects = [
            [
                'bridge_type'             => 'Girder A20',
                'work_order'              => 'O0001',
                'timeline_start'          => '2005-12-22',
                'timeline_end'            => '2026-08-17',
                'bill_of_quantity_ton'    => 4.0,
                'status'                  => 'done',
                'prog_bill_of_payment'    => 100,
                'prog_design_engineering' => 100,
                'prog_bill_of_material'   => 100,
                'prog_material_take_off'  => 100,
                'prog_material_procurement' => 100,
                'prog_fabrication'        => 100,
                'prog_galvanized'         => 100,
                'prog_delivery'           => 100,
            ],
            [
                'bridge_type'             => 'Girder B25',
                'work_order'              => 'O0002',
                'timeline_start'          => '2005-12-22',
                'timeline_end'            => '2026-08-17',
                'bill_of_quantity_ton'    => 4.7,
                'status'                  => 'on-going',
                'prog_bill_of_payment'    => 30,
                'prog_design_engineering' => 100,
                'prog_bill_of_material'   => 100,
                'prog_material_take_off'  => 40,
                'prog_material_procurement' => 10,
                'prog_fabrication'        => 0,
                'prog_galvanized'         => 0,
                'prog_delivery'           => 0,
            ],
            [
                'bridge_type'             => 'Girder C30',
                'work_order'              => 'O0003',
                'timeline_start'          => '2005-12-22',
                'timeline_end'            => '2026-08-17',
                'bill_of_quantity_ton'    => 3.2,
                'status'                  => 'on-going',
                'prog_bill_of_payment'    => 70,
                'prog_design_engineering' => 100,
                'prog_bill_of_material'   => 100,
                'prog_material_take_off'  => 100,
                'prog_material_procurement' => 100,
                'prog_fabrication'        => 50,
                'prog_galvanized'         => 0,
                'prog_delivery'           => 0,
            ],
            [
                'bridge_type'             => 'Girder C30',
                'work_order'              => 'O0004',
                'timeline_start'          => '2005-12-22',
                'timeline_end'            => '2026-08-17',
                'bill_of_quantity_ton'    => null,
                'status'                  => 'pending',
                'prog_bill_of_payment'    => 0,
                'prog_design_engineering' => 0,
                'prog_bill_of_material'   => 0,
                'prog_material_take_off'  => 0,
                'prog_material_procurement' => 0,
                'prog_fabrication'        => 0,
                'prog_galvanized'         => 0,
                'prog_delivery'           => 0,
            ],
        ];

        foreach ($projects as $pd) {
            $project = Project::firstOrCreate(['work_order' => $pd['work_order']], $pd);

            // Bill of Quantities
            BillOfQuantity::firstOrCreate(['project_id' => $project->id, 'material' => 'SJP'], [
                'specification' => 'BJ 41 SKSNI T-03',
                'quantity' => 12, 'unit' => 'ton',
                'unit_price' => 8750000, 'subtotal' => 105000000,
                'progress_percent' => $pd['prog_bill_of_material'],
                'info' => 'Rp.8.475.334',
            ]);
            BillOfQuantity::firstOrCreate(['project_id' => $project->id, 'material' => 'SJP Pelat'], [
                'specification' => 'BJ 41 SKSNI T-03',
                'quantity' => 12, 'unit' => 'ton',
                'unit_price' => 9120000, 'subtotal' => 109440000,
                'progress_percent' => $pd['prog_bill_of_material'],
                'info' => 'Rp.1.100',
            ]);

            // Bill of Payments
            BillOfPayment::firstOrCreate(['project_id' => $project->id, 'payment_name' => 'DP'], [
                'work_name' => 'Uang Muka',
                'total' => 30000000, 'percentage' => 30,
                'status' => $pd['prog_bill_of_payment'] >= 100 ? 'Paid' : ($pd['prog_bill_of_payment'] > 0 ? 'Partial' : 'Unpaid'),
                'due_payment' => '2026-03-01', 'description' => 'pembayaran pertama',
            ]);
            BillOfPayment::firstOrCreate(['project_id' => $project->id, 'payment_name' => 'Payment 2'], [
                'work_name' => 'Pelunasan',
                'total' => 70000000, 'percentage' => 70,
                'status' => $pd['prog_bill_of_payment'] >= 100 ? 'Paid' : 'Unpaid',
                'due_payment' => '2026-07-01', 'description' => 'pembayaran akhir',
            ]);

            // Design Engineering
            DesignEngineering::firstOrCreate(['project_id' => $project->id, 'activity' => 'Balok'], [
                'drawing_no' => 'Muda', 'presentation' => '100/1440mm',
                'percent' => $pd['prog_design_engineering'],
            ]);
            DesignEngineering::firstOrCreate(['project_id' => $project->id, 'activity' => 'Diafragma'], [
                'drawing_no' => 'Muda', 'presentation' => '200 x 200',
                'percent' => max(0, $pd['prog_design_engineering'] - 20),
            ]);

            // Bill of Materials
            BillOfMaterial::firstOrCreate(['project_id' => $project->id, 'item' => 'SJP'], [
                'category' => 'Primary', 'description_qty' => '100/1.440,100/760,100/760,100/760',
                'specification' => 'mm', 'nominal_weight' => 1, 'note' => 'Ordered',
            ]);
            BillOfMaterial::firstOrCreate(['project_id' => $project->id, 'item' => 'Joint'], [
                'category' => 'Secondary', 'description_qty' => 'Tensiion',
                'specification' => 'Stainless', 'nominal_weight' => 0.5, 'note' => 'Available',
            ]);

            // Material Take Offs
            MaterialTakeOff::firstOrCreate(['project_id' => $project->id, 'material' => 'SJP Pelat'], [
                'length' => 11400, 'area' => 0.5, 'total_weight_kg' => 3000,
                'allowance_percent' => 5, 'status' => 'Yes',
            ]);

            // Material Procurements
            MaterialProcurement::firstOrCreate(['project_id' => $project->id, 'material' => 'SJP Pelat Girder'], [
                'note' => '11/07/2025', 'total_weight_kg' => 6702, 'commercial_qty' => 71,
                'vendor' => 'vendor',
            ]);

            // Fabrications
            Fabrication::firstOrCreate(['project_id' => $project->id, 'process' => 'Assembly'], [
                'date' => '2026-05-26', 'vendor' => 'On Go',
                'status' => $pd['prog_fabrication'] >= 100 ? 'Done' : ($pd['prog_fabrication'] > 0 ? 'On-Go' : 'Pending'),
                'description' => 'Sesuai spesifikasi',
            ]);
            Fabrication::firstOrCreate(['project_id' => $project->id, 'process' => 'Painting'], [
                'date' => '2026-06-26', 'vendor' => 'Internal',
                'status' => $pd['prog_fabrication'] >= 100 ? 'Done' : 'Pending',
                'description' => 'Sesuai warna',
            ]);

            // Galvanized
            Galvanized::firstOrCreate(['project_id' => $project->id, 'process' => 'Priming'], [
                'date' => '2026-05-26',
                'status' => $pd['prog_galvanized'] >= 100 ? 'Done' : ($pd['prog_galvanized'] > 0 ? 'On-Go' : 'Pending'),
                'description' => 'Sesuai spesifikasi',
            ]);
            Galvanized::firstOrCreate(['project_id' => $project->id, 'process' => 'Galvanis Celup'], [
                'date' => '2026-07-06',
                'status' => $pd['prog_galvanized'] >= 100 ? 'Done' : 'Pending',
                'description' => 'Sesuai warna',
            ]);

            // Deliveries
            Delivery::firstOrCreate(['project_id' => $project->id, 'product' => 'P1C'], [
                'work_order' => '1000001T', 'delivery_date' => '2026-05-12',
                'status' => $pd['prog_delivery'] >= 50 ? 'Done' : 'Pending',
                'received_by' => 'P. Agung', 'location' => 'Jl. Raya 1',
            ]);
            Delivery::firstOrCreate(['project_id' => $project->id, 'product' => 'P1D'], [
                'work_order' => '2000002T', 'delivery_date' => '2026-05-13',
                'status' => $pd['prog_delivery'] >= 100 ? 'Done' : 'Pending',
                'received_by' => 'P. Agung', 'location' => 'Jl. Raya 2',
            ]);
        }

        // Activity Logs
        $allUsers = User::all();
        $activities = [
            ['activity' => 'update Bill Of Material', 'target' => 'Girder C30'],
            ['activity' => 'Update Design Engineer',  'target' => 'Girder B25'],
            ['activity' => 'Delete Girder C50',       'target' => 'Girder C50'],
            ['activity' => 'Add Project Girder A20',  'target' => 'Girder A20'],
            ['activity' => 'Update Bill Of Quantity', 'target' => 'Girder C30'],
        ];

        foreach ($activities as $i => $act) {
            ActivityLog::firstOrCreate(
                ['user_id' => $allUsers[$i % $allUsers->count()]->id, 'activity' => $act['activity']],
                ['target' => $act['target']]
            );
        }
    }
}
