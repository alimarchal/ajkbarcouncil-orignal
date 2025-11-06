<?php

namespace Database\Seeders;

use App\Models\BarAssociation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarAssociationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Old seeder data (commented out)
        // $bar_associations = [
        //     'Central Bar Association Muzaffarabad',
        //     'District Bar Association Bagh',
        //     'District Bar Association Bhimber',
        //     'District Bar Association Haveli',
        //     'District Bar Association Jhelum',
        //     'District Bar Association Kotli',
        //     'District Bar Association Mirpur',
        //     'District Bar Association Neelum',
        //     'District Bar Association Rawalakot',
        //     'District Bar Association Sudhnuti',
        // ];

        // Bar associations from actual data (sorted by total members descending)
        $bar_associations = [
            'Central Bar Association Muzaffarabad',
            'District Bar Association Mirpur',
            'District Bar Association Bagh',
            'Tehsil Bar Association Dadyal',
            'District Bar Association Bhimber',
            'District Bar Association Sudhnuti',
            'Tehsil Bar Association Dhirkot',
            'Tehsil Bar Association Pathika Naseerabad',
            'District Bar Association Jhelum Valley (Hattian Bala)',
            'Tehsil Bar Association Barnala',
            'District Bar Association Neelum',
            'Tehsil Bar Association Samahni',
            'District Bar Association Haveli Kahutta',
            'Tehsil Bar Association Sharda',
            'Tehsil Bar Association Trarkhal',
            'Tehsil Bar Association Balouch',
            'NOT SET BAR ASSOCIATION',
        ];

        foreach ($bar_associations as $association) {
            BarAssociation::create([
                'name' => $association,
                'is_active' => true,
            ]);
        }
    }
}
