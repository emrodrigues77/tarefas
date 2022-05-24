<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * Classe de modelagem dos usuários
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class User extends Authenticatable implements JWTSubject {
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [
            'id' => $this->id,
            'email' => $this->email,
        ];
    }

    /**
     * Estabelece um relacionamento entre este modelo e o de tarefas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks() {
        return $this->hasMany(Task::class);
    }

    /**
     * Retorna o número de tarefas do usuário, filtrando-as pelo estado de conclusão
     *
     * @param string $status Status da tarefa
     * @return int
     */
    public function tasksCount($status = "%") {
        return $this->tasks()->where('finished', 'LIKE', $status)->count();
    }

    /**
     * Retorna uma array com as tarefas do usuário, filtrando-as pelo estado de conclusão
     *
     * @param string $status Status da tarefa
     * @return array
     */
    public function getFilteredTasks($status = "%") {
        return $this->tasks()->where('finished', 'LIKE', $status);
    }
}