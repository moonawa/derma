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
    /**
     * The medecins that belong to the patient.
     */
    public function medecins()
    {
        //return $this->belongsToMany(Medecin::class);
        return $this->belongsToMany(Medecin::class)
                ->as('consultations')
                ->withTimestamps();
    }
}
