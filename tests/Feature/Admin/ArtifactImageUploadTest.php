<?php

namespace Tests\Feature\Admin;

use App\Models\Artifact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArtifactImageUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_artifact_can_be_created_with_multiple_images(): void
    {
        // Create fake images
        $image1 = File::image('test1.jpg', 800, 600);
        $image2 = File::image('test2.png', 1024, 768);

        $response = $this->post(route('admin.artifacts.store'), [
            'title' => 'Test Artifact',
            'description' => 'This is a test artifact description.',
            'category' => 'Test Category',
            'is_active' => '1',
            'sort_order' => 1,
            'images' => [$image1, $image2],
            'image_alt_texts' => ['First test image', 'Second test image'],
        ]);

        $response->assertRedirect(route('admin.artifacts.index'));
        $response->assertSessionHas('success', 'Artifact created successfully.');

        // Verify artifact was created
        $artifact = Artifact::where('title', 'Test Artifact')->first();
        $this->assertNotNull($artifact);
        $this->assertEquals('Test Artifact', $artifact->title);
        $this->assertEquals('test-artifact', $artifact->slug);

        // Verify images were uploaded and stored
        $this->assertCount(2, $artifact->images);

        $firstImage = $artifact->images->first();
        $this->assertEquals('First test image', $firstImage->alt_text);
        $this->assertEquals(1, $firstImage->sort_order);

        $secondImage = $artifact->images->skip(1)->first();
        $this->assertEquals('Second test image', $secondImage->alt_text);
        $this->assertEquals(2, $secondImage->sort_order);

        // Verify files exist in storage
        foreach ($artifact->images as $image) {
            $path = str_replace('/storage/', '', $image->url);
            Storage::disk('public')->assertExists($path);
        }
    }

    public function test_artifact_can_be_created_without_images(): void
    {
        $response = $this->post(route('admin.artifacts.store'), [
            'title' => 'Test Artifact No Images',
            'description' => 'This artifact has no images.',
            'category' => 'Test Category',
            'is_active' => '1',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.artifacts.index'));

        $artifact = Artifact::where('title', 'Test Artifact No Images')->first();
        $this->assertNotNull($artifact);
        $this->assertCount(0, $artifact->images);
    }
}
