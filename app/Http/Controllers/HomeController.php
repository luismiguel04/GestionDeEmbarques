<?php

namespace App\Http\Controllers;

use App\Models\Embarque;
use App\Models\Actividadembarque;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $embarquest = Embarque::all()->count();
        $embarques = Embarque::select('status', Embarque::raw('count(*) as total'))->groupBy('status')
            ->get();
        $chartData = 0;

        return view('index', compact('embarques', 'embarquest', 'chartData'));
    }

    public function getChartData(Request $request)
    {
        // Aquí obtén los datos según el valor del select
        $selectedValue = $request->input('selectedValue');

        // Lógica para obtener los datos del gráfico según $selectedValue
        $chartData = Embarque::select('status', Embarque::raw('count(*) as total'))->groupBy('status')->where('status', '=', $selectedValue)->get();

        // Devuelve los datos en formato JSON para el gráfico
        return response()->json($chartData);
    }
}
