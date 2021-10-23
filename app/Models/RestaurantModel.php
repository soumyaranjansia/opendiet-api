<?php
namespace App\Models;
use CodeIgniter\Model;

class RestaurantModel extends Model
{
    protected $table = 'restaruant';
    protected $primaryKey = 'restaurant_id';

    protected $useAutoIncrement = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'restaurant_id', 'brand_id'
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

