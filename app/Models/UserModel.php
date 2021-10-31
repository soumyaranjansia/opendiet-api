<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    protected $useAutoIncrement = false;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'user_id', 'user_username',
        'user_privileges', 'user_public_key'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // TODO: implement validation rules
    // protected $validationRules = [];
    // protected $validationMessaegs = [];
    // protected $skipValidation = false;

    protected $returnType = 'array';


}

