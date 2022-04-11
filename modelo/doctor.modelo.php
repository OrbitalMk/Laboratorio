<?php

require_once "conexion.php";

class ModeloDoctor extends Model implements IModel{

    private $id;
    private $nombres;
    private $apellidos;
    private $codigoSanitario;
    private $telefono;
    private $estado;

    public function __construct(){
        parent::__construct();
        $this->id = 0;
        $this->nombres = '';
        $this->apellidos = '';
        $this->codigoSanitario = '';
        $this->telefono = '';
        $this->estado = true;
    }

    public function readById($id){
        try{
            $query = $this->prepare('SELECT * FROM Medico WHERE idMedico = :idMedico');
            $query->execute([
                'idMedico' => $id
            ]);

            if($medico = $query->fetch(PDO::FETCH_ASSOC)){
                $this->id = $medico['idMedico'];
                $this->setNombres($medico['nombres']);
                $this->setApellidos($medico['apellidos']);
                $this->setCodigoSanitario($medico['codigoSanitario']);
                $this->setTelefono($medico['telefono']);
                $this->estado = $medico['estado'];
            }   

            return $this;
        }catch(PDOException $e){
            //Errorlog
        }
    }

    public function create(){
        try{
            $query = $this->prepare('CALL MedicoCrud(:operacion, :id, :nombres, :apellidos, :codigoSanitario, :telefono)');
            $query->execute([
                'operacion' => 'C',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'codigoSanitario' => $this->codigoSanitario,
                'telefono' => $this->telefono
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function read(){
        //try{
            $medicos = [];

            $query = $this->prepare('CALL MedicoCrud(:operacion, :id, :nombres, :apellidos, :codigoSanitario, :telefono)');
            $query->execute([
                'operacion' => 'R',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'codigoSanitario' => $this->codigoSanitario,
                'telefono' => $this->telefono
            ]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $medico = new ModeloDoctor();
                $medico->id = $p['idMedico'];
                $medico->setNombres($p['nombres']);
                $medico->setApellidos($p['apellidos']);
                $medico->setCodigoSanitario($p['codigoSanitario']);
                $medico->setTelefono($p['telefono']);
                $medico->estado = $p['estado'];

                array_push($medicos, $medico);
            }

            return $medicos;
        /*}catch(PDOException $e){
            //Errorlog
        }*/
    }

    public function delete(){
        try{
            $query = $this->prepare('CALL MedicoCrud(:operacion, :id, :nombres, :apellidos, :codigoSanitario, :telefono)');
            $query->execute([
                'operacion' => 'D',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'codigoSanitario' => $this->codigoSanitario,
                'telefono' => $this->telefono
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function update(){
        try{
            $query = $this->prepare('CALL MedicoCrud(:operacion, :id, :nombres, :apellidos, :codigoSanitario, :telefono)');
            $query->execute([
                'operacion' => 'U',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'codigoSanitario' => $this->codigoSanitario,
                'telefono' => $this->telefono
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function from($array){
        $this->id = $array['idMedico'];
        $this->setNombres($array['nombres']);
        $this->setApellidos($array['apellidos']);
        $this->setCodigoSanitario($array['codigoSanitario']);
        $this->setTelefono($array['telefono']);
        $this->estado = $array['estado'];
    }


    public function setNombres($nombres){
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function setCodigoSanitario($codigoSanitario){
        $this->codigoSanitario = $codigoSanitario;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }


    public function getId(){
        return $this->id;
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getCodigoSanitario(){
        return $this->codigoSanitario;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getEstado(){
        return $this->estado;
    }
}