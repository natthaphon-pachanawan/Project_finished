@extends('admin.layout-admin')

@section('content')
    <h1>เพิ่มรูปเลื่อน Slider</h1>
    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="image">รูปภาพ:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <button type="submit">บันทึก</button>
    </form>
@endsection
