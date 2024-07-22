@extends('admin.layout-admin')

@section('content')
    <h1>แก้ไขข่าวสาร</h1>
    <form action="{{ route('admin.news.update', $newsItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="title">หัวข้อ:</label>
            <input type="text" id="title" name="title" value="{{ $newsItem->title }}" required>
        </div>
        <div>
            <label for="content">เนื้อหา:</label>
            <textarea id="content" name="content" required>{{ $newsItem->content }}</textarea>
        </div>
        <div>
            <label for="image">รูปภาพ:</label>
            @if($newsItem->image)
                <img src="{{ asset('storage/' . $newsItem->image) }}" alt="News Image" width="100">
            @endif
            <input type="file" id="image" name="image">
        </div>
        <button type="submit">บันทึก</button>
    </form>
@endsection
