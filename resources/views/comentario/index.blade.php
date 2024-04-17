@extends('layouts.app')

@section('template_title')
Comentario
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Comentarios') }} {{$embarque->Referencia}}
                        </span>

                        <div class="float-right me-0 pe-0 ">
                            <a class="btn btn-primary" href="{{ route('embarques.show',$embarque->id) }}">
                                {{ __('Back') }}</a>
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
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('User') }}</th>
                                    <th>Comentario</th>
                                    <th>Fecha del comentario</th>
                                    <th>Imagen/Archivo</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comentarios as $comentario)
                                <tr>
                                    <td>{{ ++$i }}</td>


                                    <td>{{ $comentario->User->name }}</td>
                                    <td>{{$comentario->Comentario}} </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($comentario->FComentario)->Locale('es')->formatLocalized('%d %B %Y %H:%M:%S')}}


                                    </td>
                                    <td>
                                        @if($comentario->Documento_path=="")

                                        @else

                                        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vistaprevia{{$comentario->id}}"><i class="fa fa-fw fa-eye"></i></a>

                                        <div class="modal fade" id="vistaprevia{{$comentario->id }}" tabindex="-1" aria-labelledby="vistaprevia" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen-sm-down">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <iframe src="http://localhost/GestionDeEmbarques/storage/app/Fcomentarios/{{$comentario->Documento_path}}" &embedded=true" style="width:100%; height:700px;" frameborder="0"></iframe>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

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