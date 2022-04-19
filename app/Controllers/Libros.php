<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro;

class Libros extends Controller{

    public function index(){
        
        $libro = new Libro();
        $datos['libros'] = $libro->orderBy('id_libro','ASC')->findAll();

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
    
        return view('libros/listar',$datos);
    }

    public function crear(){

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('libros/crear',$datos);
    }

    public function guardar(){
        
        $libro = new Libro();

        $nombrelibro=$this->request->getVar('nombrelibro');
        
        if($imagenlibro=$this->request->getFile('imagenlibro')){
            
            $nuevoImagenlibro=$imagenlibro->getRandomName();
            $imagenlibro->move('../public/imagenes/',$nuevoImagenlibro);
           
            $datos=[
                'nombre_libro'=>$nombrelibro,
                'imagen_libro'=>$nuevoImagenlibro
            ];

            $libro->insert($datos);
        }

        return $this->response->redirect(site_url('/listar'));
    }

    public function borrar($id_libro=null){#Null en caso de no recepcionar nada

        $libro = new Libro();
        #Busca id que coincida con id enviado y agarra el primer registro.
        $datosLibro=$libro->where('id_libro',$id_libro)->first();

        #Agarra primer registro y se crea ruta de borrado de libro
        $ruta=('../public/imagenes/'.$datosLibro['imagen_libro']);

        if (file_exists($ruta)) {
            unlink($ruta);
        }#Borrado
        
        #Borra en BD, respetandi ID enviado
        $libro->where('id_libro',$id_libro)->delete($id_libro);

        return $this->response->redirect(site_url('/listar'));      
    }

    public function editar($id_libro=null){
       
        $libro = new Libro();

        $datos['libro']=$libro->where('id_libro',$id_libro)->first();
        #Archivo editar recibira esos datos con variable de nombre $libro

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('libros/editar',$datos);
    }

    public function actualizar(){
        #$imagenlibro=$this->request->getVar('imagenlibro');
        #var_dump($imagenlibro);
        
        $libro = new Libro();

        $datos=['nombre_libro'=>$this->request->getVar('nombrelibro')];
        $idlibro=$this->request->getVar('id_libro'); #id_libro viene de interfaz editar boton hidden
        $imagenlibro=$this->request->getFile('imagenlibro');

        #var_dump($datos);
        
        if(empty($datos)){

            echo "<script>alert('Ingresa nombre de libro');</script>";     
            $vuelveeditar=$this->editar($datos,$idlibro,$imagenlibro);#Llamada a la función editar()
            return $vuelveeditar;
        }
        else{

            $libro->update($idlibro,$datos);
        
            if(file_exists($imagenlibro)){

                $validacion = $this->validate([
                    'imagenlibro'=>[
                        'uploaded[imagenlibro]',
                        'mime_in[imagenlibro,image/jpg,image/jpeg,image/png]',
                        'max_size[imagenlibro,1024]',
                    ]
                ]);

                if($validacion){ 
                    
                        $datosLibro=$libro->where('id_libro',$idlibro)->first();
                        $ruta=('../public/imagenes/'.$datosLibro['imagen_libro']);
                        unlink($ruta);

                        $nuevoImagenlibro=$imagenlibro->getRandomName();
                        $imagenlibro->move('../public/imagenes/',$nuevoImagenlibro);

                        $datos=['imagen_libro'=>$nuevoImagenlibro];
            
                        $libro->update($idlibro,$datos);          
                }
                else{
                    echo "<script>alert('Ingresa archivo válido jpg/jpeg/png menor a 1M');</script>";
                    
                    $vuelveeditar=$this->editar($idlibro,$datos,$imagenlibro);
                    return $vuelveeditar;
                }
            }

            return $this->response->redirect(site_url('/listar')); 
        }
    }
}
