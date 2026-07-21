<?php

use App\Models\ClientListing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('the home page shows approved listings only', function () {
    $approvedUser = User::create([
        'name' => 'Approved User',
        'email' => 'approved@example.com',
        'phone' => '0771234567',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'is_verified' => true,
    ]);

    $pendingUser = User::create([
        'name' => 'Pending User',
        'email' => 'pending@example.com',
        'phone' => '0777654321',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'is_verified' => true,
    ]);

    $approvedListing = ClientListing::create([
        'client_id' => $approvedUser->id,
        'display_name' => 'Approved Studio Room',
        'location' => 'Colombo',
        'number_of_persons' => 1,
        'total_rent' => 25000,
        'rent_for_you' => 22000,
        'floor' => 'first',
        'has_elevator' => true,
        'has_parking' => false,
        'occupation' => 'employed',
        'gender' => 'female',
        'facilities' => 'Wi-Fi,Parking',
        'personal_habbits' => 'Quiet,Night Owl',
        'contact_number' => '0771234567',
        'contact_email' => 'approved@example.com',
        'images' => 'uploads/posts/sample.jpg',
        'notes' => 'A fully approved listing for the homepage.',
        'status' => 'approved',
    ]);

    ClientListing::create([
        'client_id' => $pendingUser->id,
        'display_name' => 'Pending Studio Room',
        'location' => 'Galle',
        'number_of_persons' => 1,
        'total_rent' => 20000,
        'rent_for_you' => 18000,
        'floor' => 'ground',
        'has_elevator' => false,
        'has_parking' => false,
        'occupation' => 'student',
        'gender' => 'male',
        'facilities' => 'Wi-Fi',
        'personal_habbits' => 'Quiet',
        'contact_number' => '0777654321',
        'contact_email' => 'pending@example.com',
        'images' => 'uploads/posts/pending.jpg',
        'notes' => 'A pending listing that should not be visible on the homepage.',
        'status' => 'pending',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee($approvedListing->display_name)
        ->assertDontSee('Pending Studio Room');
});

test('price range filter returns only listings within the selected lkr range', function () {
    $user = User::create([
        'name' => 'Filter User',
        'email' => 'filter@example.com',
        'phone' => '0770000000',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'is_verified' => true,
    ]);

    $matchingListing = ClientListing::create([
        'client_id' => $user->id,
        'display_name' => 'Budget Room',
        'location' => 'Colombo',
        'number_of_persons' => 2,
        'total_rent' => 40000,
        'rent_for_you' => 40000,
        'floor' => 'first',
        'has_elevator' => false,
        'has_parking' => false,
        'occupation' => 'student',
        'gender' => 'male',
        'facilities' => 'Wi-Fi',
        'personal_habbits' => 'Quiet',
        'contact_number' => '0770000000',
        'contact_email' => 'filter@example.com',
        'images' => 'uploads/posts/sample.jpg',
        'notes' => 'A budget room.',
        'status' => 'approved',
    ]);

    ClientListing::create([
        'client_id' => $user->id,
        'display_name' => 'Premium Room',
        'location' => 'Colombo',
        'number_of_persons' => 2,
        'total_rent' => 120000,
        'rent_for_you' => 120000,
        'floor' => 'first',
        'has_elevator' => true,
        'has_parking' => true,
        'occupation' => 'employed',
        'gender' => 'female',
        'facilities' => 'Wi-Fi,Parking',
        'personal_habbits' => 'Quiet',
        'contact_number' => '0770000000',
        'contact_email' => 'filter@example.com',
        'images' => 'uploads/posts/sample2.jpg',
        'notes' => 'A premium room.',
        'status' => 'approved',
    ]);

    $response = $this->actingAs($user)->post('/app/listing/filter', [
        'display_name' => '',
        'location' => '',
        'category_type_id' => '',
        'price_range' => '0-50000',
    ]);

    $response->assertStatus(200)
        ->assertSee($matchingListing->display_name)
        ->assertDontSee('Premium Room');
});
