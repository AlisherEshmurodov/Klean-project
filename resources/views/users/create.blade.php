<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create user</title>
</head>
<body>
<h1>Create new user</h1>
<form action="/user-create" method="post" >
    @csrf
    <input type="text" name="ismi">
    <br>
    <input type="text" name="emaile">
    <br>
    <button type="submit" name="create-button">Create</button>
</form>
</body>
</html>
