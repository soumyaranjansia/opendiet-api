<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends ResourceController
{
    use ResponseTrait;

    
    /**
     * Add a user entry
     * 
     * Important notes: Check for public key from requestor to make sure it's an authorized request
     *                  The user information will match from registration at opendiet.io
     * 
     * User privileges:
     *              1: ADMIN - can do anything
     *              2: STANDARD USER - can only read API data
     *              3: STANDARD BUSINESS USER - can only read API data
     *              4: PREMIUM BUSINESS USER - can read API data and insert new food and brand entries 
     * 
     * @return array
     */
    public function create() {
        $user = new UserModel();
        $data = [
            'user_id' =>                        $this->request->getVar('user_id'),
            'user_username' =>                  $this->request->getVar('user_username'),
            'user_privileges' =>                $this->request->getVar('user_privileges'),
            'user_public_key' =>                $this->request->getVar('user_public_key'),
            'request_public_key' =>             $this->request->getVar('request_public_key')
        ];
        
        // Make sure the requestor sent their public key
        if(!$data['request_public_key']) {
            $response = [
                'status' =>     401,
                'error' =>      true,
                'messages' => [
                    'error' =>  'There was no requestor public key supplied'
                ]
                ];
            return $this->respond($response, 401);
        }

        // Make sure that the requestor public key exists
        $doesRequestorKeyExist = $user->where('user_public_key', $data['request_public_key'])->first();
        if(!$doesRequestorKeyExist) {
            $response = [
                'status' =>         401,
                'error' =>          true,
                'messages' =>       [
                    'error' =>      'You are not authorized to add users!'
                ]
                ];
            return $this->respond($response, 401);
        }

        // Make sure that the key matches exactly
        else if($doesRequestorKeyExist['user_public_key'] !== $data['request_public_key']) {
            $response = [
                'status' =>         401,
                'error' =>          true,
                'messages' =>       [
                    'error' =>      'You are not authorized to add users!'
                ]
                ];
            return $this->respond($response, 401);
        }
        
        $user->insert($data);

        $response = [
            'status' =>         201,
            'error' =>          null,
            'messages' =>       [
                'success' =>    'User entry successfully added.'
            ]
            ];

            return $this->respond($response, 201);
        
    }


    // TODO: Implement updating a user entry
    /**
     * Update a user entry
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

    // TODO: Implement delting a user entry
    /**
     * Delete a user entry
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

    public function checkPublicKey($public_key) {
        $user->where('user_public_key', $public_key)->first();
        if($user) {
            return true;
        } else {
            return false;
        }
    }
   
    
}