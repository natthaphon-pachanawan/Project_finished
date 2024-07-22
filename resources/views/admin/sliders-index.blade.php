@extends('admin.layout-admin')

@section('content')
    <h1>จัดการ Slider</h1>
    <table>
        <thead>
            <tr>
                <th>รูปภาพ</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" width="100">
                    </td>
                    <td>
                        <a href="{{ route('admin.sliders.edit', $slider->id) }}">แก้ไข</a>
                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display:inline;">
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
