@extends('layouts.app')

@section('content')
    <h1>Data Kawasan</h1>
    <a href="{{ route('data_kawasan.create') }}" class="btn btn-primary">Tambah Data</a>
    <table>
        <tr>
            <th>No</th>
            <th>Kawasan</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        @foreach ($data_kawasans as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kawasan }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>
                    <a href="{{ route('data_kawasan.edit', $item->id) }}">Edit</a>
                    <form action="{{ route('data_kawasan.destroy', $item->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
