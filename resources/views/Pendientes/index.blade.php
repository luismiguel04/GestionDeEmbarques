@extends('layouts.app')

@section('template_title')
Actividadembarque
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __(' Mis Pendientes') }}
                        </span>


                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Embarque</th>
                                    <th>Actividad</th>
                                    <th>User</th>
                                    <th>Status</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actividadembarques as $actividadembarque)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $actividadembarque->Embarque->Referencia  }}</td>
                                    <td>{{ $actividadembarque->actividadesFija->Nombre }}</td>
                                    <td>{{ $actividadembarque->User->name }}</td>
                                    <td>{{ $actividadembarque->A_Status }}</td>

                                    <td>
                                        <form action="{{ route('actividadembarques.destroy',$actividadembarque->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('actividadembarques.show',$actividadembarque->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('actividadembarques.edit',$actividadembarque->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection