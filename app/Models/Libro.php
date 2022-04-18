<?php 
namespace App\Models;

use CodeIgniter\Model;

class Libro extends Model{

    protected $table      = 'libros';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_libro';
    protected $allowedFields=['nombre_libro','imagen_libro'];
}