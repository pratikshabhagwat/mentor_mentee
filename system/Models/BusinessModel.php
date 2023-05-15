<?php 
namespace App\Models;
use CodeIgniter\Model;
class BusinessModel extends Model
{
    protected $table = 'business';
    protected $primaryKey = 'id';
    protected $allowedFields = ['applied_loan_amount','customer_occupation','monthly_salary','customer_full_name','customer_contact_number','customer_email_id','customer_address','zip_code','state','district','customer_marital_status','customer_dob','customer_gender','owenership_of_home','duration_of_stying','agent_referal_id','office_name','official_address','official_zip_code','official_state','official_district','official_email_id','experiance_in_current_company','total_work_experiance','addhar_card','pan_card','passport_size_photo','salary_slip1_month','salary_slip2_month','salary_slip3_month','bank_statement'];

   
}

