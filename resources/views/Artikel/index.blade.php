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

        <h1 class="mb-4">Daftar Artikel</h1>
        <a href="{{ route('artikel.create') }}">Tambahkan Data</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Author</th>
                    <th>Categories</th>
                    <th>Tags</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($artikels as $artikel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $artikel->name }}</td>
                        <td>
                            {{ Str::words($artikel->content, 3, '...') }}
                            <button type="button" class="btn btn-link p-0 text-primary" data-bs-toggle="modal" data-bs-target="#contentModal{{ $artikel->id }}">
                                Click More
                            </button>
            
                            <!-- Modal -->
                            <div class="modal fade" id="contentModal{{ $artikel->id }}" tabindex="-1" aria-labelledby="contentModalLabel{{ $artikel->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="contentModalLabel{{ $artikel->id }}">Detail Content</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $artikel->content }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $artikel->author->name ?? 'Unknown' }}</td>
                        <td>
                            @if ($artikel->categories->isEmpty())
                                <span class="text-danger">Belum di-setting</span>
                            @else
                                @foreach ($artikel->categories as $category)
                                    <span class="badge bg-primary">{{ $category->kategori->name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if ($artikel->tags->isEmpty())
                                <span class="text-danger">Belum di-setting</span>
                            @else
                                @foreach ($artikel->tags as $tag)
                                    <span class="badge bg-success">{{ $tag->tag->name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('artikel.edit', $artikel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">Hapus</button>
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


