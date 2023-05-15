<?php 
namespace App\Models;
use CodeIgniter\Model;
class KioskModel extends Model
{
    protected $table = 'kiosk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','state','state_obj','district','district_obj','block','block_obj','local_body','local_body_obj','address','zip_code'];
}