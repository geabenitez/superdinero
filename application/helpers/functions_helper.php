<?php

function basic_styles() {
  return array(
    'assets/css/tailwind.min.css',
    'assets/css/element.min.css',
    'assets/css/custom.css'
  );
}

function basic_scripts() {
  return array(
    'assets/js/vue.min.js',
    'assets/js/element.min.js',
    'assets/js/es.js'
  );
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
        foreach ($value as $k => $resource) {
          array_push($resources[$key], $resource);  
        }  
      }
  }
  $CI->load->view('admin/layout/index', $resources);
}
?>