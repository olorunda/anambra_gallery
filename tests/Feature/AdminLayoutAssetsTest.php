<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminLayoutAssetsTest extends TestCase
{
    #[Test]
    public function admin_layout_includes_bootstrap_icons_cdn_link(): void
    {
        $user = new User(['name' => 'Test User', 'email' => 'test@example.com']);
        $this->be($user);

        $html = View::make('layouts.admin', ['errors' => new ViewErrorBag(new MessageBag())])->render();

        $this->assertStringContainsString(
            'https://cdn.jsdelivr.net/npm/bootstrap-icons@',
            $html,
        );
        $this->assertStringContainsString(
            'bootstrap-icons.min.css',
            $html,
        );
    }
}
