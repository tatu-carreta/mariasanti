<?php

class Muestra extends Item {

    //Tabla de la BD
    protected $table = 'muestra';
    //Atributos que van a ser modificables
    protected $fillable = array('item_id', 'cuerpo');
    //Hace que no se utilicen los default: create_at y update_at
    public $timestamps = false;

    //Función de Agregación de Item
    public static function agregar($input) {
        //Lo crea definitivamente

        if (isset($input['descripcion'])) {

            $input['descripcion'] = $input['descripcion'];
        } else {
            $input['descripcion'] = NULL;
        }


        $item = Item::agregarItem($input);
        
        if (isset($input['cuerpo'])) {

            $cuerpo = $input['cuerpo'];
        } else {
            $cuerpo = NULL;
        }
        
        if (!$item['error']) {

            $muestra = static::create(['item_id' => $item['data']->id, 'cuerpo' => $cuerpo]);

            $respuesta['data'] = $muestra;
            $respuesta['error'] = false;
            $respuesta['mensaje'] = "Muestra creada.";
        } else {
            $respuesta['error'] = true;
            $respuesta['mensaje'] = "La muestra no pudo ser creada. Compruebe los campos.";
        }

        return $respuesta;
    }

    public static function editar($input) {
        $respuesta = array();

        $reglas = array(
        );

        $validator = Validator::make($input, $reglas);

        if ($validator->fails()) {
            $respuesta['mensaje'] = $validator;
            $respuesta['error'] = true;
        } else {

            $muestra = Muestra::find($input['muestra_id']);

            if (isset($input['cuerpo'])) {

                $cuerpo = $input['cuerpo'];
            } else {
                $cuerpo = NULL;
            }

            $muestra->cuerpo = $cuerpo;
            
            $muestra->save();

            if (isset($input['descripcion'])) {

                $input['descripcion'] = $input['descripcion'];
            } else {
                $input['descripcion'] = NULL;
            }

            $item = Item::editarItem($input);

            $respuesta['mensaje'] = 'Muestra modificada.';
            $respuesta['error'] = false;
            $respuesta['data'] = $muestra;
        }

        return $respuesta;
    }

    public function item() {
        return Item::find($this->item_id);
    }

    public static function buscar($item_id) {
        return Portfolio::where('item_id', $item_id)->first();
    }

}
