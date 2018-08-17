<?php

namespace App\Http\Controllers;

use Tests\TestCase;
use App\Mail\ContactRequestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactFormControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        Mail::fake();
    }

    public function testStore()
    {
        $this->post('/contact', [
            'full_name' => 'Keanu Reeves',
            'email' => 'kr@email.com',
            'message' => 'Sad Keanu likes shiny motorcycles.',
            'phone' => '9998887777',
        ])
            ->assertResponseOk()
            ->seeJson([
                'message' => 'We have recieved your contact request and will be in touch with you soon!',
                'success' => true,
            ])
            ->seeInDatabase('contact_requests', [
                'full_name' => 'Keanu Reeves',
                'email' => 'kr@email.com',
                'message' => 'Sad Keanu likes shiny motorcycles.',
                'phone' => '9998887777',
            ]);

            Mail::assertQueued(ContactRequestEmail::class, function ($mail) {
                return $mail->hasTo('guy-smiley@example.com');
            });
    }

    public function testStoreWithoutPhone()
    {
        $this->post('contact', [
            'full_name' => 'Carrie-Anne Moss',
            'email' => 'cm@email.com',
            'message' => 'Something about Vancouver.',
        ])
            ->assertResponseOk()
            ->seeJson([
                'message' => 'We have recieved your contact request and will be in touch with you soon!',
                'success' => true,
            ])
            ->seeInDatabase('contact_requests', [
                'full_name' => 'Carrie-Anne Moss',
                'email' => 'cm@email.com',
                'message' => 'Something about Vancouver.',
                'phone' => null,
            ]);

            Mail::assertQueued(ContactRequestEmail::class, function ($mail) {
                return $mail->hasTo('guy-smiley@example.com');
            });
    }

    public function testStoreWithoutFullName()
    {
        $this->post('contact', [
            'email' => 'cm@email.com',
            'message' => 'Something about Vancouver.',
            'phone' => '1112223333',
        ])
            ->assertResponseStatus(302);

        Mail::assertNothingSent();
    }

    public function testStoreWithoutEmail()
    {
        $this->post('contact', [
            'full_name' => 'Laurnce Fishburn',
            'message' => 'Shows you a pill in each hand, one red and one blue.',
            'phone' => '1112223333',
        ])
            ->assertResponseStatus(302);

        Mail::assertNothingSent();
    }

    public function testStoreWithoutMessage()
    {
        $this->post('contact', [
            'full_name' => 'Hugo Weaving',
            'email' => 'hw@email.com',
            'phone' => '1112223333',
        ])
            ->assertResponseStatus(302);

        Mail::assertNothingSent();
    }

    public function testEmptyData()
    {
        $this->post('contact', [])
            ->assertResponseStatus(302);

        Mail::assertNothingSent();
    }
}
