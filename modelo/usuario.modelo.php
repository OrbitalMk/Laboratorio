<?php

class ModeloUsuario extends Model implements IModel{

    private $id;
    private $nombres;
    private $apellidos;
    private $cedula;
    private $telefono;
    private $foto;
    private $usuario;
    private $password;
    private $perfil;
    private $estado;

    public function __construct(){
        parent::__construct();
        $this->id = 0;
        $this->nombres = '';
        $this->apellidos = '';
        $this->cedula = '';
        $this->telefono = '';
        $this->foto = '';
        $this->usuario = '';
        $this->password = '';
        $this->perfil = '';
        $this->estado = true;
    }

    public function readByUsername($username){
        try{
            $query = $this->prepare('SELECT * FROM Recepcionista WHERE usuario = :usuario');
            $query->execute([
                'usuario' => $username
            ]);

            if($user = $query->fetch(PDO::FETCH_ASSOC)){
                $this->id = $user['idRecepcionista'];
                $this->setNombres($user['nombres']);
                $this->setApellidos($user['apellidos']);
                $this->setCedula($user['cedula']);
                $this->setTelefono($user['telefono']);
                $this->setFoto($user['foto']);
                $this->setUsuario($user['usuario']);
                $this->setPassword($user['pass']);
                $this->setPerfil($user['perfil']);
                $this->estado = $user['estado'];
            }

            return $this;
        }catch(PDOException $e){
            //Errorlog
        }
    }

    public function readById($id){
        try{
            $query = $this->prepare('SELECT * FROM Recepcionista WHERE idRecepcionista = :idRecepcionista');
            $query->execute([
                'idRecepcionista' => $id
            ]);

            if($user = $query->fetch(PDO::FETCH_ASSOC)){
                $this->id = $user['idRecepcionista'];
                $this->setNombres($user['nombres']);
                $this->setApellidos($user['apellidos']);
                $this->setCedula($user['cedula']);
                $this->setTelefono($user['telefono']);
                $this->setFoto($user['foto']);
                $this->setUsuario($user['usuario']);
                $this->setPassword($user['pass']);
                $this->setPerfil($user['perfil']);
                $this->estado = $user['estado'];
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
                'cedula' => $this->cedula,
                'telefono' => $this->telefono,
                'foto' => $this->foto,
                'usuario' => $this->usuario,
                'password' => $this->password,
                'perfil' => $this->perfil
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function read(){
        try{
            $usuarios = [];

            $query = $this->prepare('CALL RecepcionistaCrud(:operacion, :id, :nombres, :apellidos, :cedula, :telefono, :foto, :usuario, :password, :perfil)');
            $query->execute([
                'operacion' => 'R',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'cedula' => $this->cedula,
                'telefono' => $this->telefono,
                'foto' => $this->foto,
                'usuario' => $this->usuario,
                'password' => $this->password,
                'perfil' => $this->perfil
            ]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $usuario = new ModeloUsuario();
                $usuario->id = $p['idRecepcionista'];
                $usuario->setNombres($p['nombres']);
                $usuario->setApellidos($p['apellidos']);
                $usuario->setCedula($p['cedula']);
                $usuario->setTelefono($p['telefono']);
                $usuario->setFoto($p['foto']);
                $usuario->setUsuario($p['usuario']);
                $usuario->setPassword($p['pass']);
                $usuario->setPerfil($p['perfil']);
                $usuario->estado = $p['estado'];

                array_push($usuarios, $usuario);
            }

            return $usuarios;
        }catch(PDOException $e){
            //Errorlog
        }
    }

    public function delete(){
        try{
            $query = $this->prepare('CALL RecepcionistaCrud(:operacion, :id, :nombres, :apellidos, :cedula, :telefono, :foto, :usuario, :password, :perfil)');
            $query->execute([
                'operacion' => 'D',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'cedula' => $this->cedula,
                'telefono' => $this->telefono,
                'foto' => $this->foto,
                'usuario' => $this->usuario,
                'password' => $this->password,
                'perfil' => $this->perfil
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function update(){
        try{
            $query = $this->prepare('CALL RecepcionistaCrud(:operacion, :id, :nombres, :apellidos, :cedula, :telefono, :foto, :usuario, :password, :perfil)');
            $query->execute([
                'operacion' => 'U',
                'id' => $this->id,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'cedula' => $this->cedula,
                'telefono' => $this->telefono,
                'foto' => $this->foto,
                'usuario' => $this->usuario,
                'password' => $this->password,
                'perfil' => $this->perfil
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function from($array){
        $this->id = $array['idRecepcionista'];
        $this->setNombres($array['nombres']);
        $this->setApellidos($array['apellidos']);
        $this->setCedula($array['cedula']);
        $this->setTelefono($array['telefono']);
        $this->setFoto($array['foto']);
        $this->setUsuario($array['usuario']);
        $this->setPassword($array['pass']);
        $this->setPerfil($array['perfil']);
        $this->estado = $array['estado'];
    }

    public function setNombres($nombres){
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function setCedula($cedula){
        $this->cedula = $cedula;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
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

    public function getCedula(){
        return $this->cedula;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getFoto(){
        return $this->foto;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getPerfil(){
        return $this->perfil;
    }

    public function getEstado(){
        return $this->estado;
    }
}