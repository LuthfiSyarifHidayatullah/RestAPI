<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMahasiswa extends Model
{
    protected $table = "mahasiswa";
    protected $primarykey = "nrp";
    protected $allowedFields = ['nama', 'email'];

    protected $validationRules = [
        'nama' => 'required',
        'email' => 'required|valid_email'
    ];
    protected $validationMessages = [
        'nama' => [
            'required' => 'silahkan masukan nama'
        ],
        'email' => [
            'required' => 'silahkan masukan email',
            'valid_email' => 'email yang dimasukan tidak valid'
        ],

    ];
}
