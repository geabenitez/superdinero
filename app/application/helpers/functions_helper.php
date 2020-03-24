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
    'assets/js/es.js',
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
      $tmp['image']=$v->image;
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


function getAmounts($id){
  $CI =& get_instance();

  if (!empty($id)) {
    $data = $CI->db->get_where("amounts", ['id' => $id])->result();
  } else {
    $data = $CI->db->get("amounts")->result();
  }

  $result=array();

  if (!empty($data)) {
    foreach ($data as $v) {
      $tmp = array();
      $tmp['id']=$v->id;
      $tmp['from']=$v->from;
      $tmp['until']=$v->until;
      $tmp['active']=$v->active;
      $tmp['created_at']=$v->created_at;
      $tmp['updated_at']=$v->updated_at;
      $result[]=$tmp;
    }
  }

  return $result;
}



function getDocuments($id){
  $CI =& get_instance();

  if (!empty($id)) {
    $data = $CI->db->get_where("documents", ['id' => $id])->result();
  } else {
    $data = $CI->db->get("documents")->result();
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


function getRecords($id){
  $CI =& get_instance();

  if (!empty($id)) {
    $data = $CI->db->get_where("records", ['id' => $id])->result();
  } else {
    $data = $CI->db->get("records")->result();
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

function getMethods($id){
  $CI =& get_instance();

  if (!empty($id)) {
    $data = $CI->db->get_where("methods", ['id' => $id])->result();
  } else {
    $data = $CI->db->get("methods")->result();
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

function getStates($id){
  $CI =& get_instance();

  if (!empty($id)) {
    $data = $CI->db->get_where("states", ['id' => $id])->result();
  } else {
    $data = $CI->db->get("states")->result();
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



function getPartners($id){
  $CI =& get_instance();
  if (!empty($id) || $id != 0) {
    $partners = $CI->db->get_where("partners", ['id' => $id])->row_array();
  } else {
    $partners = $CI->db->get("partners")->result();
  }

  foreach ($partners as $key => $value) {
    $c = "categories";
    $pc = "partners_categories";
    $s = "states";
    $ps = "partners_states";
    $cr = "credits";
    $pcr = "partners_credits";
    $a = "amounts";
    $pa = "partners_amounts";
    $d = "documents";
    $pd = "partners_documents";
    $r = "records";
    $pr = "partners_records";
    $getCategories = array(
      $c.'.id',
      $c.'.nameES',
      $c.'.nameEN'
    );
    $getStates = array(
      $s.'.id',
      $s.'.nameES',
      $s.'.nameEN',
    );
    $getAmounts = array(
      $a.'.id',
      $a.'.from',
      $a.'.until',
      $a.'.active',
    );
    $getCredits = array(
      $cr.'.id',
      $cr.'.nameES',
      $cr.'.nameEN',
      $cr.'.slug',
      $cr.'.active',
      $cr.'.askAlways',
      $cr.'.questionEN',
      $cr.'.questionES',
    );
    $getDocuments = array(
      $d.'.id',
      $d.'.nameES',
      $d.'.nameEN',
      $d.'.active',
    );
    $getRecords = array(
      $r.'.id',
      $r.'.nameES',
      $r.'.nameEN',
      $r.'.active',
    );

    $value->categories = $CI->db
    ->select($getCategories)
    ->from($pc)
    ->where($pc.'.partnerId', $value->id)
    ->join($c, $c.'.id = ' . $pc . '.categoryId', 'right')
    ->get()->result();

    $value->states = $CI->db
    ->select($getStates)
    ->from($ps)
    ->where($ps.'.partnerId', $value->id)
    ->join($s, $s.'.id = ' . $ps . '.stateId', 'right')
    ->get()->result();

    $value->amounts = $CI->db
    ->select($getAmounts)
    ->from($pa)
    ->where($pa.'.partnerId', $value->id)
    ->join($a, $a.'.id = ' . $pa . '.amountId', 'right')
    ->get()->result();

    $value->credits = $CI->db
    ->select($getCredits)
    ->from($pcr)
    ->where($pcr.'.partnerId', $value->id)
    ->join($cr, $cr.'.id = ' . $pcr . '.creditsId', 'right')
    ->get()->result();

    $value->documents = $CI->db
    ->select($getDocuments)
    ->from($pd)
    ->where($pd.'.partnerId', $value->id)
    ->join($d, $d.'.id = ' . $pd . '.documentId', 'right')
    ->get()->result();

    $value->records = $CI->db
    ->select($getRecords)
    ->from($pr)
    ->where($pr.'.partnerId', $value->id)
    ->join($r, $r.'.id = ' . $pr . '.recordId', 'right')
    ->get()->result();
  }

  return $partners;

}

function getCodes($id){
  $CI =& get_instance();

  if (!empty($id)) {
    $data = $CI->db->get_where("codes", ['id' => $id])->result();
  } else {
    $data = $CI->db->get("codes")->result();
  }

  $result=array();

  if (!empty($data)) {
    foreach ($data as $v) {
      $tmp = array();
      $tmp['id']=$v->id;
      $tmp['codigo']=$v->codigo;
      $tmp['agent']=$v->agent;
      $tmp['configuracion']=$v->configuracion;
      $tmp['created_at']=$v->created_at;
      $tmp['updated_at']=$v->updated_at;
      $result[]=$tmp;
    }
  }

  return $result;
}



function checkAdmin($profile)
{
  if ($profile==1) {return true; }else{return false;}
}





?>