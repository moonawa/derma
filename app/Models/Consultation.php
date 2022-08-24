<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot as RelationsPivot;

class Consultation extends RelationsPivot
{
    use HasFactory;

    protected $fillable = [
        'medecin_id',
        'patient_id',
        'photo1',
        'photo2',
        'photo3',
        'photo4',
        'etat_patient',
        'autre_medicament',
        
    ];
    /**
     * Get the paiement associated with the consultation.
     */
    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
    /**
     * Get the medecin that owns the consultation.
     */
    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
    /**
     * Get the patient that owns the consultation.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }  

}
