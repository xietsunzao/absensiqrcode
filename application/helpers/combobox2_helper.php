<?php
function cmb_dinamis2($name,$id,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control' id='$id'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d){
        if($d->$pk ==1)
        {
          $cmb .= $selected==$d->$pk?" disabled='disabled'":'';
        }
        else{
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
      }
    }
    $cmb .="</select>";
    return $cmb;
}
