<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function index()
    {
        $AdminModel = new \App\Models\AdminModel();
        $users = $AdminModel->findAll();

        $data = [
            'title' => 'Daftar Admin',
            'users' => $users
        ];
        $AdminModel = new AdminModel();
        return view('admin/index', $data);
    }


    public function update($id)
    {
        helper('form');

        $adminmodel = new \App\Models\AdminModel();
        $admin = $adminmodel->find($id);
        if (empty($user)) {
            session()->setFlashdata('error', 'Data tidak ditemukan');
            return redirect()->to('/admin/index');
        }

        if ($this->request->getMethod() == 'post') {
            $user = [

                'id' => $this->request->getPost('id'),
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'active' => $this->request->getPost('active'),
            ];

            if ($adminmodel->update($id, $user)) {
                session()->setFlashdata('success', 'Data berhasil disimpan');
                return redirect()->to('/pegawai/index');
            }
        }
    }
}
