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
        'date_de_commencement'
    ];

    /**
     * Get the user that owns the medecin.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The patients that belong to the medecin.
     */
    public function patients()
    {
        //return $this->belongsToMany(Patient::class);
        return $this->belongsToMany(Patient::class)
                ->as('consultations')
                ->withTimestamps();
    }
}
