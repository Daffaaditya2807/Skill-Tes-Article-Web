<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    //
    public function index()
    {
        $articles = Article::all();
        return view('dashboard.page.article.index', compact('articles'));
    }

    public function create()
    {

        return view('dashboard.page.article.add-article');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'slug' => 'required|string|unique:articles,slug',
            'image' => 'nullable|image|max:2048',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'id'        => Str::uuid(),
            'title'     => $request->title,
            'deskripsi' => $request->deskripsi,
            'slug'      => $request->slug,
            'image'     => $imagePath,
        ]);

        return redirect()
            ->route('dashboard.article.index')
            ->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);  // cari UUID
        return view('dashboard.page.article.edit-article', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'slug' => 'required|string|unique:articles,slug,' . $article->id,
            'image' => 'nullable|image|max:2048',
        ]);

        // Simpan slug, title, deskripsi
        $article->title = $request->title;
        $article->deskripsi = $request->deskripsi;
        $article->slug = $request->slug;

        // Jika user upload gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama (jika ada)
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            $newImagePath = $request->file('image')->store('articles', 'public');
            $article->image = $newImagePath;
        }

        // Simpan perubahan
        $article->save();

        return redirect()
            ->route('dashboard.article.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Hapus gambar jika ada
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        // Hapus record artikel
        $article->delete();

        return redirect()
            ->route('dashboard.article.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}
