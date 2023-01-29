<div class="modal-header">
    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
        <span aria-hidden="true">
            ×
        </span>
    </button>

    <h4 class="modal-title" style="color: black;">
        Carga de documento
    </h4>
</div>

<div class="modal-body">
	{!! Form::model(Request::all(), ["id" => "fr_nuevo_documento_contratacion", "files" => true]) !!}
        <div class="modal-body">
            {!! Form::hidden("ref_id") !!}

            <div class="col-md-6 form-group">
                <label for="inputEmail3" class="control-label" style="color: black;" > Tipo documento</label>
                
                    {!! Form::select("tipo_documento_id", $tipo_documento, null, ["class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "tipo_documento_id", "required"=>"required"]); !!}
                
                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("tipo_documento_id", $errors) !!}</p>
            </div>

            {{--
                <div class="col-md-12 form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label" style="color: black;" > Puntaje</label>
                    
                    <div class="col-sm-8">
                        {!! Form::text("puntaje",null,["class"=>"form-control"]); !!}
                    </div>
                    
                    <p class="error text-danger direction-botones-center">{! FuncionesGlobales::getErrorData("puntaje",$errors) !!}</p>
                </div>
            --}}
   
            <div class="col-md-6 form-group">
                <label for="inputEmail3" class="control-label" style="color: black;">Archivo</label>
                

                    {!! Form::file("archivo_documento", ["class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "required"=>"required"]); !!}

                 <p class="error text-danger direction-botones-center">@if ($errors->has('archivo_documento'))
                     {{ $errors->first('archivo_documento') }}
                    @endif</p>
            </div>

             <div class="col-md-12 form-group">
                <label for="inputEmail3" class="control-label" style="color: black;" > Descripción</label>
                

                    {!! Form::textarea("descripcion_archivo",null, ["class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "descripcion_archivo"]); !!}
            
                
                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("descripcion_archivo", $errors) !!}</p>
            </div>


            <div class="clearfix"></div>
        </div>
         {{-- @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach --}}

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success"  id="guardar_nuevo">Guardar</button>
        </div>

    <script>
        $(function(){
            $(document).on("change","#tipo_documento_id",function(){
                    $("#descripcion_archivo").val($("#tipo_documento_id").find("option:selected").text())
                });
        })
    //se valida para enviar
    $('#guardar_nuevo').on("click", function(){
        event.preventDefault()
        if ($('#fr_nuevo_documento_contratacion').smkValidate()) {
            $('#guardar_nuevo').hide();
            let formData = new FormData(document.getElementById("fr_nuevo_documento_contratacion"));
            console.log(formData)
            $.ajax({
                type: "POST",
                data: formData,
                url: "{{ route('guardar_documento') }}",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $.smkAlert({
                        text: 'Guardando los datos.',
                        type: 'info'
                    });
                },
                error: function(){
                    $.smkAlert({
                        text: 'Ha ocurrido un error guardando los datos. Verifique e intente nuevamente.',
                        type: 'danger'
                    });
                    $('#guardar_nuevo').show();
                },
                success: function(response){
                    if(response.success) {
                        $.smkAlert({
                            text: 'Datos guardados correctamente!',
                            type: 'success'
                        });
                        
                        setTimeout(function(){
                            window.location.href = '{{ route("admin.carga_archivos_contratacion") }}';
                        }, 2500);
                    } else {
                        $.smkAlert({
                            text: response.mensaje,
                            type: 'danger'
                        });
                        $('#guardar_nuevo').show();
                    }
                }
            });
        }
    });
        // $(function(){
        //     $("#guardar_nuevo").on("click", function(){
        //         if ($('#fr_nuevo_documento_contratacion').smkValidate()) {
        //             var formData = new FormData(document.getElementById("fr_nuevo_documento_contratacion"));

        //             $.ajax({
        //                 url: "{{ route('admin.guardar_documento_contratacion') }}",
        //                 type: "post",
        //                 dataType: "html",
        //                 data: formData,
        //                 cache: false,
        //                 contentType: false,
        //                 processData: false
        //             }).done(function (res) {
                    
        //                 mensaje_success("Documento cargado con éxito");
        //                 var res = $.parseJSON(res);
                        
        //                 if (res.success) {
        //                     setTimeout(function(){
        //                     window.location.href = '{{ route("admin.carga_archivos_contratacion") }}';
        //                     }, 2500);

        //                 }/*else {
        //                     $("#modal_peq").find(".modal-content").html(res.view);
        //                 }*/
        //             });
        //         }          
        //     })
        // });
    </script>
{!! Form::close() !!}
</div>