<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyData</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384- T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    
</style>
<body style="background: lightgray">
<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">DATA SEKOLAH</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('sekolah.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">IMG</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">JURUSAN</th>
                                    <th scope="col">NO HP</th>
                                    <th scope="col">ALAMAT</th>
                                    <th scope="col">EMAIL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $post)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/sekolah/'.$post->foto) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{!! $post->nama !!}</td>
                                    <td>{!! $post->jurusan !!}</td>
                                    <td>{!! $post->no_hp !!}</td>
                                    <td>{!! $post->alamat !!}</td>
                                    <td>{!! $post->email !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('sekolah.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('sekolah.show', $post->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('sekolah.edit', $post->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Post belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>