<?php

namespace App\Http\Controllers;

use App\Models\ActividadesFija;
use App\Models\Servicio;
use Illuminate\Http\Request;


/**
 * Class ActividadesFijaController
 * @package App\Http\Controllers
 */
class ActividadesFijaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividadesFijas = ActividadesFija::paginate();

        $servicios = Servicio::all();

        return view('actividades-fija.index', compact('actividadesFijas', 'servicios'))
            ->with('i', (request()->input('page', 1) - 1) * $actividadesFijas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actividadesFija = new ActividadesFija();
        $servicios = Servicio::all();
        return view('actividades-fija.create', compact('actividadesFija', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ActividadesFija::$rules);

        $actividadesFija = ActividadesFija::create($request->all());

        return redirect()->route('actividades-fijas.index')
            ->with('success', 'ActividadesFija created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividadesFija = ActividadesFija::find($id);

        return view('actividades-fija.show', compact('actividadesFija'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividadesFija = ActividadesFija::find($id);
        $servicios = Servicio::all();


        return view('actividades-fija.edit', compact('actividadesFija', 'servicios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ActividadesFija $actividadesFija
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActividadesFija $actividadesFija)
    {
        request()->validate(ActividadesFija::$rules);

        $actividadesFija->update($request->all());

        return redirect()->route('actividades-fijas.index')
            ->with('success', 'ActividadesFija updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $actividadesFija = ActividadesFija::find($id)->delete();

        return redirect()->route('actividades-fijas.index')
            ->with('success', 'ActividadesFija deleted successfully');
    }
}
