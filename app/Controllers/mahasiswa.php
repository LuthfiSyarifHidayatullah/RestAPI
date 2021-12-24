<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelMahasiswa;

class mahasiswa extends BaseController
{
	use ResponseTrait;
	function __construct()
	{
		$this->model = new ModelMahasiswa();
	}

	public function index()
	{
		$data = $this->model->orderBy('nama', 'asc')->findAll();
		return $this->respond($data, 200);
	}

	// public function show($nrp = null)
	// {
	// 	$data = $this->model->where('nrp', $nrp)->findAll();
	// 	if ($data) {
	// 		return $this->respond($data, 200);
	// 	} else {
	// 		return $this->failNotFound("data tidak ditemukan untuk $null ");
	// 	}
	// }

	public function show($email = null)
	{
		$data = $this->model->where('email', $email)->findAll();
		if ($data) {
			return $this->respond($data, 200);
		} else {
			return $this->failNotFound("data tidak ditemukan untuk $email ");
		}
	}

	public function create()
	{
		// $data = [
		// 	'nama' => $this->request->getVar('nama'),
		// 	'email' => $this->request->getVar('email'),
		// ];
		$data = $this->request->getPost();

		// $this->model->save($data);
		if (!$this->model->save($data)) {
			return $this->fail($this->model->errors());
		}

		$response = [
			'status' => 201,
			'error' => null,
			'massages' => [
				'success' => 'berhasil menambahkan data mahasiswa'
			]
		];
		return $this->respond($response);
	}

	public function update($nrp = null)
	{
		$data = $this->request->getRawInput();
		$data['nrp'] =  $nrp;
		$isExists = $this->model->where('nrp', $nrp)->findAll();
		if (!$isExists) {
			return $this->failNotFound("data tidak ditemukan untuk $nrp");
		}
		if (!$this->model->save($data)) {
			return $this->fail($this->model->errors());
		}

		$response = [
			'status' => 200,
			'error' => null,
			'messages' => [
				'success' => "data mahasiswa berhasil di update $nrp "
			]
		];
		return $this->respond($response);
	}
}
