<?php
 namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
 use App\Models\MRegistrasi;

 class RegistrasiController extends ResourceController
 {
protected $format = 'json';
 public function registrasi()
 {
 $data = [
 'nama' => $this->request->getVar('nama'),
 'email' => $this->request->getVar('email'),
 'password' => password_hash($this->request->getVar('password'),
PASSWORD_DEFAULT)
 ];

 $model = new MRegistrasi();
 $model->save($data);
return $this->respond([ 'code' => 200, 'status' => true, 'data' => "Registrasi Berhasil" ]);

 }
 }