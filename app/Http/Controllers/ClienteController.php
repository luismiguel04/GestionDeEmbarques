<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contacto;
use App\Models\Embarque;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate();

        return view('cliente.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = new Cliente();
        return view('cliente.create', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Cliente::$rules);

        $cliente = Cliente::create($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente created successfully.');
    }
    public function enviar(Request $request)
    {
        $telefono = 523326575186;

        $token = 'EAAxmYJSuvykBOyH9qv1vR9uNOMtwZAcTZC9ZBZA5RdlSqw1WkyfkTpyXUHR6A0CWLVnaKYmdAEJcRmxZB32dKyLgZCtYmpYMWoQKhjE5wZCZCJeqFZA9xZCQMnmRKQwZA7znK4lbJ0fO7lPJtRZBrN5T6oH7XUV0j3lmenf0CFZB4a0uwSbERXUZB8tNKqZAMCl5FdTaGiSxZAZAbyKsoxZBxjAdOreYRvJp9ZBcKmE0pD13bUZD';



        $url = 'https://graph.facebook.com/v17.0/147516861780285/messages';





        $mensajev = '{
    "messaging_product": "whatsapp",
    "to": "{{' . $telefono . '}",
    "type": "template",
    "template": {
        "name": "hello_world",
        "language": {
            "code": "en_US"
        }
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
        $cliente = Cliente::find($id);
        $contactos = Contacto::all()->where('Empresa', '=', $id)->where('status', '=', 'activo');
        $embarquest = Embarque::all()->where('Empresa', '=', $id)->count();
        $embarques = Embarque::select('status', Embarque::raw('count(*) as total'))->where('Empresa', '=', $id)->groupBy('status')
            ->get();

        return view('cliente.show', compact('cliente', 'contactos', 'embarques', 'embarquest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        request()->validate(Cliente::$rules);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id)->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deleted successfully');
    }
    public function imprimir($id)
    {

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Verdana');
        $dompdf->setOptions($options);

        $cliente = Cliente::find($id);
        $contactos = Contacto::all()->where('Empresa', '=', $id)->where('status', '=', 'activo');
        $embarquest = Embarque::all()->where('Empresa', '=', $id)->count();
        $embarques = Embarque::select('status', Embarque::raw('count(*) as total'))->where('Empresa', '=', $id)->groupBy('status')
            ->get();

        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ])->loadView('cliente.pdf', compact('cliente', 'contactos', 'embarques', 'embarquest'))
            ->setPaper('a4');
        //return $pdf->download('provedores.pdf');
        return $pdf->stream('Perfil de cliente.pdf');
    }
}
