<?php

namespace App\Http\Controllers\pengurus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;
use App\Models\ForumChat;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengurus');
    }

    public function index()
    {
        $forums = Forum::where('id_pengurus', Auth::user('pengurus')->id)->get();
        return view('pengurus.forum', compact('forums'));
    }
    public function store(Request $request)
    {
        $forum = new Forum();
        $forum->fill($request->all());
        $forum['id_pengurus'] = Auth::user('pengurus')->id;
        $forum->save();
        return  back()->with('success', 'Berhasil Menambahkan Forum');
    }
    public function forumid($id)
    {
        $forum = Forum::find($id);
        $chats = ForumChat::where('id_forum', $id)->whereNull('id_chat')->get();
        return view('pengurus.forum-id', compact('forum', 'id', 'chats'));
    }
    public function chatstore(Request $request)
    {
        $chat = new ForumChat();
        $chat['id_forum'] = $request->id_forum;
        $chat['id_pengurus'] = Auth::user('pengurus')->id;
        $chat['id_chat'] = $request->id_chat;
        $chat['chat'] = $request->chat;
        $chat->save();

        return back()->with('success', 'Berhasil menambahkan chat');

    }
    public function edit($id)
    {
        $forum = Forum::find($id);
        return view('pengurus.forum-update', compact('forum', 'id'));
    }
    public function update(Request $request)
    {
        $forum = Forum::find($request->id);
        $forum->fill($request->all());
        $forum->update();
        return redirect('pengurus/forum');
    }
    public function delete($id)
    {
        $forum = Forum::find($id);
        Storage::disk('ftp-forum')->delete($forum->foto);
        $forum->delete();
        return back()->with('success',' Mata Pelajaran Berhasil Dihapus');
    }
}
