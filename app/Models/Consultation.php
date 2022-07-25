<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Pivot;

class Consultation extends Pivot
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

}
