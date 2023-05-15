<?php 
namespace App\Models;
use CodeIgniter\Model;
class PatientsModel extends Model
{
    protected $table = 'patient';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','dob','user_id','contact_number','email',"class","address","school"];
}