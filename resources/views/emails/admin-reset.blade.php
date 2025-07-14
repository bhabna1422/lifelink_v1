<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
</head>
<body>
    <h2>Hello {{ $admin->name }},</h2>

    <p>You requested a password reset. Click the link below to set a new password:</p>

    <p>
        <a href="{{ $resetLink }}" style="color: blue;">
            Reset Your Password
        </a>
    </p>

    <p>If you did not request this, please ignore this email.</p>

    <br>
    <p>Regards,<br>Lifelink Team</p>
</body>
</html>
