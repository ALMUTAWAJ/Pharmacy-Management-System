<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <div>
        <b><p>Hello,</p>
        <p>You have requested to reset your password. Please click the link below to reset your password:</p>
        <a href="{{ route('reset.password', $token) }}"
        style="display: inline-block; background-color: #b50a9e; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; text-align: center;">Reset
        Password</a>
        <p>If you did not request a password reset, please ignore this email.</p>
        <p>Thank you for using our service.</p></b>
    </div>
</body>
</html>


