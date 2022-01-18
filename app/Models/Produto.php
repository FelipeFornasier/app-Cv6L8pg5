<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produto';

    public $timestamps = false;

    protected $primaryKey = 'sku';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['sku', 'nome', 'quantidade_inicial', 'quantidade_atual'];

    public function movimento() {
        return $this->hasMany('produto_movimento');
    }
}
