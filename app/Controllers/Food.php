<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FoodModel;

class Food extends ResourceController
{
    use ResponseTrait;

    /**
     * Get all food entries
     *
     * This function returns all food entries.
     *
     * @return array 
     */
    public function index() {
        $food = new FoodModel();
        $data = $food->orderBy('food_id', 'DESC')->findAll();
        if($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No food entries exist');
        }
    }

    /**
     * Get a food entry by ID
     * 
     * @param int   $id 
     * 
     * @return array
     */
    public function show($id = null) {
        $food = new FoodModel();
        $data = $food->where('food_id', $id)->first();
        if($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Food entry does not exist');
        }
    }

    /**
     * Add a food entry
     * 
     * 
     * 
     * @return array
     */
    public function create() {
        $food = new FoodModel();
        $data = [
            'food_name' =>                      $this->request->getVar('food_name'),
            'brand_id' =>                       $this->request->getVar('brand_id'),
            'brand_is_restaurant' =>            $this->request->getVar('brand_is_restaurant'),
            'food_calories' =>                  $this->request->getVar('food_calories'),
            'food_servings_per_container' =>    $this->request->getVar('food_servings_per_container'),
            'food_serving_size' =>              $this->request->getVar('food_serving_size'),
            'food_servings_per_container' =>    $this->request->getVar('food_servings_per_container'),
            'food_grams_per_serving' =>         $this->request->getVar('food_grams_per_serving'),
            'food_total_fat' =>                 $this->request->getVar('food_total_fat'),
            'food_saturated_fat' =>             $this->request->getVar('food_saturated_fat'),
            'food_trans_fat' =>                 $this->request->getVar('food_trans_fat'),
            'food_cholesterol' =>               $this->request->getVar('food_cholesterol'),
            'food_sodium' =>                    $this->request->getVar('food_sodium'),
            'food_total_carbohydrates' =>       $this->request->getVar('food_total_carbohydrates'),
            'food_dietary_fiber' =>             $this->request->getVar('food_dietary_fiber'),
            'food_total_sugar' =>               $this->request->getVar('food_total_sugar'),
            'food_added_sugar' =>               $this->request->getVar('food_added_sugar'),
            'food_protein' =>                   $this->request->getVar('food_protein')
        ];

        $food->insert($data);

        $response = [
            'status' =>         201,
            'error' =>          null,
            'messages' =>       [
                'success' =>    'Food entry successfully added.'
            ]
            ];

            return $this->respond($response, 201);
        
    }

    /**
     * Update a food entry
     * 
     * 
     * 
     * @return array
     */
    public function update($id = null) {
        $response = [
            'status' =>     501,
            'error' =>      true,
            'messages' =>   [
                'error' =>  'Update is not yet implemented'
            ]
            ];

            return $this->respond($response, 501);
    }

    /**
     * Delete a food entry
     * 
     * 
     * 
     * @return array
     */
    public function delete($id = null) {
        $response = [
            'status' =>     501,
            'error' =>      true,
            'messages' =>   [
                'error' =>  'Delete is not yet implemented'
            ]
            ];

            return $this->respond($response, 501);
    }

    /**
     * Get a food entries by name
     * 
     * @param int   $name
     * 
     * @return array
     */
    public function getFoodEntriesByName() {
        $food = new FoodModel();
        $data = [
            'food_name' =>                      $this->request->getVar('food_name')
        ];

        // Use query builder for this
        $builder = $food->builder();
        $builder->like('food_name', $data['food_name'])->orderBy('food_name', 'ASC');
        $request = $builder->get()->getResult();

        if($request) {
            return $this->respond($request);
        } else {
            return $this->failNotFound('No food entries exist with the supplied name.');
        }
    }
    
}