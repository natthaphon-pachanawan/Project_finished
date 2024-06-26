<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @include('layout.nav')

    @section('content')
        <h1>Caregivers</h1>
        <a href="{{ route('cg.create') }}">Add New Caregiver</a>
        <ul>
            @foreach ($caregivers as $caregiver)
                <li>{{ $caregiver->Name_CG }}
                    <a href="{{ route('cg.edit', $caregiver->id) }}">Edit</a>
                    <form action="{{ route('cg.destroy', $caregiver->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endsection


</body>

</html>
