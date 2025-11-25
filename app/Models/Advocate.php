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
        'duration_of_practice' => 'integer',
    ];

    /**
     * Get the Bar Association this advocate belongs to.
     */
    public function barAssociation(): BelongsTo
    {
        return $this->belongsTo(BarAssociation::class);
    }

    /**
     * Calculate detailed age difference from a date to now
     * Returns format: "X years, Y months, Z days"
     */
    public function getDetailedAgeDifference($date)
    {
        if (!$date) {
            return '';
        }

        $now = now();
        $interval = $date->diff($now);

        $parts = [];

        if ($interval->y > 0) {
            $parts[] = $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
        }

        if ($interval->m > 0) {
            $parts[] = $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
        }

        if ($interval->d > 0) {
            $parts[] = $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
        }

        if ($interval->h > 0) {
            $parts[] = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '');
        }

        return implode(', ', $parts);
    }
}
