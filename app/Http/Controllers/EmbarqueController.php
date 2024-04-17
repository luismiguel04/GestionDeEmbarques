<?php

namespace App\Http\Controllers;

use App\Models\Actividadembarque;
use App\Models\ActividadesFija;
use App\Models\Anticipo;
use App\Models\Cliente;
use App\Models\Comentario;
use App\Models\Embarque;
use App\Models\Servicio;
use App\Models\User;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

/**
 * Class EmbarqueController
 * @package App\Http\Controllers
 */
class EmbarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $embarques = Embarque::where('Status', 'En Proceso')->paginate();

        foreach ($embarques as $embarque) {
            $embarque->actividades_count = Actividadembarque::where('Id_embarque', $embarque->id)->where('A_Status', '=', 'En Proceso')->count();
        }

        return view('embarque.index', compact('embarques'))
            ->with('i', (request()->input('page', 1) - 1) * $embarques->perPage());
    }
    public function indexc()
    {
        $embarques = Embarque::where('Status', '!=', 'En Proceso')->paginate();

        foreach ($embarques as $embarque) {
            $embarque->actividades_count = Actividadembarque::where('Id_embarque', $embarque->id)->where('A_Status', 'En Proceso')->count();
        }

        return view('embarque.index', compact('embarques'))
            ->with('i', (request()->input('page', 1) - 1) * $embarques->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $embarque = new Embarque();
        $users = User::all();
        $clientes = Cliente::all();
        $servicios = Servicio::all();
        $actividades = ActividadesFija::all();
        $actividadembarque = new Actividadembarque();



        return view('embarque.create', compact('embarque', 'users', 'clientes', 'servicios', 'actividades', 'actividadembarque'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        request()->validate(Embarque::$rules);
        $embarque = new Embarque();
        $Referencia = $request->get('Referencia');
        $Empresa = $request->get('Empresa');
        $Encargado = $request->get('Encargado');
        $ETA = $request->get('ETA');
        $Status = $request->get('Status');

        $embarque->Referencia = $Referencia;
        $embarque->Empresa = $Empresa;
        $embarque->Encargado = $Encargado;
        $embarque->ETA = $ETA;
        $embarque->Status = $Status;
        $embarque->save();



        $Id_Actividad = $request->get('Id_Actividad');
        $Id_User = $request->get('Id_User');
        $A_Status = $request->get('A_Status');
        $cont = 0;

        while ($cont < count($Id_User)) {
            $actividadembarque = new Actividadembarque();
            $actividadembarque->Id_Embarque = $embarque->id;
            $actividadembarque->Id_Actividad = json_decode($Id_Actividad[$cont]);
            $actividadembarque->Id_User = json_decode($Id_User[$cont]);
            $actividadembarque->A_Status = json_decode($A_Status[$cont]);
            $cont = $cont + 1;
            $actividadembarque->save();
            $actividadembarque->saveOrFail();
        }



        return redirect()->route('embarques.index')
            ->with('success', 'Embarque created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $embarque = Embarque::find($id);
        $actividadembarques = Actividadembarque::all()->where('Id_Embarque', '=', $id);
        $anticipos = Anticipo::all()->where('Id_Embarque', '=', $id);
        $total = $anticipos->sum('cantidad');
        $pagos = DB::connection('second_database')->table('pagos')->where('referencia', '=', $embarque->Referencia)->get();
        $totalpagos = $pagos->sum('cantidad');
        $saldo = $total - $totalpagos;
        $serviciosembarque = Actividadembarque::join('actividades_fijas', 'actividades_fijas.id', '=', 'ID_Actividad')->join('Servicios', 'Servicios.id', '=', 'servicios_id')->select('Servicios.id', 'Servicios.Nombre')->where('Id_Embarque', '=', $id)->distinct()->get();
        $date = date('Y-m-d');

        $fechaa = \Carbon\Carbon::parse($date);

        foreach ($actividadembarques as $actividad) {
            $fechaEstimada = \Carbon\Carbon::parse($embarque->ETA)
                ->addDays($actividad->ActividadesFija->Fecha_estimada)
                ->format('d-m-Y'); // Obtén la fecha estimada después de agregar los días

            $actividad->fecha_act = \Carbon\Carbon::parse($fechaEstimada)->format('d-m-Y');

            $retrasoDias = \Carbon\Carbon::parse($actividad->fecha_act)->floatDiffInDays($fechaa);

            if ($fechaa->gt($actividad->fecha_act)) {
                $actividad->retraso = $retrasoDias . " Días / Retrasado";
                $actividad->tiempo = "Retrasado";
            } else {
                $actividad->retraso = $retrasoDias . " Días / Justo a Tiempo";
                $actividad->tiempo = "En Tiempo";
            }
        }

        $comentario = new Comentario();
        $user = \Auth::user();

        $comentarios = Comentario::all()->where('Id_Actividad', $id);
        $i = 0;



        return view('embarque.show', compact('embarque', 'actividadembarques', 'serviciosembarque', 'fechaa', 'comentario', 'user', 'i', 'comentarios', 'anticipos', 'total', 'pagos', 'totalpagos', 'saldo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $embarque = Embarque::find($id);
        $users = User::all();
        $clientes = Cliente::all();
        $servicios = Servicio::all();
        $actividades = ActividadesFija::all();
        $actividadembarque = Actividadembarque::join('actividades_fijas', 'actividades_fijas.id', '=', 'ID_Actividad')->join('Servicios', 'Servicios.id', '=', 'servicios_id')->select('Servicios.id', 'Servicios.Nombre')->where('Id_Embarque', '=', $id)->distinct()->get();


        return view('embarque.edit', compact('embarque', 'users', 'clientes', 'servicios', 'actividades', 'actividadembarque'));
    }
    public function reportes()
    {
        $clientes = Cliente::all();
        $embarquesp = Embarque::all()->where('Status', 'En Proceso');



        return view('embarque.reporteembarques', compact('clientes', 'embarquesp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Embarque $embarque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Embarque $embarque)
    {
        request()->validate(Embarque::$rules);

        $embarque->update($request->all());

        return redirect()->route('embarques.index')
            ->with('success', 'Embarque updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $embarque = Embarque::find($id)->delete();

        return redirect()->route('embarques.index')
            ->with('success', 'Embarque deleted successfully');
    }


    public function embarquesporfechac(Request $request)
    {

        $id = $request->get('id');
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Verdana');
        $dompdf->setOptions($options);
        $fechainicio = $request->get('fechainicio');
        $fechafin = $request->get('fechafin');
        $cliente = $request->get('cliente');

        $embarques = Embarque::whereBetween('created_at', [$fechainicio, $fechafin])->where('Empresa', $cliente)->get();
        $total = Embarque::whereBetween('created_at', [$fechainicio, $fechafin])->where('Empresa', $cliente)->get()->count();

        $Empresa = Embarque::Where('Empresa', $cliente)->get()->first();
        $i = 0;
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ])->loadView('embarque.betweencliente', compact('embarques', 'i', 'id', 'fechainicio', 'Empresa', 'fechafin', 'total'))
            ->setPaper('a4');

        return $pdf->stream('reporte de embarques entre ' . $fechainicio . ' y ' . $fechafin . '.pdf');
    }
    public function embarquesporfecha(Request $request)
    {

        $id = $request->get('id');
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Verdana');
        $dompdf->setOptions($options);
        $fechainicio = $request->get('fechainicio');
        $fechafin = $request->get('fechafin');

        $embarques = Embarque::whereBetween('created_at', [$fechainicio, $fechafin])->get();
        $total = Embarque::whereBetween('created_at', [$fechainicio, $fechafin])->get()->count();
        $i = 0;
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ])->loadView('embarque.embarquesbetween', compact('embarques', 'i', 'id', 'fechainicio', 'fechafin', 'total'))
            ->setPaper('a4');

        return $pdf->stream('reporte de embarques entre ' . $fechainicio . ' y ' . $fechafin . '.pdf');
    }

    public function pendientes(Request $request)

    {
        $i = 0;
        $embarque = $request->get('embarque');
        $embarquem = Embarque::find($embarque);
        $actividadembarques = Actividadembarque::all()->where('Id_Embarque', $embarque)->where('A_Status', 'En Proceso');

        $comentarios = Comentario::join('Actividadembarques', 'Actividadembarques.id', '=', 'comentarios.Id_Actividad')->join('embarques', 'embarques.id', '=', 'Id_Embarque')->select('comentarios.*')->where('embarques.id', $embarque)->paginate();


        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Verdana');
        $dompdf->setOptions($options);


        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ])->loadView('embarque.pendientes', compact('actividadembarques', 'i', 'embarquem', 'comentarios'))
            ->setPaper('a4');
        return $pdf->stream('reporte de pendientes de embarques.pdf');
    }
}