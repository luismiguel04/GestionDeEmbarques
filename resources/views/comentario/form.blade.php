<div class="box box-info padding-1">
    <div class="box-body">
        <input class="" name="Id_Actividad" id="Id_Actividad" type="hidden" value="{{$actividad->id}}" />
        <input class="" name="Id_User" id="Id_User" type="hidden" value="{{$user->id}}" />


        <div class="form-floating">
            <textarea class="form-control" name="Comentario" id="Comentario" style="height: 100px"></textarea>
            <label for="Comentario">{{ __('Comentario') }}</label>
        </div>
        <br>
        <div class="input-group">
            <input type="file" class="form-control" id="Documento_path" name="Documento_path" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

        </div>


        <div class="box-footer mt20 pt-2">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
    </div>