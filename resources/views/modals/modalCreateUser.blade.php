<!-- Modal -->
<div class="modal fade" id="createuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titulomodal">CREAR EMPLEADO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
            <div class="tile">
              <div class="tile-body">
                <form id ="usercreate" name ="usercreate"  method ="POST">
                   <div class="form-group">
                        <div class="alert alert-primary" role="alert">
                            Los campos con (*) son obligatorios
                        </div>
                        <label class="control-label">Nombre Completo *</label>
                        <input class="form-control" id="nameuser" name="nameuser" type="text" placeholder="Nombre completo del empleado" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Correo Electronico *</label>
                    <input class="form-control" id="emailuser" name="emailuser" type="email" placeholder="Correo electronico" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Sexo *</label>
                    <div class="form-check">
                        <input class="form-check-input" id ="MA" type="radio" name="sexo" value="M" id="sexouser1">
                        <label class="form-check-label" for="sexouser1">
                        Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="FA" type="radio" name="sexo" value="F" id="sexouser2">
                        <label class="form-check-label" for="sexouser2">
                        Femenino
                        </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Area *</label>
                    <select class="form-control" id="areauser" name="areauser" placeholder="Escoje area" required>
                      <option value="0">Seleccione una area</option>
                      @foreach ($areas as $area)
                        <option value= "{{ $area->id }}"> {{ $area->nombre }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                        <label for="descripcionuser" class="form-label">Descripcion *</label>
                        <textarea class="form-control" name="descripcionuser" id="descripcionuser" rows="3" required></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value=1 name="boletinuser" id="boletinuser">
                      <label class="form-check-label" for="boletinuser">
                        Deseo recibir boletin informativo
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="descripcionuser" class="form-label">Roles *</label>
                    @foreach ($rols as $rol)
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="{{ $rol->id }}" name ="rols[]" id="rolesuser{{ $rol->id }}">
                      <label class="form-check-label" for="rolesuser.{{ $rol->id }}">
                        {{ $rol->nombre }}
                      </label>
                    </div>
                    @endforeach
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary" id ="btnempleado"><span id ="btntext" class="bg-light" ></span>Agregar</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
        
      </div>
    </div>
  </div>
  
  