<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function after_login_user_can_not_access_homepage_till_verified()
    {
        $this->logInUser();
        $this->get('/home')->assertRedirect('/verifyOTp');
    }



    public function after_login_user_can__access_homepage_if_verified()
    {
        $this->logInUser(['isVerified' => 1]); 

        /*$user = factory(User::class)->create(['isVerified' => 1]);
        $this->actingAs($user);*/ 

        $this->get('/home')->assertStatus(200);
        
    }
}
