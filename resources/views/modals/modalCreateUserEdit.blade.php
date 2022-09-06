<!-- Modal -->
<div class="modal fade" id="createuseredit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titulomodal">Actualizar datos de empleado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
            <div class="tile">
              <div class="tile-body">
                <form id ="editusercreate" name ="editusercreate"  method ="POST">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                   <div class="form-group">
                        <div class="alert alert-primary" role="alert">
                            Los campos con (*) son obligatorios
                        </div>
                        <label class="control-label">Nombre Completo *</label>
                        <input class="form-control" id="editnameuser" name="editnameuser" type="text" placeholder="Nombre completo del empleado">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Correo Electronico *</label>
                    <input class="form-control" id="editemailuser" name="editemailuser" type="email" placeholder="Correo electronico">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Sexo *</label>
                    <div class="form-check">
                        <input class="form-check-input" id="M" type="radio" name="editsexo" value="M" id="editsexouser1">
                        <label class="form-check-label" for="sexouser1">
                        Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="F" type="radio" name="editsexo" value="F" id="editsexouser2">
                        <label class="form-check-label" for="sexouser2">
                        Femenino
                        </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Area *</label>
                    <select class="form-control" id="editareauser" name="editareauser" placeholder="Escoje area" required>
                      <option value="0">Seleccione una area</option>
                      @foreach ($areas as $area)
                        <option value= "{{ $area->id }}"> {{ $area->nombre }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                        <label for="descripcionuser" class="form-label">Descripcion *</label>
                        <textarea class="form-control" name="editdescripcionuser" id="editdescripcionuser" rows="3"></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value=1 name="editboletinuser" id="editboletinuser">
                      <label class="form-check-label" for="boletinuser">
                        Deseo recibir boletin informativo
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="descripcionuser" class="form-label">Roles *</label>
                    @foreach ($rols as $rol)
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value={{ $rol->id }} name ="editrols[]" id={{ $rol->id }}>
                      <label class="form-check-label" for="rolesuser.{{ $rol->id }}">
                        {{ $rol->nombre }}
                      </label>
                    </div>
                    @endforeach
                    <input id="id" name ="id" type="text" placeholder="id" readonly=""  style="visibility:hidden">
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary" id ="btnempleadoedit"><span id ="btntext" class="bg-light" ></span>Actualizar</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
        
      </div>
    </div>
  </div>
  
  