<?php

namespace Tests\Feature\Http\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CatalogPageTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function seeBasicItem()
    {
        $this->get('/catalog')
            ->assertSeeText('Categories')
            ->assertSeeText('Price');
    }
}
