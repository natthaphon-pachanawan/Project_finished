
@extends('admin.layout-admin')

@section('content')
    <h1>เพิ่มข่าวสาร</h1>
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">หัวข้อ:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">เนื้อหา:</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <div>
            <label for="image">รูปภาพ:</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit">บันทึก</button>
    </form>
@endsection
