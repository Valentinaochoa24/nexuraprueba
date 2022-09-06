<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleado;
use App\Models\empleado_rol;
use App\Models\rol;


class dataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = empleado::all();
		$collection = [];

        foreach ($empleados as $empleado) {
            switch ($empleado->sexo) {
                case "F":
                    $sexo = 'Femenino';
                    break;
                case "M":
                    $sexo = 'Masculino';
                    break;
            }
            switch ($empleado->boletin) {
                case "1":
                    $boletin = 'Si';
                    break;
                case "0":
                    $boletin = 'No';
                    break;
            }



			$values = [
				"nombre" => $empleado->nombre,
				"email" => $empleado->email,
				"sexo" => $sexo,
				"area" => $empleado->area->nombre,
				"boletin" => $boletin,
				"modificar" => '<i onclick = "modificar('.$empleado->id.');" class="far fa-edit" data-toggle="tooltip" title="Modificar" ></i>',
				"eliminar" => '<i onclick = "eliminar('.$empleado->id.');" class="fas fa-trash-alt" data-toggle="tooltip" title="Eliminar"></i>'
			];
			array_push($collection, $values);
        }
		return datatables($collection)
                ->rawColumns(['modificar','eliminar'])
                ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->nameuser!==null &
        $request->emailuser!==null &
        $request->sexo!==null &
        $request->areauser!=="Seleccione una area" &
        $request->descripcionuser!==null){

            $name_rols = rol::all();

            $databack= empleado::where([
                    'email'=> $request->emailuser
                ])->count();
            if($databack == 0){
                if(($request->boletinuser)=="1"){
                    $boletin = 1;
                }else{
                    $boletin = 0;
                };

                $empleado = new empleado([
                    'nombre'=> $request->nameuser,
                    'email'=> $request->emailuser,
                    'sexo'=> $request->sexo,
                    'area_id'=> $request->areauser,
                    'boletin'=>$boletin,
                    'descripcion'=> $request->descripcionuser,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $empleado->save();

                $rols = $request->rols;
                foreach($rols as $rol){
                    $empleado_rol = new empleado_rol([
                        'empleado_id'=>$empleado->id,
                        'rol_id'=>$rol,
                        'created_at' => now(),
                        'updated_at' => now()
                        ]);

                    $empleado_rol->save();

                    }

                    return response()->json([
                        'message' => 'ok',
                        'name_rols'=>$name_rols,
                        'empleado'=>$empleado
                    ]);

                
            }else{
                return response()->json([
                    'message' => 'error',
                    'alerta'=>'El trabajador ya existe'
                ]);

            }

        }else{
            return response()->json([
                'message' => 'error',
                'alerta'=>'Todos los datos son obligatorios'
            ]);
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado_rols = empleado_rol::where("empleado_id",$id)->get();
        $name_rols = rol::all();

        $empleado = empleado::find($id);

        switch ($empleado->sexo) {
            case "F":
                $sexo = 'Femenino';
                break;
            case "M":
                $sexo = 'Masculino';
                break;
        }
        switch ($empleado->boletin) {
            case "1":
                $boletin = 'Si';
                break;
            case "0":
                $boletin = 'No';
                break;
            }
            $values = [
                "id"=> $empleado->id,
				"nombre" => $empleado->nombre,
				"email" => $empleado->email,
				"sexo" => $empleado->sexo,
				"area" => $empleado->area_id,
				"boletin" => $boletin,
                'rols' =>$empleado->empleado_rol,
                'descripcion' => $empleado->descripcion,
                'roles'=>$empleado_rols,
                'name_rols'=>$name_rols
			];

            return $values;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->editnameuser=="" or
        $request->editemailuser=="" or
        $request->editsexo=="" or
        $request->editdescripcionuser==""){

            return response()->json([
                'message' => 'error',
            ]);

        }else{
            
            if(($request->editboletinuser)=="1"){
                $boletin = 1;
            }else{
                $boletin = 0;
            };
            
            $empleado = empleado::find($id);
            $empleado->nombre =$request->editnameuser;
            $empleado->email= $request->editemailuser;
            $empleado->sexo=$request->editsexo;
            $empleado->area_id= $request->editareauser;
            $empleado->boletin=$boletin;
            $empleado->descripcion= $request->editdescripcionuser;
            $empleado->updated_at = now();
            $empleado ->save();
    
            $rols = empleado_rol::all()->where('empleado_id',$id);
    
            foreach($rols as $rol){
                $rol->delete();
            }
    
            $editrols = $request->editrols;
                foreach($editrols as $editrol){
                    $empleado_rol = new empleado_rol([
                        'empleado_id'=>$empleado->id,
                        'rol_id'=>$editrol,
                        'created_at' => now(),
                        'updated_at' => now()
                        ]);
    
                    $empleado_rol->save();
    
                    }
    
            return response()->json([
                'message' => 'ok',
            ]);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = empleado::find($id);
        $empleado->delete();

        $rols = empleado_rol::all()->where('empleado_id',$id);
        foreach($rols as $rol){
            $rol->delete();
        }
        return response()->json([
            'message' => 'ok',
        ]);
    }
}
