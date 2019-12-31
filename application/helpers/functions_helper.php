<?php

function basic_styles() {
  return array(
    'assets/css/tailwind.min.css'
  );
}

function basic_scripts() {
  return array();
}

function admin_page($view, $page_title, $page_id, $recursos = null) {
  //obtiene la instancia de Codeigniter
  $CI =& get_instance();

  //define los scripts basicos
  $resources['styles'] = basic_styles();
  $resources['scripts'] = basic_scripts();
  $resources['page'] = $view;
  $resources['page_title'] = $page_title;
  $resources['page_id'] = $page_id;

  /*si se enviaron estilos y scripts para cargar la pagina se incluyen a los resources*/
  if ($recursos != null) {
      foreach ($recursos as $key => $value) {
          $resources[$key] = $value;
      }
  }

  $CI->load->view('admin/layout/index', $resources);
}
?>