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
        <h1>Edit Caregiver</h1>
        <form action="{{ route('cg.update', $caregiver->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="Name_CG">Name of Care Giver:</label>
                <input type="text" id="Name_CG" name="Name_CG" value="{{ $caregiver->Name_CG }}" required>
            </div>
            <div>
                <label for="elderly_id">Elderly:</label>
                <select name="elderly_id" id="elderly_id" required>
                    @foreach ($elderlies as $elderly)
                        <option value="{{ $elderly->ID_Elderly }}"
                            {{ $elderly->ID_Elderly == $caregiver->elderly_id ? 'selected' : '' }}>
                            {{ $elderly->Name_Elderly }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Add other fields as necessary -->
            <button type="submit">Update Caregiver</button>
        </form>
    @endsection

</body>

</html>
