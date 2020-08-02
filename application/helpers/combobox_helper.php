<?php
function cmb_dinamis($name, $id, $table, $field, $pk, $selected)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control' id='$id'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" .  strtoupper($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function cmb_dinamis2($name, $id, $table, $field, $pk, $selected)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control' id='$id'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        if ($d->$pk == 1) {
            $cmb .= "<option value='" . $d->$pk . "'disabled>" .  strtoupper($d->$field) . "</option>";
        } 
        else if($d->id_khd == $selected) {
            $cmb .= "<option value='" . $d->$pk . "'selected>" .  strtoupper($d->$field) . "</option>";
        }
        else {
            $cmb .= "<option value='" . $d->$pk . "'>" .  strtoupper($d->$field) . "</option>";

        }
    }
    $cmb .= "</select>";
    return $cmb;
}

function cmb_dinamis3($name, $id, $table, $field, $pk, $selected)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control' id='$id'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        if ($d->$pk == 1) {
            $cmb .= "<option value='" . $d->$pk . "'selected>" .  strtoupper($d->$field) . "</option>";
        } else {
            $cmb .= "<option value='" . $d->$pk . "'disabled>" .  strtoupper($d->$field) . "</option>";
        }
    }
    $cmb .= "</select>";
    return $cmb;
}

function cmb_dinamis4($name, $table, $field, $pk, $selected)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" .  strtoupper($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}


function cmb_dinamis9($name, $id, $table, $field, $pk)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control' id='$id'>";
    $data = $ci->db->get($table)->result();
    $cmb .= "<option value='0'>KESELURUHAN";
    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= ">" .  strtoupper($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}
