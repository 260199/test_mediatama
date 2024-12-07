@extends('Layout.navbaradmin')
@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif


        <h1 class="mb-4">Daftar author</h1>
        <a href="{{ route('author.create') }}">Tambahkan Data</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Create</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($author as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->name }}</td>
                        <td>{{ $k->email }}</td>
                        <td>{{ $k->created_at }}</td>
                        <td>
                            <a href="{{ route('author.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('author.destroy', $k->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus author ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No articles found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection