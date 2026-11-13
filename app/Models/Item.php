<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'nome',
        'quantidade_estoque',
        'user_id',
        'categoria_id'
    ];

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function categoria(): BelongsTo {
        
        return $this->belongsTo(Categoria::class);
    }

    public function pedidos(): hasMany {
        return $this->hasMany(Pedido::class);
    }

}
