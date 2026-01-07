<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;


uses(RefreshDatabase::class);

it('can verified email user succesfully', function () {
    Event::fake();

    $user = User::factory()->unverified()->create();

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        [
            'id' => $user->id,
            'hash' =>  sha1($user->email)
        ]
    );

    $this->actingAs($user, 'sanctum')->getJson($url)->assertStatus(200);

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue;

    Event::assertDispatched(Verified::class);
});
