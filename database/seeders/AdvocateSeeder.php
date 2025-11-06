<?php

namespace Database\Seeders;

use App\Models\Advocate;
use App\Models\BarAssociation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AdvocateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('seeders/final_bar_association_data_for_db.csv');

        if (!File::exists($csvFile)) {
            $this->command->error("CSV file not found at: {$csvFile}");
            return;
        }

        $this->command->info("Reading CSV file...");

        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header row

        $count = 0;
        $barAssociationCache = [];

        while (($row = fgetcsv($file)) !== false) {
            // Map CSV columns to array
            $data = array_combine($header, $row);

            // Get or find bar association ID
            $barAssociationId = null;
            if (!empty($data['permanent_member_of_bar_association'])) {
                $barAssociationName = trim($data['permanent_member_of_bar_association']);

                // Use cache to avoid repeated database queries
                if (!isset($barAssociationCache[$barAssociationName])) {
                    $barAssociation = BarAssociation::where('name', $barAssociationName)->first();
                    $barAssociationCache[$barAssociationName] = $barAssociation?->id;
                }

                $barAssociationId = $barAssociationCache[$barAssociationName];
            }

            // Create advocate
            Advocate::create([
                'bar_association_id' => $barAssociationId,
                'name' => !empty($data['name']) ? trim($data['name']) : null,
                'father_husband_name' => !empty($data['father_husband_name']) ? trim($data['father_husband_name']) : null,
                'complete_address' => !empty($data['complete_address']) ? trim($data['complete_address']) : null,
                'permanent_member_of_bar_association' => !empty($data['permanent_member_of_bar_association']) ? trim($data['permanent_member_of_bar_association']) : null,
                'visitor_member_of_bar_association' => !empty($data['visitor_member_of_bar_association']) ? trim($data['visitor_member_of_bar_association']) : null,
                'date_of_enrolment_lower_courts' => $this->parseDate($data['date_of_enrolment_lower_courts'] ?? ''),
                'date_of_enrolment_high_court' => $this->parseDate($data['date_of_enrolment_high_court'] ?? ''),
                'date_of_enrolment_supreme_court' => $this->parseDate($data['date_of_enrolment_supreme_court'] ?? ''),
                'voter_member_of_bar_association' => !empty($data['voter_member_of_bar_association']) ? trim($data['voter_member_of_bar_association']) : null,
                'duration_of_practice' => $this->parseDate($data['duration_of_practice'] ?? ''),
                'mobile_no' => !empty($data['mobile_no']) ? trim($data['mobile_no']) : null,
                'email_address' => !empty($data['email_address']) ? trim($data['email_address']) : null,
                'is_active' => true,
            ]);

            $count++;
        }

        fclose($file);

        $this->command->info("Successfully created {$count} advocates from CSV.");
    }

    /**
     * Parse date string and return valid date or null
     */
    private function parseDate($dateString): ?string
    {
        $dateString = trim($dateString);

        // Return null for empty, NULL string, or invalid dates like 1970-01-01
        if (
            empty($dateString) ||
            strtoupper($dateString) === 'NULL' ||
            $dateString === '1970-01-01'
        ) {
            return null;
        }

        return $dateString;
    }
}