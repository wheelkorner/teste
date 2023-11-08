<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DocumentImportController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('import',compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'json_file' => 'required|file|mimes:json',
        ]);

        $json = json_decode(file_get_contents($request->file('json_file')->path()), true);

        if (isset($json['documentos'])) {
            foreach ($json['documentos'] as $documento) {
                // Encontre ou crie a categoria
                $category = Category::firstOrCreate(['name' => $documento['categoria']]);

                // Crie um novo documento
                $document = new Document([
                    'category_id' => $category->id,
                    'title' => $documento['titulo'],
                    'contents' => $documento['conteúdo'],
                ]);
                $document->save();
            }
        }

        return redirect()->route('import')->with('success', 'Arquivo importado com sucesso.');
    }
}
