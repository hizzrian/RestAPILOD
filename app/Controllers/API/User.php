<?php

namespace App\Controllers\API;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;
use ReflectionException;

class User extends BaseController
{
    // use ResponseTrait;
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */
    public function register()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[6]|max_length[255]'
        ];

        $input = $this->getRequestInput($this->request);
        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                        $this->validator->getErrors(),
                        ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $userModel = new UserModel();
        $userModel->save($input);

        return $this->getJWTForUser(
                $input['email'],
                ResponseInterface::HTTP_CREATED
            );
    }

    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login()
    {
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[6]|max_length[255]|validateUser[email, password]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $input = $this->getRequestInput($this->request);


        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }
        return $this->getJWTForUser($input['email']);
    }

    // get userAbliity
    public function getUserAbility()
    {
        $input = $this->getRequestInput($this->request);
        $userModel = new UserModel();
        $user = $userModel->findUserByEmailAddress($input['email']);
        $ability = $userModel->getUserAbility($user['id']);
        return $this->getResponse(
            [
                'userAbilities' => $ability
            ]
        );
    }

    private function getJWTForUser(string $emailAddress, int $responseCode = ResponseInterface::HTTP_OK) 
    {
        try {
            $model = new UserModel();
            $user = $model->findUserByEmailAddress($emailAddress);
            unset($user['password']);
            // if user role is admin set userAbilities to action: manage and subject: all
            if ($user['role'] == 'admin') {
                $ability = [
                    [
                        'action' => 'manage',
                        'subject' => 'all'
                    ]
                ];
            } else {
                $ability = [
                    [
                        'action' => 'read',
                        'subject' => 'all'
                    ]
                ];
            }
            helper('jwt');

            return $this->getResponse(
                    [
                        'message' => 'User authenticated successfully',
                        'userData' => $user,
                        'accessToken' => getSignedJWTForUser($emailAddress),
                        'userAbilities' => $ability
                    ]
                );
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
}
