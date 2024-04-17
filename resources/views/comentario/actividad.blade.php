<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Actividad</th>
                                    <th>User</th>
                                    <th>Comentario</th>
                                    <th>Adjunto</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comentarios as $comentario)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $comentario->Id_Actividad }}</td>
                                    <td>{{ $comentario->User->name }}</td>
                                    <td>{{ $comentario->Comentario }}</td>
                                    <td>{{ $comentario->Documento_path }}</td>

                                    <td>
                                        <form action="{{ route('comentarios.destroy',$comentario->id) }}" method="POST">

                                            <a class="btn btn-sm btn-success" href="{{ route('comentarios.edit',$comentario->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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