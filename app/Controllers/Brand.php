<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BrandModel;

class Brand extends ResourceController
{
    use ResponseTrait;

    /**
     * Get all brand entries
     *
     * This function returns all brand entries.
     *
     * @return array 
     */
    public function index() {
        $brand = new BrandModel();
        $data = $brand->orderBy('brand_id', 'DESC')->findAll();
        if($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No brand entries exist');
        }
    }

    /**
     * Get a brand entry by ID
     * 
     * @param int   $id 
     * 
     * @return array
     */
    public function show($id = null) {
        $brand = new BrandModel();
        $data = $brand->where('brand_id', $id)->first();
        if($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Brand entry does not exist');
        }
    }

    /**
     * Add a brand entry
     * 
     * 
     * 
     * @return array
     */
    public function create() {
        $brand = new BrandModel();
        $data = [
            'brand_name' =>                     $this->request->getVar('brand_name'),
            'brand_is_restaurant' =>            $this->request->getVar('brand_is_restaurant'),
        ];

        $brand->insert($data);

        $response = [
            'status' =>         201,
            'error' =>          null,
            'messages' =>       [
                'success' =>    'Brand entry successfully added.'
            ]
            ];

            return $this->respond($response, 201);
        
    }

    /**
     * Update a brand entry
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
     * Delete a brand entry
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
     * Get brand entries by name
     * 
     * 
     * 
     * @return array
     */
    public function getBrandEntriesByName() {
        $brand = new BrandModel();
        $data = [
            'brand_name' =>                      $this->request->getVar('brand_name')
        ];

        $result = $brand->like('brand_name', $data['brand_name'])->orderBy('brand_name', 'ASC')->findAll();

        if($result) {
            return $this->respond($result);
        } else {
            return $this->failNotFound('No brand entries exist with the supplied name.');
        }
    }

    /**
     * Get all restaurant entries
     * 
     * 
     * 
     * @return array
     */
    public function getRestaurantEntries() {
        $brand = new BrandModel();

        $result = $brand->where('brand_is_restaurant', '1')->findAll();

        if($result) {
            return $this->respond($result);
        } else {
            return $this->failNotFound('No restaurant entries exist with the supplied name.');
        }
    }


    /**
     * Get restaurant entries by name
     * 
     * 
     * 
     * @return array
     */
    public function getRestaurantEntriesByName() {
        $brand = new BrandModel();
        $data = [
            'brand_name' =>                      $this->request->getVar('brand_name')
        ];

        $result = $brand->where('brand_is_restaurant', '1')->like('brand_name', $data['brand_name'])->orderBy('brand_name', 'ASC')->findAll();

        if($result) {
            return $this->respond($result);
        } else {
            return $this->failNotFound('No restaurant entries exist with the supplied name.');
        }
    }

}