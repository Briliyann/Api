<?php

namespace App\Models;

use CodeIgniter\Model;

class MBiodata extends Model
{
    protected $table = 'biodata';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telp',
        'email'
    ];

    // Opsional: format otomatis tanggal ke Y-m-d saat insert/update
    protected $beforeInsert = ['formatTanggal'];
    protected $beforeUpdate = ['formatTanggal'];

    protected function formatTanggal(array $data)
    {
        if (isset($data['data']['tanggal_lahir'])) {
            $tgl = $data['data']['tanggal_lahir'];
            // jika bukan format Y-m-d, ubah ke format ini
            if (strtotime($tgl)) {
                $data['data']['tanggal_lahir'] = date('Y-m-d', strtotime($tgl));
            }
        }
        return $data;
    }
}
