<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'birthday',
        'antécédent'
    ];

    /**
     * Get the user that owns the patient.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function medecins()
    // {
    //     //return $this->belongsToMany(Medecin::class);
    //     return $this->belongsToMany(Medecin::class)
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
