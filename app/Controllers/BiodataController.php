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
        $data = [
            'nama'           => $this->request->getVar('nama'),
            'alamat'         => $this->request->getVar('alamat'),
            'tempat_lahir'   => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'no_telp'        => $this->request->getVar('no_telp'),
            'email'          => $this->request->getVar('email'),
        ];

        $model = new MBiodata();
        $model->insert($data);
        $biodata = $model->find($model->getInsertID());
        return $this->respondCreated($biodata);
    }

    // Menampilkan semua data (alternatif endpoint: /biodata/list)
    public function list()
    {
        $model = new MBiodata();
        $data = $model->findAll();
        return $this->respond($data);
    }

    // Menampilkan detail berdasarkan ID
    public function detail($id)
    {
        $model = new MBiodata();
        $data = $model->find($id);

        if ($data != null) {
            return $this->respond($data);
        } else {
            return $this->failNotFound("Data tidak ditemukan");
        }
    }

    // Mengubah data biodata berdasarkan ID
    public function ubah($id)
    {
        $data = [
            'nama'           => $this->request->getVar('nama'),
            'alamat'         => $this->request->getVar('alamat'),
            'tempat_lahir'   => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'no_telp'        => $this->request->getVar('no_telp'),
            'email'          => $this->request->getVar('email'),
        ];

        $model = new MBiodata();
        $model->update($id, $data);
        $biodata = $model->find($id);
        return $this->respond($biodata);
    }

    // Menghapus data biodata berdasarkan ID
    public function hapus($id)
    {
        $model = new MBiodata();
        $biodata = $model->find($id);

        if ($biodata) {
            $model->delete($id);
            return $this->respondDeleted(['message' => 'Data berhasil dihapus']);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}
