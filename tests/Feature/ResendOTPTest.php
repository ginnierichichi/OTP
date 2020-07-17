<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResendOTPTest extends TestCase
{  
    use DatabaseMigrations;

    public function a_user_can_request_for_new_otp()
    {
        $user = $this->logInUser();
        $this->get('/verifyOTP');
        $response = $this->post('/resend_otp', ['via' => 'email']);
        $response->assertRedirect('/verifyOTP');

        //$response->assertStatus(302);
     }
    
    
    public function otp_notification_sent_when_user_request_new_otp()
    {
        Notification::fake();
        $user = $this->logInUser();
        $response = $this->post('/resend_otp', ['via' => 'email']);
        Notification::assertSentTo([$user], OTPNotification::class);
    }
}
