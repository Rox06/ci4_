<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LibroModel;

class Biblioteca extends Controller{

    protected $request;

    public function __construct(){

        $this->model = new LibroModel();
    }

    public function index(){

        $datos = $this->model->getLibros();

        echo view('template/header');
        echo view('libros/libros_view', compact('datos'));
        echo view('template/footer');
    }

    public function addlibro(){

        echo view('template/header');
        echo view('libros/addlibro_view');
        echo view('template/footer');
    }

    public function getdatos(){

        $validacion = $this->validate([
            'nombrelibro' => 'required',
            'imagenlibro'=>[
                'uploaded[imagenlibro]',
                'mime_in[imagenlibro,image/jpg,image/jpeg,image/png]',
                'max_size[imagenlibro,1024]',
            ]
        ]);       
        #Recupera archivo cargado de solicitud HTTP del navegador
        $request = \Config\Services::request();
        $imagenlibro=$request->getFile('imagenlibro');
        
        if($validacion){

            $imagenlibro2=$imagenlibro->getRandomName();
            $imagenlibro->move('imagenes/',$imagenlibro2);

            $datos = [
                'nombre_libro'=> $this->request->getPost('nombrelibro'),
                'imagen_libro'=>$imagenlibro2
            ];

            $this->model->addLibro($datos);

            session()->setFlashdata('mensaje', 'Se ha guardado correctamente');   
            return redirect()->to(base_url('Biblioteca')); 
        }
        else{

            $error = $this->validator->listErrors();
            session()->setFlashdata('mensaje', $error);
            return redirect()->to(base_url('Biblioteca/addlibro'));  
        }
    }

    public function editlibro($id_libro){

        $dato = $this->model->obtainLibro($id_libro);

        echo view('template/header');
        echo view('libros/editlibro_view', compact('dato'));
        echo view('template/footer');
    }

    public function updatelibro(){

        $validacion1 = $this->validate([
            'nombrelibro' => 'required',
        ]);

        $id_libro = $this->request->getPost('idlibro');

        $request = \Config\Services::request();
        $imagenlibro=$request->getFile('imagenlibro');

        if($validacion1){
                   
            if(file_exists($imagenlibro)){

                $validacion2 = $this->validate([
                    'imagenlibro'=>[
                        'uploaded[imagenlibro]',
                        'mime_in[imagenlibro,image/jpg,image/jpeg,image/png]',
                        'max_size[imagenlibro,1024]',
                    ]
                ]);

                if ($validacion2){

                    $imglibro = $this->model->obtainLibro($id_libro);

                    $ruta=('imagenes/'.$imglibro['imagen_libro']);
                    unlink($ruta);

                    $imagenlibro2=$imagenlibro->getRandomName();#Renombra
                    $imagenlibro->move('../public/imagenes/',$imagenlibro2);

                    $datos = [
                        'nombre_libro'=> $this->request->getPost('nombrelibro'),
                        'imagen_libro'=>$imagenlibro2
                    ];
                    
                    $this->model->updateLibro($id_libro, $datos);
    
                    session()->setFlashdata('mensaje', 'Se ha actualizado correctamente img');    
                    return redirect()->to(base_url('Biblioteca'));      

                }
                else{
                    $error = $this->validator->listErrors();
                    session()->setFlashdata('mensaje', $error);
                    return redirect()->to(base_url('Biblioteca/editlibro/'.$id_libro)); 
                }
            }
            else {
                $datos = [
                    'nombre_libro'=> $this->request->getPost('nombrelibro'),
                ];

                $this->model->updateLibro($id_libro, $datos);

                session()->setFlashdata('mensaje', 'Se ha actualizado correctamente');    
                return redirect()->to(base_url('Biblioteca'));
            }
        }
        else{
            $error = $this->validator->listErrors();
            session()->setFlashdata('mensaje', $error);
            return redirect()->to(base_url('Biblioteca/editlibro/'.$id_libro)); 
        }
    }

    public function deletelibro(){

        $id_libro = $this->request->getPost('idlibro');#idlibro viene de bibioteca.js
 
        $eliminado = $this->model->deleteLibro($id_libro);

        if($eliminado){

            session()->setFlashdata('mensaje','Eliminado!');
            return redirect()->to(base_url('Biblioteca')); 
            
        }
        else{

            session()->setFlashdata('mensaje','No se pudo eliminar!');
            return redirect()->to(base_url('Biblioteca')); 

        }
    }
}