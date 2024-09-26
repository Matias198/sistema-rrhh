<?php

namespace Tests\Feature\Livewire;

use App\Livewire\GestionEmpleados;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class GestionEmpleadosTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(GestionEmpleados::class)
            ->assertStatus(200);
    }
}
