<?php 
namespace App\Models;
use CodeIgniter\Model;
class CallsModel extends Model
{
    protected $table = 'calls';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kiosk_id','dr_id','patient_id','call_link','cretated_at','updated_at','call_start','call_end'];
}