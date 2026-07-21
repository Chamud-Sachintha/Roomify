<?php

use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('shows the client forgot password page', function () {
    $this->get('/forgot-password')->assertOk();
});

it('sends a reset otp to a registered client email', function () {
    Mail::fake();

    $user = User::factory()->create([
        'email' => 'client@example.com',
        'password' => bcrypt('password123'),
        'is_verified' => true,
    ]);

    $this->post('/forgot-password', [
        'email' => $user->email,
    ])->assertOk();

    Mail::assertSent(PasswordResetMail::class);
});
