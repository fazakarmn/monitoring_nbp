<?php

namespace App\Http\Controllers;

use App\Models\DocumentComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'work_order' => 'required|string',
            'section'    => 'required|string',
            'comment'    => 'required|string|max:1000',
        ]);

        DocumentComment::create([
            'work_order' => $request->work_order,
            'section'    => $request->section,
            'user_id'    => Auth::id(),
            'comment'    => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
    
    public function destroy($id)
{
    $comment = DocumentComment::findOrFail($id);

    // Validasi agar user hanya bisa menghapus komentarnya sendiri
    if ($comment->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Akses ditolak.');
    }

    $comment->delete();

    return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
}
}