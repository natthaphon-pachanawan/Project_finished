@extends('admin.layout-admin')

@section('content')
    <h1>จัดการข่าวสาร</h1>
    <table>
        <thead>
            <tr>
                <th>หัวข้อ</th>
                <th>เนื้อหา</th>
                <th>รูปภาพ</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $newsItem)
                <tr>
                    <td>{{ $newsItem->title }}</td>
                    <td>{{ Str::limit($newsItem->content, 100) }}</td>
                    <td>
                        @if($newsItem->image)
                            <img src="{{ asset('storage/' . $newsItem->image) }}" alt="News Image" width="100">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.news.edit', $newsItem->id) }}">แก้ไข</a>
                        <form action="{{ route('admin.news.destroy', $newsItem->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">ลบ</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
