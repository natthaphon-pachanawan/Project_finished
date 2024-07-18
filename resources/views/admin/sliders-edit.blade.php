@extends('admin.layout-admin')

@section('content')
    <h1>แก้ไขรูปเลื่อน Slider</h1>
    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="image">รูปภาพ:</label>
            @if($slider->image)
                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" width="100">
            @endif
            <input type="file" id="image" name="image">
        </div>
        <button type="submit">บันทึก</button>
    </form>
@endsection
