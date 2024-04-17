<?php

namespace App\Http\Controllers;

use App\Models\Anticipo;
use Illuminate\Http\Request;

/**
 * Class AnticipoController
 * @package App\Http\Controllers
 */
class AnticipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anticipos = Anticipo::paginate();

        return view('anticipo.index', compact('anticipos'))
            ->with('i', (request()->input('page', 1) - 1) * $anticipos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($empresa)
    {
        $anticipo = new Anticipo();
        $empresa;
        return view('anticipo.create', compact('anticipo', 'empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Anticipo::$rules);

        $anticipo = Anticipo::create($request->all());

        return redirect()->route('embarques.show', $anticipo->Id_Embarque)
            ->with('success', 'Anticipo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anticipo = Anticipo::find($id);

        return view('anticipo.show', compact('anticipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $empresa)
    {
        $anticipo = Anticipo::find($id);
        $empresa;
        return view('anticipo.edit', compact('anticipo', 'empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Anticipo $anticipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anticipo $anticipo)
    {
        request()->validate(Anticipo::$rules);

        $anticipo->update($request->all());

        return redirect()->route('embarques.show', $anticipo->Id_Embarque)
            ->with('success', 'Anticipo Modificado successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $anticipo = Anticipo::find($id)->delete();

        return back()
            ->with('success', 'Anticipo eliminado exitosamente.');
    }
}
