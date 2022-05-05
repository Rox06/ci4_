<?php
namespace App\Models;

use CodeIgniter\Model;

class LibroModel extends Model{

    protected $table      = 'libros';
    protected $primaryKey = 'id_libro';
    protected $allowedFields = ['nombre_libro', 'imagen_libro'];

    public function getLibros(){

        return $this->findAll();
    }

    public function addLibro($datos){

        return $this->save($datos);
    }

    public function obtainLibro($id_libro){

        return $this->where('id_libro',$id_libro)->first($id_libro);
    }

    public function updateLibro($id_libro, $datos){

        return $this->update($id_libro,$datos);
    }

    public function deleteLibro($id_libro){

        $this->delete($id_libro);

    }
}