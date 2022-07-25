<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'prix',
        'status',   
    ];
     /**
     * Get the consultation that owns the paiement.
     */
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
    /**
     * Get the ordonnance associated with the paiement.
     */
    public function ordonnance()
    {
        return $this->hasOne(Ordonnance::class);
    }
    /**
     * Get the conseil associated with the paiement.
     */
    public function conseil()
    {
        return $this->hasOne(Conseil::class);
    }
}
