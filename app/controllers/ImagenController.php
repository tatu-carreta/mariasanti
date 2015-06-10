<?php

class ImagenController extends BaseController {

    public function borrar() {

        //Aca se manda a la funcion borrarItem de la clase Item
        //y se queda con la respuesta para redirigir cual sea el caso
        $respuesta = Imagen::borrar(Input::all());

        return $respuesta;
    }

    public function uploadImagenCrop() {

        if (!empty(Input::hasFile('file'))) {
            $img = Input::file('file');

            $path = public_path() . '/uploads/';

            $count = count($img->getClientOriginalName()) - 4;

            $filename = Str::limit(Str::slug($img->getClientOriginalName()), $count, "");
            $extension = $img->getClientOriginalExtension(); //if you need extension of the file

            if (!is_null(Imagen::imagenPorNombre($filename . ".{$extension}"))) {

                $filename = $filename . "(" . Str::limit(sha1(time()), 3, "") . ")" . ".{$extension}";
            } else {
                $filename = $filename . ".{$extension}";
            }

            $img->move($path, "small_" . $filename);
            $answer = array('answer' => 'File transfer completed', 'imagen_path' => "small_" . $filename);
            echo json_encode($answer);
        } else {
            echo 'No image';
        }
    }

}
