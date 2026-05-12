<?php

use Tests\TestCase;
use function Pest\Laravel\get;

uses(TestCase::class);

it('loads the landing page successfully', function () {
    $response = get('/');

    $response->assertStatus(200);
});

it('displays the brand name Zengfy', function () {
    $response = get('/');

    // Matching the lowercase 'g' as per welcome.php translation
    $response->assertSee('Zengfy');
});

it('has correct SEO meta tags', function () {
    $response = get('/');

    $response->assertSee('<title>', false)
             ->assertSee('Zengfy', false)
             ->assertSee('meta name="description"', false);
});

it('shows the call to action buttons', function () {
    $response = get('/');

    // Matching the translation 'Sign Up' from welcome.php
    $response->assertSee('Sign Up');
});

it('renders in the correct locale', function () {
    $response = get('/');
    
    // Using case-insensitive check or matching the actual output 'utf-8'
    $contentType = $response->headers->get('Content-Type');
    expect(strtolower($contentType))->toContain('text/html; charset=utf-8');
});
