<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
    exit;
}

class Login extends REST_Controller {

    public function __construct() {
        //llamando a constructor padre
        parent::__construct();
        $this->load->database(); //pegandose a la base
        $this->load->model('User_model'); //cargando el modelo User
    }

    /**
     * Metodo que entrega todos los registros academicos del docente
     * url del servicio: http://192.168.100.150/codigneiter/index.php/Registrosacademicos/registros/ZG9jZWluaTFAbWFpbC5jb20yMDIxMDMwMjE3Mjk0MA==
     */
    public function login_post() {
        if (json_decode(file_get_contents('php://input'), true)) {
            $data = json_decode(file_get_contents('php://input'), true);
        } else {
            $data = $this->post();
        }

        $login = $this->User_model->login($data);

        if ($login == false) {
            $respuesta = array(
                'error' => true,
                'message' => 'Usuario y/o clave incorrecto!!!',
                'data' => null
            );
        } else {
            $respuesta = array(
                'error' => false,
                'message' => 'Conexión correcta',
                'data' => $login
            );
        }
        $this->response($respuesta);
    }

}
