<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Application extends Model
{
    protected $fillable = [
        'email',
        'passportNumber',
        'candidateType',
        'fullName',
        'fullNameOnRecord',
        'passportImagePath',
        'usualForename',
        'lastName',
        'candidateId',
        'poBox',
        'district',
        'city',
        'province',
        'country',
        'whatsappNumber',
        'emergencyContactNumber',
        'contactNumber',
        'previousAttempts',
        'schoolName',
        'schoolLocation',
        'qualificationYear',
        'countryOfExperience',
        'countryOfOrigin',
        'registrationAuthority',
        'registrationNumber',
        'registrationDate',
        'eligibilityCriterion',
        'examCenterPreference',
        'termsAccepted',
        'signature',
        'bioDataPagePath',
        'validLicensePagePath',
        'experienceCertificatePath',
        'otherDocumentsPaths',
        'status',
        'rejection_reason',
        'handled_by_user_id',
        'handled_action',
        'handled_at',
    ];

    protected $casts = [
        'termsAccepted' => 'boolean',
        'registrationDate' => 'date',
        'otherDocumentsPaths' => 'array',
        'handled_at' => 'datetime',
    ];

    // ─── Relationships ─────────────────────────────

    public function handledBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'handled_by_user_id');
    }

    // ─── Scopes ─────────────────────────────────────

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', 'rejected');
    }

    public function scopeNewCandidates(Builder $query): Builder
    {
        return $query->where('candidateType', 'new');
    }

    public function scopeOldCandidates(Builder $query): Builder
    {
        return $query->where('candidateType', 'old');
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (! $search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('usualForename', 'like', "%{$search}%")
                ->orWhere('lastName', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('passportNumber', 'like', "%{$search}%");
        });
    }

    // ─── Accessors ──────────────────────────────────

    public function getFullNameAttribute(): string
    {
        return trim(($this->usualForename ?? '') . ' ' . ($this->lastName ?? ''));
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'approved' => 'success',
            'rejected' => 'danger',
            default    => 'warning',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->status ?? 'pending');
    }

    // ─── Helpers ────────────────────────────────────

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
