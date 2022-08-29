<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressControllerTest extends TestCase
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

    /**
     * @test for
     * Address add to respective user successfull
     *
     */

    public function test_SuccessfulAddAddress()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjYxMjIyMzA3LCJleHAiOjE2NjEyMjU5MDcsIm5iZiI6MTY2MTIyMjMwNywianRpIjoiMFdxcFBnSVJzWkxpOTFUbyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.EQpamOeaC0RHllTiIei7GBXRvlrisuR_rCVMHQRT-gY'
        ])->json('POST', '/api/addAddress', [
            "address" => "Madhura",
            "city" => "Hyderabad",
            "state" => "Telangana",
            "landmark" => "near market big bazaar",
            "pincode" => "500038",
            "address_type" => "home",
        ]);
        $response->assertStatus(201);
    }

    public function test_UnSuccessfulAddAddress()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUwMDMzMDkwLCJleHAiOjE2NTAwMzY2OTAsIm5iZiI6MTY1MDAzMzA5MCwianRpIjoiT2RSRkEybU9DbGVzTkpGQiIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZsjewWqQQEhhngddMDA4NzJkYjdhNTk3NmY3In0.VVZe9Jvto9Y15k60AQwcIdsxesrakO_BbfvFRPRjHok'
        ])->json('POST', '/api/addAddress', [
            "address" => "Clt",
            "city" => "Kerala",
            "state" => "Kerala",
            "landmark" => "near meen pedia",
            "pincode" => "500895",
            "address_type" => "home",
        ]);
        $response->assertStatus(200);
    }

    /**
     * @test for
     * Address Update to respective user successfull
     *
     */
    public function test_SuccessfulUpdateAddress()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization' => 'BsjewWqQQEhhngdd'
        ])->json('POST', '/api/updateAddress', [
            "id" => "4",
            "address" => "Iringal",
            "city" => "Clt",
            "state" => "Kerala",
            "landmark" => "Chappa",
            "pincode" => "412563",
            "address_type" => "home",
        ]);
        $response->assertStatus(200);
    }

    /**
     * @test for
     * Address Update to respective user Unsuccessfull
     *
     */
    public function test_UnSuccessfulUpdateAddress()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization' => 'BsjewWqQQEhhngdd'
        ])->json('POST', '/api/updateAddress', [
            "id" => "25",
            "address" => "IRINGAL",
            "city" => "Clt",
            "state" => "Kerala",
            "landmark" => "Chappa",
            "pincode" => "500038",
            "address_type" => "home",
        ]);
        $response->assertStatus(201);
    }

    /**
     * @test
     * for delete address successfull
     */
    public function test_SuccessfullDeleteAddress()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjYxMjIyMzA3LCJleHAiOjE2NjEyMjU5MDcsIm5iZiI6MTY2MTIyMjMwNywianRpIjoiMFdxcFBnSVJzWkxpOTFUbyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.EQpamOeaC0RHllTiIei7GBXRvlrisuR_rCVMHQRT-gY'
        ])->json(
            'POST',
            '/api/deleteAddress',
            [
                "id" => 3,
            ]
        );
        $response->assertStatus(200);
    }

    /**
     * @test for successfull display all Address
     * for respective user
     */
    public function test_SuccessfullDisplayAddress()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjYxMjIyMzA3LCJleHAiOjE2NjEyMjU5MDcsIm5iZiI6MTY2MTIyMjMwNywianRpIjoiMFdxcFBnSVJzWkxpOTFUbyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.EQpamOeaC0RHllTiIei7GBXRvlrisuR_rCVMHQRT-gY'
        ])->json(
            'GET',
            '/api/getAddress',
            []
        );
        $response->assertStatus(201);
    }

    /**
     * @test for Unsuccessfull display all Address
     * for respective user
     */
    public function test_UnSuccessfullDisplayAddress()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization' => 'BsjewWqQQEhhngdd'
        ])->json(
            'GET',
            '/api/getAddress',
            []
        );
        $response->assertStatus(404);
    }
}