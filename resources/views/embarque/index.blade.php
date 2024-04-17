@extends('layouts.app')

@section('template_title')
Embarque
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Embarques') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('reporteembarques') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('reportes') }}
                            </a>
                            <a href="{{ route('embarques.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Create New') }}
                            </a>
                        </div>

                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Referencia') }}</th>
                                    <th>{{ __('Cliente') }}</th>
                                    <th>{{ __('Encargado') }}</th>
                                    <th>{{ __('Fecha de arranque') }}</th>
                                    <th>Status</th>
                                    <th>{{ __('Pendientes') }}</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($embarques as $embarque)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $embarque->Referencia }}</td>
                                    <td>{{ $embarque->cliente->Nombre }}</td>
                                    <td>{{ $embarque->User->name }}</td>
                                    <td>{{ $embarque->ETA }}</td>
                                    <td>{{ $embarque->Status }}</td>
                                    <td>
                                        <div class="text-center aling-item-center"><label
                                                class=" rounded bg-primary border-primary border border-2 text-white  fw-bold text-center">
                                                {{ $embarque->actividades_count }}
                                            </label>
                                        </div>
                                    </td>

                                    <td>
                                        <form action="{{ route('embarques.destroy',$embarque->id) }}" method="POST">
                                            <li class="btn btn-sm btn-danger">
                                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ __('Acciones') }}
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('embarques.show',$embarque->id) }}"> <i
                                                                class="fa fa-fw fa-eye"></i>{{ __('Show') }} </a></li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('embarques.edit',$embarque->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i>{{ __('Edit') }}</a>
                                                    </li>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </ul>
                                            </li>



                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            {!! $embarques->links() !!}
        </div>
    </div>
</div>
@endsection