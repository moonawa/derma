<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matricule',
        'hopital',
        'clinique',
        'annee_de_commencement'
    ];

    /**
     * Get the user that owns the medecin.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function patients()
    // {
    //     //return $this->belongsToMany(Patient::class);
    //     return $this->belongsToMany(Patient::class)
    //             ->as('consultations')
    //             ->withTimestamps();
    // }
    /**
     * Get the consultations for the blog medecin.
     */
    public function consultation() {
        return $this->hasMany(Consultation::class);
    }

}
