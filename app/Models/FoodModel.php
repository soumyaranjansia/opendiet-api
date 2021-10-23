<?php
namespace App\Models;
use CodeIgniter\Model;

class FoodModel extends Model
{
    protected $table = 'food';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'food_name', 'brand_id', 'brand_is_restaurant', 
        'food_servings_per_container',
        'food_calories',
        'food_serving_size', 'food_serving_type_of_measure',
        'food__grams_per_serving', 'food_total_fat', 
        'food_saturdated_fat', 'food_trans_fat', 
        'food_cholesterol', 'food_sodium', 'food_total_carbohydrates',
        'food_dietary_fiber', 'food_total_sugar', 'food_added_sugar',
        'food_protein'
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

