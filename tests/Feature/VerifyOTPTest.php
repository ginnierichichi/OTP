<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    
    use DatabaseMigrations;


    public function setup()
    {
        parent::setup();
        $this->logInUser();

    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function user_can_submit_otp_and_get_verified()
    {
        //$this->logInUser();
        $OTP = auth()->user()->cacheTheOTP();

                        /*$OTP = rand(1000000, 999999);
                        Cache::put(['OTP'=>$OTP], now()->addSeconds(20));
                        $user = factory(User::class)->create();
                        */
        $this->actingAs($user);
        $this->post('/verifyOTP', ['OTP' => $OTP])->assertStatus(302);
        $this->assertDatabaseHas('users', ['isVerified'=>1]);
   
    }

    public function user_can_see_otp_verify_page()
    {
        //$this->logInUser();
        $this->get('/verifyOTP')
        ->assertStatus(200)
        ->assertSee('Enter OTP');
    }

    public function invalid_otp_returns_error_message()
    {
        //$this->logInUser();
        
        $this->post('/verifyOTP', ['OTP' => 'InvalidOTP']) ->assertSessionHasErrors();
    }

    public function if_no_otp_is_given_then_return_with_error()
    {
        $this->withExceptionHandling();
        //$this->logInUser();
        $this->post('/verifyOTP', ['OTP' => null]) ->assertSessionHasErrors(['OTP']);
    }
}
