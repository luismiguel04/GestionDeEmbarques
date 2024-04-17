<?php

namespace App\Http\Controllers;

use App\Models\Actividadembarque;
use App\Models\ActividadesFija;
use App\Models\Comentario;
use App\Models\Embarque;
use Illuminate\Http\Request;

use App\Mail\NotificacionMail;
use Mail;
use Maatwebsite\Excel\Facades\Excel;

use function Laravel\Prompts\select;

/**
 * Class ComentarioController
 * @package App\Http\Controllers
 */
class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ver($id)
    {
        $comentarios = Comentario::join('Actividadembarques', 'Actividadembarques.id', '=', 'comentarios.Id_Actividad')->join('embarques', 'embarques.id', '=', 'Id_Embarque')->select('comentarios.*')->where('embarques.id', $id)->paginate();

        $embarque = Embarque::find($id);

        return view('comentario.index', compact('comentarios', 'embarque'))
            ->with('i', (request()->input('page', 1) - 1) * $comentarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comentario = new Comentario();
        return view('comentario.create', compact('comentario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Comentario::$rules);

        $comentario = Comentario::create($request->all());
        if ($request->hasFile('Documento_path')) {
            $Documento_path = $request->file('Documento_path');
            $documento_name = $comentario->Documento_path->getClientOriginalName();
            $rutafile = time() . $documento_name;
            \Storage::disk('Fcomentarios')->put(
                $rutafile,
                \File::get($Documento_path)
            );
            $comentario->Documento_path = $rutafile;
        }

        $comentario->save();
        $titulo = $comentario->Actividadembarque->ActividadesFija->Nombre;
        $referencia = $comentario->Actividadembarque->Embarque->Referencia;
        $comentariov = $request->get('Comentario');

        $this->enviar($comentariov, $referencia, $titulo);
        $this->notificacion();

        return redirect()->back()->with('success', 'Comentario creado exitosamente.');
    }

    public function enviar($comentariov, $titulo, $referencia)
    {
        $telefono = 523338007937;

        $token = 'EAAxmYJSuvykBO1HQVWlm8P2MGykO8R72H4pPvMKioY95W8YkGtaLu2B0zFdMSOL8tZC8uxXfiFzWBCVZA6ILck0ZAe2v3CJM1s9hAqHWiGur78izqXZCfhD5qjf3XZAqmsocxzknlwxp22TOUMZCjsgWM7y0ZBgDzWxJOsrX4ZBL8gR1wC9WMIvuxtm9blZAf5ORT7s979xKSbvp6CdyTsSLlMU3jE5ZCq42xZC4ukZD';

        $url = 'https://graph.facebook.com/v17.0/147516861780285/messages';

        $mensajev = '{
    "messaging_product": "whatsapp",
    "to": "{{' . $telefono . '}}",
    "type": "template",
    "template": {
        "name": "status",
        "language": {
            "code": "es_MX",
            "policy": "deterministic"
        },
        "components": [
         {
           "type": "header",
           "parameters": [
               {
                   "type": "text",
                   "text": " ' . $titulo . '/' . 'actividad/' . $referencia . '"
               }
           ]
         },
         {
           "type": "body",
           "parameters": [
               {
                   "type": "text",
                   "text": " ' . $comentariov . '"
               }
           ]
         }
        ]
    }
}';

        $header = array("Authorization: Bearer " . $token, "Content-Type: application/json");

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $mensajev);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($curl), true);
        print_r($response);
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comentario = Comentario::find($id);
        return view('comentario.show', compact('comentario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comentario = Comentario::find($id);

        return view('comentario.edit', compact('comentario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Comentario $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentario $comentario)
    {
        request()->validate(Comentario::$rules);

        $comentario->update($request->all());

        return redirect()->route('comentarios.index')
            ->with('success', 'Comentario updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $comentario = Comentario::find($id)->delete();

        return redirect()->route('comentarios.index')
            ->with('success', 'Comentario deleted successfully');
    }

    public function notificacion()
    {
        $destinatarios = [
            'luis.muniz@padillawow.com'
        ];
        $mailData = [
            'title' => 'Actualzacion de comentario',
            'body' => ' Se ha actualizado un comentario, favor de revisar el sistema.'
        ];
        Mail::to($destinatarios)->send(new NotificacionMail($mailData));
        return redirect()->back()->with('success', 'Comentario creado exitosamente.');
    }
}