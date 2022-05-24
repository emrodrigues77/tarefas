<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Classe que recebe as requisições enviadas para o modelo de tarefas
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class TaskRequest extends FormRequest {
    /**
     * Determina se o usuário pode fazer essa requisição, bastando que ele esteja logado no sistema ou um token de autorização seja enviada
     * através de uma requisição de API
     *
     * @return bool
     */
    public function authorize() {
        return auth()->check() || !empty(request()->bearerToken());
    }

    /**
     * Retorna as regras de validação da requisição
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'description' => 'required'
        ];
    }

    /**
     * Retorna as mensagens de erro a serem mostradas para cada erro de validação encontrado
     *
     * @return array<string, string>
     */
    public function messages() {
        return [
            'description.required' => 'Informe a descrição da tarefa'
        ];
    }
}