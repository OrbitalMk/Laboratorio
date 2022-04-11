<?php

class ModeloCentroMedico extends Model implements IModel{

    private $id;
    private $nombre;
    private $departamento;
    private $telefono;
    private $estado;

    public function __construct(){
        parent::__construct();
        $this->id = 0;
        $this->nombre = '';
        $this->departamento = '';
        $this->telefono = '';
        $this->estado = true;
    }

    public function readById($id){
        try{
            $query = $this->prepare('SELECT * FROM UnidadDeSalud WHERE idUnidadDeSalud = :idUnidadDeSalud');
            $query->execute([
                'idUnidadDeSalud' => $id
            ]);

            if($centro = $query->fetch(PDO::FETCH_ASSOC)){
                $this->id = $centro['idMedico'];
                $this->setNombre($centro['nombre']);
                $this->setDepartamento($centro['departamento']);
                $this->setTelefono($centro['telefono']);
                $this->estado = $centro['estado'];
            }   

            return $this;
        }catch(PDOException $e){
            //Errorlog
        }
    }

    public function create(){
        try{
            $query = $this->prepare('CALL UnidadCrud(:operacion, :id, :nombre, :departamento, :telefono)');
            $query->execute([
                'operacion' => 'C',
                'id' => $this->id,
                'nombre' => $this->nombre,
                'departamento' => $this->departamento,
                'telefono' => $this->telefono
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function read(){
        try{
            $centros = [];

            $query = $this->prepare('CALL UnidadCrud(:operacion, :id, :nombre, :departamento, :telefono)');
            $query->execute([
                'operacion' => 'R',
                'id' => $this->id,
                'nombre' => $this->nombre,
                'departamento' => $this->departamento,
                'telefono' => $this->telefono
            ]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $centro = new ModeloCentroMedico();
                $centro->id = $p['idUnidadDeSalud'];
                $centro->setNombre($p['nombre']);
                $centro->setDepartamento($p['departamento']);
                $centro->setTelefono($p['telefono']);
                $centro->estado = $p['estado'];

                array_push($centros, $centro);
            }

            return $centros;
        }catch(PDOException $e){
            //Errorlog
        }
    }

    public function delete(){
        try{
            $query = $this->prepare('CALL UnidadCrud(:operacion, :id, :nombre, :departamento, :telefono)');
            $query->execute([
                'operacion' => 'D',
                'id' => $this->id,
                'nombre' => $this->nombre,
                'departamento' => $this->departamento,
                'telefono' => $this->telefono
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function update(){
        try{
            $query = $this->prepare('CALL UnidadCrud(:operacion, :id, :nombre, :departamento, :telefono)');
            $query->execute([
                'operacion' => 'U',
                'id' => $this->id,
                'nombre' => $this->nombre,
                'departamento' => $this->departamento,
                'telefono' => $this->telefono
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function from($array){
        $this->id = $array['idMedico'];
        $this->setNombre($array['nombre']);
        $this->setDepartamento($array['departamento']);
        $this->setTelefono($array['telefono']);
        $this->estado = $array['estado'];
    }


    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setDepartamento($departamento){
        $this->departamento = $departamento;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }


    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getDepartamento(){
        return $this->departamento;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getEstado(){
        return $this->estado;
    }
}