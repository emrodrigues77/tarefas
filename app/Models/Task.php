<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Classe de modelagem das tarefas
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class Task extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'finished'
    ];


    /**
     * Estabelece um relacionamento entre este modelo e o de usuários
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}