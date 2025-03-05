<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification Mail</title>
</head>
<body>
<p>Hello {{ $admin->name }},</p>

<p>{{ $message_content }}</p>

<p>Best Regards,<br>Superadmin</p>

</body>
</html>



