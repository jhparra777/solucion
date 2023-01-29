<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Gestionar nuevamente orden : <strong>{{$orden}}</strong> </h4>
</div>
<div class="modal-body">
    {!! Form::open(["id"=>"fr_concepto_medico"]) !!}
    {!! Form::hidden("orden",$orden,["id"=>"orden_id"]) !!}
   
	    Desea cambiar el concepto médico de esta orden?
    {!! Form::close() !!}


    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <a  type="button" class="btn btn-success" id="confirmar_cambiar_concepto" href={{route('admin.gestionar_documentos_medicos', ["ref_id" => $orden, "edit" => true])}} >Cambiar concepto</a>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>

<script type="text/javascript">
    
    $(function(){
        /*$('#confirmar_cambiar_concepto').click(function(){
                
            var orden=$(this).data('ref');
            $.ajax({

                type: "POST",
                url: "{{ route('admin.confirmar_cambiar_concepto_medico') }}",
                data: $("#fr_concepto_medico").serialize(),
               
                success: function(response) {
                    $("#modal_peq").find(".modal-content").html(response);
                    $("#modal_peq").modal("show");
                }
             });

            });*/
    });
</script>

