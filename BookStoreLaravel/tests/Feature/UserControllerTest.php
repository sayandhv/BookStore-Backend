<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{


    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_SuccessfulRegistration()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])->json('POST', '/api/register', [
            "role" => "user",
            "first_name" => "sayandh",
            "last_name" => "vvv",
            "email" => "sayandh@gmail.com",
            "phone_no" => "9745124578",
            "password" => "123456789",
            "confirm_password" => "123456789"
        ]);
        $response->assertStatus(201);
    }

    public function test_UnSuccessfulRegistration()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])->json('POST', '/api/register', [
            "role" => "user",
            "first_name" => "sayandh",
            "last_name" => "vvv",
            "email" => "sayandh@gmail.com",
            "phone_no" => "9745124578",
            "password" => "123456789",
            "confirm_password" => "123456789"
        ]);
        $response->assertStatus(401);
    }

     /**
     * @test for
     * Successfull Login
     */
    public function test_SuccessfulLogin()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])->json(
            'POST',
            '/api/login',
            [
                "email" => "AthulTharol1994@gmail.com",
                "password" => "sayandh@1234"
            ]
        );
        $response->assertStatus(200);
    }

    public function test_UnSuccessfulLogin()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])->json(
            'POST',
            '/api/login',
            [
                "email" => "abcd@gmail.com",
                "password" => "sayandh@1234"
            ]
        );
        $response->assertStatus(404);
    }

    public function test_SuccessfulLogout()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY2MTY5OTc4OSwiZXhwIjoxNjYxNzAzMzg5LCJuYmYiOjE2NjE2OTk3ODksImp0aSI6ImNFUlNwR2NreHhjRENINlUiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.ChYW8Gi4C0tIyddKXRZlunb21uyGyQq-e0w72J5HARs'
        ])->json('POST', '/api/logout');
        $response->assertStatus(201);
    }

    public function test_SuccessfulForgotPassword()
    { {
            $response = $this->withHeaders([
                'Content-Type' => 'Application/json',
            ])->json('POST', '/api/forgotPassword', [
                "email" => "athultharol1994@gamil.com"
            ]);

            $response->assertStatus(201);
        }
    }

    public function test_SuccessfulResetPassword()
    { 
            $response = $this->withHeaders([
                'Content-Type' => 'Application/json',
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY2MTY5OTc4OSwiZXhwIjoxNjYxNzAzMzg5LCJuYmYiOjE2NjE2OTk3ODksImp0aSI6ImNFUlNwR2NreHhjRENINlUiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.ChYW8Gi4C0tIyddKXRZlunb21uyGyQq-e0w72J5HARs'
            ])->json('POST', '/api/resetpassword', [
                "new_password" => "445566",
                "confirm_password" => "445566"
            ]);

            $response->assertStatus(201);
        
    }

    /**
     * @test for
     * UnSuccessfull resetpassword
     */
    public function test_UnSuccessfulResetPassword()
    { {
            $response = $this->withHeaders([
                'Content-Type' => 'Application/json',
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUwMDMxMTIzLCJleHAiOjE2NTAwMzQ3MjMsIm5iZiI6MTY1MDAzMTEyMywianRpIjoieFVGclc1RDVqcFcyUUZSNCIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.sCq-hdGdst48xUyIe14aXKe03hLQxyMX6d_KUU8MWeI'
            ])->json('POST', '/api/resetpassword', [
                "new_password" => "manju23",
                "confirm_password" => "manju23"
            ]);

            $response->assertStatus(400)->assertJson(['message' => 'we cannot find the user with that e-mail address']);
        }
    }
}