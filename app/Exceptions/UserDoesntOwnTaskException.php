<?php

namespace App\Exceptions;

use Exception;

/**
 * Classe que trata a exceção que pode ocorrer quando um usuário tenta apagar uma tarefa que não lhe pertence
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class UserDoesntOwnTaskException extends Exception {
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report() {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request) {
        return false;
    }
}
