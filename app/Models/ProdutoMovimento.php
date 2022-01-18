<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoMovimento extends Model
{
    protected $table = 'produto_movimento';
    
    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = ['sku', 'quantidade', 'tipo', 'data_hora'];

    public function produto() {
        return $this->belongsTo('produto');
    }

    public function historico() {
        return $this->orderBy('data_hora','desc')->get();
    }
}
