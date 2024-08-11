<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Katergori</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            <th>Cover</th>
            <th>File</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->user->name }}</td>
                <td>{{ $book->category->name }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->description }}</td>
                <td>{{ $book->amount }}</td>
                <td>{{ url('storage/book/covers/' . $book->cover) }}</td>
                <td>{{ url('storage/book/files/' . $book->file) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
