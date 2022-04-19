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
        $imagenlibro=$this->request->getFile('imagenlibro');
        #var_dump($nombrelibro);
        #var_dump($imagenlibro);
        
        if($nombrelibro==null){
            echo "<script>alert('Ingresa nombre de libro');</script>";
              
            $vuelvecrear=$this->crear();
            return $vuelvecrear;
        }
        else{
            if(!file_exists($imagenlibro)){

                echo "<script>alert('Ingresa archivo');</script>";
                $vuelvecrear=$this->crear();
                return $vuelvecrear;
            }
            else{

                $validacion = $this->validate([
                    'imagenlibro'=>[
                        'uploaded[imagenlibro]',
                        'mime_in[imagenlibro,image/jpg,image/jpeg,image/png]',
                        'max_size[imagenlibro,1024]',
                    ]
                ]);
                
                if($validacion){
                    
                    $nuevoImagenlibro=$imagenlibro->getRandomName();
                    $imagenlibro->move('../public/imagenes/',$nuevoImagenlibro);
                    
                }
                else {
                    echo "<script>alert('Ingresa archivo válido jpg/jpeg/png menor a 1M');</script>";
                    
                    $vuelvecrear=$this->crear();
                    return $vuelvecrear;
                    
                }

                $datos=[
                    'nombre_libro'=>$nombrelibro,
                    'imagen_libro'=>$nuevoImagenlibro
                ];

                $libro->insert($datos);
                return $this->response->redirect(site_url('/listar'));
            }
        } 
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
        var_dump($id_libro=$this->request->getVar('id_libros'));
        
        /*
        $libro = new Libro();

        $datos=[
            'nombre_libro'=>$this->request->getVar('nombrelibro')
        ];
        $idlibro=$this->request->getVar('idlibros'); #idlibros viene de interfaz editar boton hidden
        
        $libro->update($idlibro,$datos);
        */
        /*
        $validacion = $this->validate([
            'imagen_libro'=>[
                'uploaded[imagen_libro]',
                'mime_in[imagen_libro,image/jpg,image/jpeg,image/png]',
                'max_size[imagen_libro,1024]',
            ]
        ]);

        if($validacion){
            if($imagenlibro=$this->request->getFile('imagenlibro')){
            
                $datosLibro=$libro->where('id_libro',$idlibro)->first();
                $ruta=('../public/imagenes/'.$datosLibro['imagen_libro']);
                unlink($ruta);

                $nuevoImagenlibro=$imagenlibro->getRandomName();
                $imagenlibro->move('../public/imagenes/',$nuevoImagenlibro);

                $datos=['imagen_libro'=>$nuevoImagenlibro];
    
                $libro->update($idlibro,$datos);
            }
        }*/

    }


}
