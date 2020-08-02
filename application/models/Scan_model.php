<?php

class Scan_model extends Ci_Model
{
    public function cek_id($id_karyawan)
    {
        $query_str =
            $this->db->where('id_karyawan', $id_karyawan)
            ->get('karyawan');
        if ($query_str->num_rows() > 0) {
            return $query_str->row();
        } else {
            return false;
        }
    }

    public function absen_masuk($data)
    {
        return $this->db->insert('presensi', $data);
    }

    public function cek_kehadiran($id_karyawan, $tgl)
    {
        $query_str =
            $this->db->where('id_karyawan', $id_karyawan)
            ->where('tgl', $tgl)->get('presensi');
        if ($query_str->num_rows() > 0) {
            return $query_str->row();
        } else {
            return false;
        }
    }

    public function absen_pulang($id_karyawan, $data)
    {
        $tgl = date('Y-m-d');
        return $this->db->where('id_karyawan', $id_karyawan)
            ->where('tgl', $tgl)
            ->update('presensi', $data);
    }
}
