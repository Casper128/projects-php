<?php
include("../controller/configBd.php");
include ("../controller/ControlConexion.php");

class Child{
	private $id;
    private $user_id;
    private $date_birth;
    private $username;
    private $middlename;
    private $lastname;
	
	public function __construct( $id, $user_id , $username, $middlename, $lastname, $date_birth ) {
		$this->id=$id;
		$this->user_id=$user_id;
		$this->username=$username;
		$this->middlename=$middlename;
		$this->lastname=$lastname;
		$this->date_birth=$date_birth;
	}

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
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

    public function getDateBirth() {
        return $this->date_birth;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
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

    public function setDateBirth($date_birth) {
        $this->date_birth = $date_birth;
    }

	public function insert_child(){
		$user_idjoined=$this->user_id;
		$usernamejoined=$this->username;
		$middlenamejoined=$this->middlename;
		$lastnamejoined=$this->lastname;
		$date_birthjoined=$this->date_birth;
		$comandoSql = "INSERT INTO child (user_id, child_name, child_middlename, child_lastname, child_date_of_birth) VALUES ('".$user_idjoined."','".$usernamejoined."','".$middlenamejoined."','".$lastnamejoined."','".$date_birthjoined."')";
		$objConexion=new ControlConexion();
		$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
		$objConexion->ejecutarComandoSql($comandoSql);
		$objConexion->cerrarBd();
		return true;
    }


    public function consult_childs_by_id(){
        $comandoSql = "SELECT * FROM child WHERE id=".$this->$id."";
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $result=$objConexion->ejecutarSelect($comandoSql);
        $object_result = $result->fetch_all(MYSQLI_ASSOC);
        $objConexion->cerrarBd();
        return $object_result;
    }

    public function consult_childs(){
        $comandoSql = "SELECT * FROM child";
        $objConexion = new ControlConexion();
        $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
        $result=$objConexion->ejecutarSelect($comandoSql);
        $object_result = $result->fetch_all(MYSQLI_ASSOC);
        $objConexion->cerrarBd();
        return $object_result;
    }
}