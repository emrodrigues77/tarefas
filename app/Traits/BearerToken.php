<?php

namespace App\Traits;

use Illuminate\Http\Request;

/**
 * Trait que oferece funcionalidades relacionadas ao bearer token do JWT
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
trait BearerToken {

    /**
     * Verifica se o token de autenticação está presente na requisição
     *
     * @param Request $request Requisição enviada para o sistema
     * @return mixed
     */
    public function checkToken(Request $request) {
        if (empty($request->bearerToken())) {
            $this->response = response()->json([
                'status' => 'error',
                'message' => 'Autorização necessária para acessar esse recurso',
            ], 401);
        } else {
            return true;
        }
    }
}
