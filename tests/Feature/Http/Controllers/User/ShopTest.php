<?php

namespace Tests\Feature\Http\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function seeBasicTitle()
    {
        $this->get('/')
            ->assertSeeText('Categories')
            ->assertSeeText('Just For You');
    }
}
