<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $barang = [
        'nama' => [
            'rules' => 'required|min_length[5]',
        ],
        'harga' => [
            'rules' => 'required|integer',
        ],
        'jumlah' => [
            'rules' => 'required|integer',
        ],
    ];
    public $user = [
        'username' => [
            'rules' => 'required|min_length[5]',
        ],
        'phone' => [
            'rules' => 'required|min_length[5]',
        ],
        'email' => [
            'rules' => 'required',
        ],
        'address' => [
            'rules' => 'required',
        ],
    ];

    public $user_errors = [
        'username' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimal 5 Karakter',
        ],
        'phone' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimal 5 Karakter',
        ],
        'email' => [
            'required' => '{field} Harus Diisi',
            'integer' => '{field} Harus Angka'
        ],
        'address' => [
            'required' => '{field} Harus Diisi',
            'integer' => '{field} Harus Angka'
        ],
    ];
}