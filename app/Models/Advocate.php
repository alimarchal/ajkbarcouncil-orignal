<?php

namespace App\Models;

use App\Traits\UserTracking;
use App\Models\BarAssociation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advocate extends Model
{
    use HasFactory, SoftDeletes, UserTracking, HasUuids;

    protected $fillable = [
        'bar_association_id',
        'name',
        'father_husband_name',
        'complete_address',
        'visitor_member_of_bar_association',
        'date_of_enrolment_lower_courts',
        'date_of_enrolment_high_court',
        'date_of_enrolment_supreme_court',
        'voter_member_of_bar_association',
        'permanent_member_of_bar_association',
        'duration_of_practice',
        'mobile_no',
        'email_address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'date_of_enrolment_lower_courts' => 'date',
        'date_of_enrolment_high_court' => 'date',
        'date_of_enrolment_supreme_court' => 'date',
        'duration_of_practice' => 'date',
    ];

    /**
     * Get the Bar Association this advocate belongs to.
     */
    public function barAssociation(): BelongsTo
    {
        return $this->belongsTo(BarAssociation::class);
    }
}
