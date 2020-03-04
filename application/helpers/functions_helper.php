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

function getCredits($id){
  $CI =& get_instance();

  if (!empty($id)) {
    $data = $CI->db->get_where("credits", ['id' => $id])->result();
  } else {
    $data = $CI->db->get("credits")->result();
  }

  $result=array();

  if (!empty($data)) {
    foreach ($data as $v) {
      $tmp = array();
      $tmp['id']=$v->id;
      $tmp['nameES']=$v->nameES;
      $tmp['nameEN']=$v->nameEN;
      $tmp['active']=$v->active;
      $tmp['askAlways']=$v->askAlways;
      $tmp['questionEN']=$v->questionEN;
      $tmp['questionES']=$v->questionES;
      $tmp['maxAmount']=$v->maxAmount;
      $tmp['minAmount']=$v->minAmount;
      $tmp['slug']=$v->slug;
      $tmp['created_at']=$v->created_at;
      $tmp['updated_at']=$v->updated_at;
      
      $tmp['categories']=array();
      $categories = $CI->db->get_where("credits_categories", ['creditId' => $v->id])->result();
      if (!empty($categories)) {
        foreach ($categories as $c) {
          array_push($tmp['categories'],$c->categoryId);
        }
      }
      $result[]=$tmp;
    }
  }
  return $result;
}


function getCategories($id){
  $CI =& get_instance();

  if (!empty($id)) {
    $data = $CI->db->get_where("categories", ['id' => $id])->result();
  } else {
    $data = $CI->db->get("categories")->result();
  }

  $result=array();

  if (!empty($data)) {
    foreach ($data as $v) {
      $tmp = array();
      $tmp['id']=$v->id;
      $tmp['nameES']=$v->nameES;
      $tmp['nameEN']=$v->nameEN;
      $tmp['active']=$v->active;
      $tmp['created_at']=$v->created_at;
      $tmp['updated_at']=$v->updated_at;
      $result[]=$tmp;
    }
  }

  return $result;
}

?>