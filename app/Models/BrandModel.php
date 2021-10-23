<?php
namespace App\Models;
use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';

    protected $useAutoIncrement = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'brand_name', 'brand_is_restaurant', 'restaurant_id'
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

    protected $afterInsert = ['callAfterInsert'];

    function callAfterInsert(array $data) {
        // If the brand is a restaurant, we need to add to restuarant table
        if(isset($data['brand_is_restaurant']))
        {
            // Create new instance of restaurant model
            $restaurantModel = new \App\Models\RestaurantModel();

            // Get brand ID from data
            $request = [
                'brand_id' => $data['brand_id']
            ];

            // Insert the brand_id 
            $restaurantModel->insert($request);

        }
    }


}

