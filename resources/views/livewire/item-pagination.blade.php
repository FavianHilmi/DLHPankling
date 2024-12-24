<div>
    <h1>Daftar Item</h1>

    <ul class="list-group">
        @foreach($items as $item)
            <li class="list-group-item">{{ $item->name }}</li> <!-- Ganti 'name' sesuai atribut model Anda -->
        @endforeach
    </ul>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $items->links() }} <!-- Menampilkan link pagination -->
    </div>
</div>
