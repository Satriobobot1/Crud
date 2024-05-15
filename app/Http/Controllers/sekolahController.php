<?php

namespace App\Http\Controllers;

use App\Models\sekolah;
use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;
//return type redirect response
use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class sekolahController extends Controller
{
    //
    public function index(): View
    {
        //gets post
        $data = sekolah::latest()->paginate(5);

        //render view with post
        return view('sekolah.index', compact('data'));
    }
    public function create(): View
    {
        return view('sekolah.create');
    }
    public function store(Request $request): RedirectResponse
    {
        //validate form 
        $this->validate($request, [
            'nama' => 'required|min:10',
            'jurusan' => 'required|min:10',
            'no_hp' => 'required|min:10',
            'alamat' => 'required|min:10',
            'email' => 'required|min:10',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',

        ]);

        //upload image 
        $image = $request->file('foto');
        $image->storeAs('public/sekolah', $image->hashName());

        //create post 
        sekolah::create([
            'foto' => $image->hashName(),
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);
        //redirect to index
        return redirect()->route('sekolah.index');
    }
    public function show(string $id)
    {
        //get post by id
        $data = sekolah::findOrFail($id);

        //render view with post
        return view('sekolah.show', compact('data'));
    }
    public function edit(string $id): View
    {
        //get id
        $data = sekolah::findOrFail($id);

        //render view with post
        return view('sekolah.edit', compact('data'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form 
        $this->validate($request, [
            'nama' => 'required|min:10',
            'jurusan' => 'required|min:10',
            'no_hp' => 'required|min:10',
            'alamat' => 'required|min:10',
            'email' => 'required|min:10',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        //get post by ID 
        $data = sekolah::findOrFail($id);
        //check if image is uploaded 
        if ($request->hasFile('foto')) {
            //upload new image 
            $image = $request->file('foto');
            $image->storeAs('public/sekolah', $image->hashName());
            //delete old image 
            Storage::delete('public/sekolah/' . $data->foto);

            //update post with new image 
            $data->update([
                'foto' => $image->hashName(),
                'nama' => $request->nama,
                'jurusan' => $request->jurusan,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'email' => $request->email,
            ]);
        } else {
            //update post without image 
            $data->update([
                'nama' => $request->nama,
                'jurusan' => $request->jurusan,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'email' => $request->email,
            ]);
        }
        //redirect to index 
        return redirect()->route('sekolah.index');
    }
    public function destroy($id): RedirectResponse
    {
        //get id
        $data = sekolah::findOrFail($id);

        //delete img
        Storage::delete('public/sekolah/' . $data->foto);

        //delete post
        $data->delete();

        //retun to index
        return redirect()->route('sekolah.index');
    }
}
