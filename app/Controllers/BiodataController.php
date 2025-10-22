<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MBiodata;

class BiodataController extends ResourceController
{
    protected $format = 'json';

    // Menampilkan semua data biodata
    public function index()
    {
        $model = new MBiodata();
        $data = $model->findAll();
        return $this->respond($data);
    }

    // Membuat data biodata baru
    public function create()
    {
        $jenisKelamin = $this->request->getVar('jenis_kelamin');
        $tanggalLahir = $this->request->getVar('tanggal_lahir');

        $allowedGender = ['Laki-laki', 'Perempuan'];
        if (!in_array($jenisKelamin, $allowedGender)) {
            return $this->failValidationErrors('Jenis kelamin harus Laki-laki atau Perempuan');
        }

        $formattedDate = $tanggalLahir ? date('Y-m-d', strtotime($tanggalLahir)) : null;

        $data = [
            'nama'           => $this->request->getVar('nama'),
            'alamat'         => $this->request->getVar('alamat'),
            'tempat_lahir'   => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir'  => $formattedDate,
            'jenis_kelamin'  => $jenisKelamin,
            'no_telp'        => $this->request->getVar('no_telp'),
            'email'          => $this->request->getVar('email'),
        ];

        $model = new MBiodata();
        $model->insert($data);
        $biodata = $model->find($model->getInsertID());
        return $this->respondCreated($biodata);
    }

    // Menampilkan semua data
    public function list()
    {
        $model = new MBiodata();
        return $this->respond($model->findAll());
    }

    // Menampilkan detail berdasarkan ID
    public function detail($id)
    {
        $model = new MBiodata();
        $data = $model->find($id);

        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound("Data tidak ditemukan");
    }

    // Mengubah data biodata berdasarkan ID
    public function ubah($id)
    {
        $model = new MBiodata();

        $jenisKelamin = $this->request->getVar('jenis_kelamin');
        $tanggalLahir = $this->request->getVar('tanggal_lahir');

        $formattedDate = $tanggalLahir ? date('Y-m-d', strtotime($tanggalLahir)) : null;

        $data = [
            'nama'           => $this->request->getVar('nama'),
            'alamat'         => $this->request->getVar('alamat'),
            'tempat_lahir'   => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir'  => $formattedDate,
            'jenis_kelamin'  => $jenisKelamin,
            'no_telp'        => $this->request->getVar('no_telp'),
            'email'          => $this->request->getVar('email'),
        ];

        if ($model->update($id, $data)) {
            return $this->respond(['status' => 'success', 'message' => 'Data berhasil diubah']);
        } else {
            return $this->fail('Gagal mengubah data');
        }
    }

    // Menghapus data biodata berdasarkan ID
    public function hapus($id)
    {
        $model = new MBiodata();
        $biodata = $model->find($id);

        if ($biodata) {
            $model->delete($id);
            return $this->respondDeleted(['message' => 'Data berhasil dihapus']);
        }
        return $this->failNotFound('Data tidak ditemukan');
    }
}
