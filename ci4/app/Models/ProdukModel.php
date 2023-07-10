<?php
namespace App\Models;
use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
        'hrg',
        'jml',
        'keterangan',
        'foto'
    ];
}
?>