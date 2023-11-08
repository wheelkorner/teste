<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Document;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    public function test_document_contents_max_length_should_be_valid()
    {
        $document = Document::factory()->create([
            'contents' => str_repeat('a', 255),
        ]);

        $this->assertTrue($document->isValid());

        $document->contents = str_repeat('a', 256);
        $this->assertFalse($document->isValid());
    }

    public function test_document_category_rules_should_be_valid()
    {
        $remessaParcialCategory = Category::where('name', 'Remessa Parcial')->first();
        $remessaCategory = Category::where('name', 'Remessa')->first();

        $document = Document::factory()->create([
            'category_id' => $remessaParcialCategory->id,
            'title' => 'Registro Janeiro',
        ]);

        $this->assertTrue($document->isValid());

        $document->category_id = $remessaCategory->id;
        $document->title = 'Registro semestre';
        $this->assertTrue($document->isValid());

        $document->title = 'Registro inválido';
        $this->assertFalse($document->isValid());

        $document->category_id = $remessaParcialCategory->id;
        $document->title = 'Registro inválido';
        $this->assertFalse($document->isValid());
    }
}