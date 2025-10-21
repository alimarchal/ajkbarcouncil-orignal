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
        $bar_associations = [
            'Central Bar Association Muzaffarabad',
            'District Bar Association Bagh',
            'District Bar Association Bhimber',
            'District Bar Association Haveli',
            'District Bar Association Jhelum',
            'District Bar Association Kotli',
            'District Bar Association Mirpur',
            'District Bar Association Neelum',
            'District Bar Association Rawalakot',
            'District Bar Association Sudhnuti',
        ];

        foreach ($bar_associations as $association) {
            BarAssociation::create([
                'name' => $association,
                'is_active' => true,
            ]);
        }
    }
}
