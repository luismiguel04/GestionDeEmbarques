<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /*  public function cambiarIdioma($idioma)
    {
        if (in_array($idioma, ['es', 'en'])) {
            App::setLocale($idioma);
        }

        // Redirigir de vuelta a la página anterior
        return Redirect::back();
    } */

    public function cambiarIdioma($language)
    {
        // Obtener el idioma actual
        $currentLanguage = App()->getLocale();
        // Comprobar si el idioma solicitado es diferente al actual
        if ($language != $currentLanguage) {
            // Cambiar el idioma
            app()->setLocale($language);
            // Redireccionar a la página anterior
            return back();
        }
        // Si el idioma solicitado es el mismo que el actual, no hacer nada
        return redirect()->back();
    }
}
