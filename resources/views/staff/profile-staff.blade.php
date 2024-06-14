<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Profile</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="Name_User">Name</label>
            <input type="text" id="Name_User" name="Name_User" value="{{ $user->Name_User }}" required>
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" id="Email" name="Email" value="{{ $user->Email }}" required>
        </div>
        <div class="form-group">
            <label for="Address">Address</label>
            <textarea id="Address" name="Address">{{ $user->Address }}</textarea>
        </div>
        <div class="form-group">
            <label for="Phone">Phone</label>
            <input type="text" id="Phone" name="Phone" value="{{ $user->Phone }}">
        </div>
        <div class="form-group">
            <label for="Image_User">Profile Image</label>
            @if ($user->Image_User)
                <img src="{{ $user->Image_User }}" alt="Profile Image">
            @endif
            <input type="file" id="Image_User" name="Image_User">
        </div>
        <div class="form-group">
            <button type="submit">Update Profile</button>
        </div>
    </form>
</div>

</body>
</html>
