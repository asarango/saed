<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    
    private $username;
    private $password;
    
    /**********
     * (1)
     * METODO QUE RECIBE INFORMACION DE USUARIO PARA REALIZAR LOGIN
     * 
     */
    public function login($dataPost){
        
        $username = $dataPost['username'];
        $pass = $dataPost['password'];
        
        $password = md5($pass);
        
        
        $sql = 'SELECT seguridad."ValidarUsuarioClave"('."'$username','$password','permisos','empresas','estado');";
        
        /**** para tomar cursores de consulta de login*////
        pg_query("BEGIN;");
        $procAlmacenado    = pg_query($sql);
        $respuesta         = pg_fetch_all($procAlmacenado);

        $respEstado        = pg_query("FETCH ALL estado;");
        $respPermisos      = pg_query("FETCH ALL permisos;");
        $respEmpresas      = pg_query("FETCH ALL empresas;");
        
        $estado            = pg_fetch_all($respEstado);
        $permisos          = pg_fetch_all($respPermisos);
        $empresas          = pg_fetch_all($respEmpresas);
        
        pg_query("END;");
        
        $estado     ? $estado   = $estado   : $estado   = null;
        $permisos   ? $permisos = $permisos : $permisos = null;
        $empresas   ? $empresas = $empresas : $empresas = null;
        
        return array(
            'estado'    => $estado,
            'permisos'  => $permisos,
            'empresas'  => $empresas
        );
    }
}