<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Document;
use App\Models\Category;

class DocumentImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $documento;

    public function __construct($documento)
    {
        $this->documento = $documento;
    }

    public function handle()
    {
        // Encontre ou crie a categoria
        $category = Category::firstOrCreate(['name' => $this->documento['categoria']]);

        // Crie um novo documento
        $document = new Document([
            'category_id' => $category->id,
            'title' => $this->documento['titulo'],
            'contents' => $this->documento['conteúdo'],
        ]);
        $document->save();
    }
}
