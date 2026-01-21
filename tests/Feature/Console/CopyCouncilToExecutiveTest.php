<?php

declare(strict_types=1);

namespace Tests\Feature\Console;

use App\Models\CouncilMember;
use App\Models\ExecutiveCouncilMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CopyCouncilToExecutiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_copies_new_records_and_skips_existing_by_default(): void
    {
        $a = CouncilMember::query()->create([
            'name' => 'Alice',
            'slug' => 'alice',
            'position' => 'Commissioner',
            'image' => 'images/alice.jpg',
            'biography' => json_encode(['Para 1', 'Para 2']),
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $b = CouncilMember::query()->create([
            'name' => 'Bob',
            'slug' => 'bob',
            'position' => 'Secretary',
            'image' => 'images/bob.jpg',
            'biography' => 'Legacy biography',
            'sort_order' => 7,
            'is_active' => false,
        ]);

        // Pre-create executive for Bob to test skip default
        ExecutiveCouncilMember::query()->create([
            'name' => 'Old Bob',
            'slug' => 'bob',
            'position' => 'Old',
            'image' => 'old/bob.jpg',
            'biography' => 'Old',
            'display_order' => 1,
            'is_active' => true,
        ]);

        $this->artisan('council:copy-to-executive')
            ->assertExitCode(0)
            ->expectsOutputToContain('created executive member slug=alice')
            ->expectsOutputToContain('skipped existing executive member slug=bob');

        $alice = ExecutiveCouncilMember::query()->where('slug', 'alice')->first();
        $this->assertNotNull($alice);
        $this->assertSame('Alice', $alice->name);
        $this->assertSame('Commissioner', $alice->position);
        $this->assertSame('images/alice.jpg', $alice->image);
        $this->assertSame(3, $alice->display_order);
        $this->assertTrue((bool) $alice->is_active);

        $bob = ExecutiveCouncilMember::query()->where('slug', 'bob')->first();
        $this->assertNotNull($bob);
        $this->assertSame('Old Bob', $bob->name, 'Existing record should be unchanged when not forcing');
    }

    public function test_force_overwrites_existing(): void
    {
        CouncilMember::query()->create([
            'name' => 'Bob',
            'slug' => 'bob',
            'position' => 'Secretary',
            'image' => 'images/bob.jpg',
            'biography' => 'New Bio',
            'sort_order' => 9,
            'is_active' => false,
        ]);

        ExecutiveCouncilMember::query()->create([
            'name' => 'Old Bob',
            'slug' => 'bob',
            'position' => 'Old',
            'image' => 'old/bob.jpg',
            'biography' => 'Old',
            'display_order' => 1,
            'is_active' => true,
        ]);

        $this->artisan('council:copy-to-executive --force')
            ->assertExitCode(0)
            ->expectsOutputToContain('updated executive member slug=bob');

        $bob = ExecutiveCouncilMember::query()->where('slug', 'bob')->first();
        $this->assertNotNull($bob);
        $this->assertSame('Bob', $bob->name);
        $this->assertSame('Secretary', $bob->position);
        $this->assertSame('images/bob.jpg', $bob->image);
        $this->assertSame(9, $bob->display_order);
        $this->assertFalse((bool) $bob->is_active);
    }
}
