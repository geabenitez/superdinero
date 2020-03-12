<?php
class Secure_Controller extends CI_Controller {

    private $CI;
    private $userdata;
    private $login_page = "login";
    private $process_login = "process_login";

    function __construct() {
        parent::__construct();
        $this->CI =& get_instance();
        $this->islogin();
    }

    /*
     * Funcion que verifica si la sesión se ha iniciado
     * @return: VOID
     * */
    public function islogin() {
        $this->userdata = $this->CI->session->userdata();

        //verifica si esta logado asigna TRUE or FALSE
        if($this->CI->session->has_userdata('logged')){
            $logged = $this->userdata['logged'];
        }else{
            $logged = false;
        };

        //verifica si es la pagina de loggin
        if(uri_string() == $this->login_page || uri_string() == $this->process_login) {
            $is_login_page = true;
        }else{
            $is_login_page = false;
        }

        if(!$is_login_page){
            if(!$logged){
                redirect(site_url($this->login_page));
            }
        }else{
            if($logged){
                redirect(site_url('inicio'));
            }
        }
    }

}