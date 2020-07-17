<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;

class UserTest extends TestCase

{
    use DatabaseMigrations;

    public function it_has_cache_key_for_otp()
    {
        $user= factory(User::class)->create();
        $this->assertEquals($user->OTPKey(),'OTP_for_1');
        //dd($user->OTP());
    }

    public function it_can_send_OTP_notification_to_the_user()
    {
        $user= factory(User::class)->create();
        Notofication::fake();
        $user->sendOTP('sms');
        Notiication::assertSentTo([$user],OTPNotification::class);
        
    }
    
}