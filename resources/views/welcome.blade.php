@extends('layouts.app')

@section('content')
    @include('modals.modalCreateUser',[
        'areas' => $areas,
        'rols'=> $rols,
    ])
    @include('modals.modalCreateUserEdit',[
        'areas' => $areas,
        'rols'=> $rols,
    ])
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-gradient-dark text">
                    <div class="card-header bg-white text-dark">
                        <h3 class="mb-0">Lista de empleados</h3>
                            <div class="col text-right">
                            <a onclick="createuser();" class="btn btn-sm btn-primary text-right"><i class="fas fa-user-plus"></i> Crear</a>
                            </div>
                        </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush" id="tableuser">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col"><i class="fa fa-user-tie"></i>  Nombre</th>
                                                <th scope="col"><i class="fas fa-at"></i>  Email</th>
                                                <th scope="col"><i class="fas fa-venus-mars"></i>  Sexo</th>
                                                <th scope="col"><i class="fas fa-briefcase"></i>  Area</th>
                                                <th scope="col"><i class="fas fa-envelope"></i>  Boletin</th>
                                                <th scope="col">Modificar</th>
                                                <th scope="col">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
<script>
	function createuser(){
		$('#createuser').modal('show');
	}
</script>
<script>
$(document).ready(function () {
    var debugs = $('#tableuser').DataTable({
        "serveSide": true,
        "processing": true,
        "responsive": true,
        "ajax": "{{ url('empleados_data') }}",
        "columns": [
            {"data": "nombre"},
            {"data": "email"},
            {"data": "sexo"},
            {"data": "area"},
            {"data": "boletin"},
            {"data": "modificar"},
            {"data": "eliminar"}
        ],
    });
});
</script>
<script>
$(document).on("click","#btnempleado",function(){
    var datos = $('#usercreate').serialize();
    $.ajax({
        type: "POST",
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url:  "{{ url('empleados_data') }}",
        data: datos,
        success: function(r){
            if(r['message']=="error"){
                Swal.fire({        
                title: '¡Atención!',
                text: r['alerta'], 
                icon: 'error',
                });
            }else{
                Swal.fire({        
                title: '¡Felicidades!',
                text: 'Los datos fueron agregados con exito',
                icon: 'success',
                 });
                     var name_rols = r['name_rols'];
                     name_rols.forEach(element => {
                        $('#rolesuser'+element["id"]).prop('checked',false);
                     });
                    $('#MA').prop('checked',false);
                    $('#FA').prop('checked',false);
                    $('#boletinuser').prop('checked',false);
                    $('#tableuser').DataTable().ajax.reload();
                    $('#createuser').modal('hide');
                    $('#nameuser').val('');
                    $('#emailuser').val('');
                    $('#sexo').prop('checked',false);
                    $('#areauser').val('Seleccione una area');
                    $('#descripcionuser').val('');
                 
            }
            
            
        }
        
    })
    return false
}); 
</script>
<script>
    function eliminar(id){
		Swal.fire({
		title: 'Esta seguro?',
		text: "¿Desea borrar este empleado?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si,borrar!',
		cancelButtonText: 'No, cancelar!',
		}).then((result) => {
			if (result["value"] == true){
				$.ajax({
					type: "DELETE",
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					url:  "/empleados_data/" + id,
                    data: id,
					success: function(r){
						if (r['message']=="ok"){
								Swal.fire({
									title: 'Felicidades!',
									text:'Se ha borrado al empleado con exito',
									icon: 'success',
									confirmButtonText: 'OK!',
								}).then((res)=> {
									if (res["value"] == true){
										$('#tableuser').DataTable().ajax.reload();
									}
								})
							}
					}
				})
			}else{
					Swal.fire({
					title: 'Procesado!',
					text:'No se ha borrado esta empleado',
					icon: 'warning',
					});
				}
		});
	}
</script>
<script>
    /*Este codigo lanza el modals de la edicion de los datos en la pagina Totaltrabajador.php, y sirve para mostras los datos a editar, enlazado a extraertrabajador.php para sacar esos datos*/
    function modificar(id){
        $('#createuseredit').modal('show');
             $.ajax({
                type: "GET",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:  "/empleados_data/" + id,
                success: function(r){
                    var name_rols = r["name_rols"];
                    name_rols.forEach(element => {
                        $('#'+element["id"]).prop('checked',false);
                    });
                    $('#id').val(r['id']);
                    $('#editnameuser').val(r['nombre']);
                    $('#editemailuser').val(r['email']);
                    if(r['sexo']=="M"){
                        $('#M').prop('checked',true);
                    }else{
                        $('#F').prop('checked',true);
                    }
                    $('#editareauser').val(r['area']);
                    $('#editdescripcionuser').val(r['descripcion']);
                    var empleado_rols = r["roles"];
                    empleado_rols.forEach(element =>{
                        $('#'+element["rol_id"]).prop('checked',true);
                    });
                    if(r["boletin"]=="Si"){
                        $('#editboletinuser').prop('checked',true);
                    }else{
                        $('#editboletinuser').prop('checked',false);
                    }
                    
                }
                
                
            });
    }

       $(document).on("click","#btnempleadoedit",function(){
        var datos = $('#editusercreate').serialize();
        var id = $('#id').val()
        $.ajax({
            type: "PUT",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url:  "/empleados_data/" + id,
            data: datos,
            success: function(r){
                if(r['message']=="error"){
                    Swal.fire({        
                    title: '¡Atención!',
                    text: 'Todos los campos son obligatorios', 
                    icon: 'error',
                    });
                }else{
                    Swal.fire({        
                    title: '¡Felicidades!',
                    text: 'Los datos fueron actualizados con exito',
                    icon: 'success',
                     });
                        $('#tableuser').DataTable().ajax.reload();
                        $('#createuseredit').modal('hide');
                        $('#editnameuser').val('');
                        $('#editemailuser').val('');
                        $('#editsexo').prop('checked',false);
                        $('#editareauser').val('Seleccione una area');
                        $('#editdescripcionuser').val('');
                     
                }
                
                
            }
            
        })
        return false;
    }); 
    </script>

@endsection