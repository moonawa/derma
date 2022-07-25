<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    protected $fillable = [
        'paiement_id',
        'medicament',
        'dosage',
        'nombre_boite',
    ];

    /**
     * Get the paiement that owns the ordonnance.
     */
    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }
}
