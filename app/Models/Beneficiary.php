<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'beneficiaries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'application_no',
        'beneficiary_name',
        'gender',
        'wife_or_widow_of',
        'cnic_no',
        'district',
        'tehsil',
        'village',
        'address',
        'contact_no',
        'one_unit_given',
        'vulnerabilities',
        'is_headed',
        'is_widow',
        'is_homeless',
        'is_poor',
        'amount_received_per_unit',
        'status',
        'remarks',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'one_unit_given' => 'boolean',
            'is_headed' => 'boolean',
            'is_widow' => 'boolean',
            'is_homeless' => 'boolean',
            'is_poor' => 'boolean',
            'vulnerabilities' => 'array',
            'amount_received_per_unit' => 'decimal:2',
        ];
    }

    /**
     * Scope query to filter by district.
     */
    public function scopeInDistrict($query, ?string $district)
    {
        if ($district) {
            return $query->where('district', $district);
        }

        return $query;
    }

    /**
     * Scope query to search by name, cnic, or application no.
     */
    public function scopeSearch($query, ?string $term)
    {
        if ($term) {
            return $query->where(function ($q) use ($term) {
                $q->where('beneficiary_name', 'ilike', "%{$term}%")
                  ->orWhere('cnic_no', 'like', "%{$term}%")
                  ->orWhere('application_no', 'ilike', "%{$term}%")
                  ->orWhere('village', 'ilike', "%{$term}%");
            });
        }

        return $query;
    }

    /**
     * Helper to get human-friendly vulnerability labels.
     *
     * @return array<string>
     */
    public function getVulnerabilityLabelsAttribute(): array
    {
        $labels = [];
        if ($this->is_headed) {
            $labels[] = 'Female-Headed Household';
        }
        if ($this->is_widow) {
            $labels[] = 'Widow';
        }
        if ($this->is_homeless) {
            $labels[] = 'Homeless';
        }
        if ($this->is_poor) {
            $labels[] = 'Poor / Ultra-Poor';
        }

        return $labels;
    }
}
