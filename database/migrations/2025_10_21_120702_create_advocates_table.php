<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advocates', function (Blueprint $table) {
            // Primary identifier - UUID
            $table->uuid('id')->primary();

            // 1. Permanent Member of Bar Association (Foreign Key)
            $table->uuid('bar_association_id');
            $table->foreign('bar_association_id')->references('id')->on('bar_associations')->onDelete('cascade');

            // 2. Name
            $table->string('name');
            // 3. Father/Husband Name
            $table->string('father_husband_name');
            // 4. Complete Address
            $table->text('complete_address');

            // 5. Visitor Member of Bar Association
            $table->string('visitor_member_of_bar_association')->nullable();

            // 6-9. Date of Enrolment (Courts) and Voter Date
            $table->date('date_of_enrolment_lower_courts')->nullable();
            $table->date('date_of_enrolment_high_court')->nullable();
            $table->date('date_of_enrolment_supreme_court')->nullable();
            $table->date('voter_member_of_bar_association')->nullable();

            // 10. Duration of Practice (Assuming this stores the start date for calculation)
            $table->date('duration_of_practice')->nullable();

            // 11. Mobile No
            $table->string('mobile_no', 20);
            // 12. Email Address
            $table->string('email_address')->unique();

            // 13. Is Active
            $table->boolean('is_active')->default(true);

            $table->softDeletes();
            $table->userTracking();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advocates');
    }
};
