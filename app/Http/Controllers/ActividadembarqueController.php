<?php

namespace App\Http\Controllers;

use App\Models\Actividadembarque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ActividadembarqueController
 * @package App\Http\Controllers
 */
class ActividadembarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividadembarques = Actividadembarque::paginate();

        return view('actividadembarque.index', compact('actividadembarques'))
            ->with('i', (request()->input('page', 1) - 1) * $actividadembarques->perPage());
    }

    public function pendientes()

    {
        $user = Auth::user()->id;
        $i = 0;
        $actividadembarques = Actividadembarque::all()->where('Id_User', $user)->where('A_Status', 'En Proceso');

        return view('pendientes.index', compact('actividadembarques', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actividadembarque = new Actividadembarque();
        return view('actividadembarque.create', compact('actividadembarque'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Actividadembarque::$rules);

        $actividadembarque = Actividadembarque::create($request->all());

        return redirect()->route('actividadembarques.index')
            ->with('success', 'Actividadembarque created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividadembarque = Actividadembarque::find($id);

        return view('actividadembarque.show', compact('actividadembarque'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividadembarque = Actividadembarque::find($id);

        return view('actividadembarque.edit', compact('actividadembarque'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Actividadembarque $actividadembarque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividadembarque $actividadembarque)
    {
        request()->validate(Actividadembarque::$rules);

        $actividadembarque->update($request->all());

        return redirect(route('embarques.index'))
            ->with('success', 'Actividadembarque updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $actividadembarque = Actividadembarque::find($id)->delete();

        return redirect()->route('actividadembarques.index')
            ->with('success', 'Actividadembarque deleted successfully');
    }
}
