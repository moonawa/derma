<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conseil extends Model
{
    use HasFactory;

    protected $fillable = [
        'paiement_id',
        'conseil',
        
    ];
    /**
     * Get the paiement that owns the conseil.
     */
    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }
}
