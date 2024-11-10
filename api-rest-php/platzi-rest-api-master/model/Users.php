<?php
include("../controller/configBd.php");
include ("../controller/ControlConexion.php");

class User{
	private $id;
    private $date_birth;
    private $username;
    private $middlename;
    private $lastname;
    private $email;
    private $phone;
    private $signed_consent;
    private $child;
	
	public function __construct( $id, $username, $date_birth, $middlename, $lastname, $email, $phone, $signed_consent, $child ) {
		$this->id=$id;
		$this->username=$username;
		$this->date_birth=$date_birth;
		$this->middlename=$middlename;
		$this->lastname=$lastname;
		$this->email=$email;
		$this->phone=$phone;
		$this->signed_consent=$signed_consent;
        $this->child=$child;
	}

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getDateBirth() {
        return $this->date_birth;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getMiddlename() {
        return $this->middlename;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getSignedConsent() {
        return $this->signed_consent;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setDateBirth($date_birth) {
        $this->date_birth = $date_birth;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setMiddlename($middlename) {
        $this->middlename = $middlename;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setSignedConsent($signed_consent) {
        $this->signed_consent = $signed_consent;
    }


	public function insert_user()
    {
		$usernamejoined= $this->username;
		$brithjoined= $this->date_birth;
		$middlejoined= $this->middlename;
		$lastjoined= $this->lastname;
		$emailjoined= $this->email;
		$phonejoined= $this->phone;
		$consentjoined= $this->signed_consent;
		$comandoSql = "INSERT INTO users (username, date_birth, middlename, lastname, email, phone, signed_consent) VALUES ('".$usernamejoined."','".$brithjoined."','".$middlejoined."','".$lastjoined."','".$emailjoined."','".$phonejoined."','".$consentjoined."')";
		$objConexion=new ControlConexion();
		$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
		$objConexion->ejecutarComandoSql($comandoSql);
		$objConexion->cerrarBd();
		return true;
    }

    public function consult_users(){
        $comandoSql = "
            SELECT 
                users.id as id_user,
                date_birth,	
                username,	
                middlename,	
                lastname,	
                email,	
                phone,	
                signed_consent	,
                child.id as id_child,
                user_id	as fk_user_id,
                child_name,	
                child_middlename,	
                child_lastname,	
                child_date_of_birth
            FROM users LEFT JOIN child ON users.id = child.user_id;
        ";
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $result=$objConexion->ejecutarSelect($comandoSql);
        $object_result = $result->fetch_all(MYSQLI_ASSOC);

        $data = array();
        foreach ($object_result as $row) {
            $user_id = $row['id_user'];
            
            if (!isset($data[$user_id])) {
                // Crear una entrada para el usuario con sus datos
                $data[$user_id] = array(
                    'id_user' => $row['id_user'],
                    'date_birth' => $row['date_birth'],
                    'username' => $row['username'],
                    'middlename' => $row['middlename'],
                    'lastname' => $row['lastname'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'signed_consent' => $row['signed_consent'],
                    'children' => array()
                );
            }
        
            // Si hay datos de hijo (child) asociados, agregarlos a la lista de hijos del usuario
            if (!empty($row['child_name'])) {
                $child = array(
                    'id_child' => $row['id_child'], // Usamos el 'id' del hijo
                    'fk_user_id' => $row['fk_user_id'], // Usamos el 'user_id' del hijo en lugar del 'id' del usuario padre
                    'child_name' => $row['child_name'],
                    'middlename' => $row['child_middlename'],
                    'lastname' => $row['child_lastname'],
                    'child_date_of_birth' => $row['child_date_of_birth']
                );
                $data[$user_id]['children'][] = $child;
            }
        }
        // Convertir el resultado en un array de usuarios (ignorando los índices numéricos)
        $resultArray = array_values($data);
        $objConexion->cerrarBd();
        return $resultArray;
    }
}