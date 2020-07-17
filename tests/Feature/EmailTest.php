<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailTest extends TestCase
{
    
    use databaseMigrations;

    public $user;

    public function setup()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }



    /**
     * A basic test example.
     *
     * @test
     */
    public function an_otp_email_is_sent_when_user_is_logged_in()
    {
        $this->wuthoutExceptionHandling();
        //$user = factory(User::class)->create();
        $res = $this->post('/login',['email' => $user->email, 'password' => 'secret']);
        Mail::assertSent(OTPMail::class);
        
    }

    public function after_login_user_can_access_homepage_if_verified()
    {
        $user = factory(User::class)->create(['isVerified' => 1]);
        $this->actingAs($user);
        $this->get('/home')->assertStatus(200);
        
    }
    
    public function an_otp_email_is_not_sent_if_cedentials_are_incorrect()
    {
        Notification::fake();

        $this->witExceptionHandling();

        //$user = factory(User::class)->create(); MADE PUBLIC.
        
        $res = $this->post('/login',['email' => $this->user->email, 'password' => 'secret', 'via'=> 'email']);
        Notification::assertSentTo([$this->user], OTPNotification::class);

    }

    public function otp_is_stored_in_cache_for_the_user()
    {
        //$user = factory(User::class)->create();
        $res = $this->post('/login', ['email' => $this->user->email, 'password' => 'secret']); 
        $this->assertNotNull($this->user->OTP());
    }

}
