<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <h4 class="modal-title"> Detalle de rodamiento : <strong> </strong> </h4>
</div>
 <div class="modal-body">
  {!! Form::open(["id"=>"fr_rodamiento"]) !!}
  {!! Form::hidden("req",$req->id,["id"=>"req"])!!}
    
   {!!Form::text("detalle_rodamiento",($req->detalle_rodamiento)?$req->detalle_rodamiento:null,["class"=>"form-control solo-numero","placeholder"=>"Valor rodamiento","id"=>"detalle_rodamiento" ]);!!}

  {!! Form::close() !!}

  <div class="clearfix"></div>
 </div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
  <button type="button" class="btn btn-success" id="confirmar_rodamiento" >Confirmar</button>
</div>
