<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ebee;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .profile-container h2 {
            margin-top: 0;
            color: #4267b2;
        }

        .profile-container form {
            display: flex;
            flex-direction: column;
        }

        .profile-container .form-group {
            margin-bottom: 15px;
        }

        .profile-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .profile-container input[type="text"],
        .profile-container input[type="email"],
        .profile-container input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .profile-container input[type="text"]:focus,
        .profile-container input[type="email"]:focus,
        .profile-container input[type="file"]:focus {
            border-color: #4267b2;
            outline: none;
        }

        .edit-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4267b2;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            align-self: flex-start;
        }

        .edit-button:hover {
            background-color: #365899;
        }
    </style>
</head>

<body>
    @include('layout.nav')

    <div class="profile-container">
        <h2>Edit Profile</h2>
        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
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
                <input type="text" id="Address" name="Address" value="{{ $user->Address }}">
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" id="Phone" name="Phone" value="{{ $user->Phone }}">
            </div>
            <div class="form-group">
                <label for="Image_User">Profile Image</label>
                <input type="file" id="Image_User" name="Image_User">
            </div>
            <button type="submit" class="edit-button">Save Changes</button>
        </form>
    </div>
</body>

</html>
