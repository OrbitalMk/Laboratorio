<?php

class ModeloPaciente extends Model implements IModel{

    private $id;
    private $nombres;
    private $apellidos;
    private $nacimiento;
    private $edad;
    private $inss;
    private $direccion;
    private $telefono;
    private $sexo;
    private $estado;

    public function __construct(){
        parent::__construct();
        $this->id = 0;
        $this->nombres = '';
        $this->apellidos = '';
        $this->nacimiento = '';
        $this->edad = '';
        $this->inss = '';
        $this->direccion = '';
        $this->telefono = '';
        $this->sexo = '';
        $this->estado = true;
    }

    public function readById($id){
        try{
            $query = $this->prepare('SELECT * FROM Cliente WHERE idCliente = :idCliente');
            $query->execute([
                'idCliente' => $id
            ]);

            if($paciente = $query->fetch(PDO::FETCH_ASSOC)){
                $this->id = $paciente['idCliente'];
                $this->setNombres($paciente['nombres']);
                $this->setApellidos($paciente['apellidos']);
                $this->setNacimiento($paciente['nacimiento']);
                $this->edad = $paciente['edad'];
                $this->setInss($paciente['inss']);
                $this->setDireccion($paciente['direccion']);
                $this->setTelefono($paciente['telefono']);
                $this->setSexo($paciente['sexo']);
                $this->estado = $paciente['estado'];
            }   

            return $this;
        }catch(PDOException $e){
            //Errorlog
        }
    }

    public function create(){
        try{
            $query = $this->prepare('CALL RecepcionistaCrud(:operacion, :id, :nombres, :apellidos, :cedula, :telefono, :foto, :usuario, :password, :perfil)');
            $query->execute([
                'operacion' => 'C',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'nacimiento' => $this->nacimiento,
                'inss' => $this->inss,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'sexo' => $this->sexo
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function read(){
        try{
            $pacientes = [];

            $query = $this->prepare('CALL ClienteCrud(:operacion, :id, :nombres, :apellidos, :nacimiento, :inss, :direccion, :telefono, :sexo)');
            $query->execute([
                'operacion' => 'R',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'nacimiento' => $this->nacimiento,
                'inss' => $this->inss,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'sexo' => $this->sexo
            ]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $paciente = new ModeloPaciente();
                $paciente->id = $p['idCliente'];
                $paciente->setNombres($p['nombres']);
                $paciente->setApellidos($p['apellidos']);
                $paciente->setNacimiento($p['nacimiento']);
                $paciente->edad = $p['edad'];
                $paciente->setInss($p['inss']);
                $paciente->setDireccion($p['direccion']);
                $paciente->setTelefono($p['telefono']);
                $paciente->setSexo($p['sexo']);
                $paciente->estado = $p['estado'];

                array_push($pacientes, $paciente);
            }

            return $pacientes;
        }catch(PDOException $e){
            //Errorlog
        }
    }

    public function delete(){
        try{
            $query = $this->prepare('CALL ClienteCrud(:operacion, :id, :nombres, :apellidos, :nacimiento, :inss, :direccion, :telefono, :sexo)');
            $query->execute([
                'operacion' => 'D',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'nacimiento' => $this->nacimiento,
                'inss' => $this->inss,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'sexo' => $this->sexo
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function update(){
        try{
            $query = $this->prepare('CALL ClienteCrud(:operacion, :id, :nombres, :apellidos, :nacimiento, :inss, :direccion, :telefono, :sexo)');
            $query->execute([
                'operacion' => 'U',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'nacimiento' => $this->nacimiento,
                'inss' => $this->inss,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'sexo' => $this->sexo
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function from($array){
        $this->id = $array['idCliente'];
        $this->setNombres($array['nombres']);
        $this->setApellidos($array['apellidos']);
        $this->setNacimiento($array['nacimiento']);
        $this->edad = $array['edad'];
        $this->setInss($array['inss']);
        $this->setDireccion($array['direccion']);
        $this->setTelefono($array['telefono']);
        $this->setSexo($array['sexo']);
        $this->estado = $array['estado'];
    }

    public function setNombres($nombres){
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function setNacimiento($nacimiento){
        $this->nacimiento = $nacimiento;
    }

    public function setInss($inss){
        $this->inss = $inss;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function setSexo($sexo){
        $this->sexo = $sexo;
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

    public function getNacimiento(){
        return $this->nacimiento;
    }

    public function getEdad(){
        return $this->edad;
    }

    public function getInss(){
        return $this->inss;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getSexo(){
        return $this->sexo;
    }

    public function getEstado(){
        return $this->estado;
    }
}