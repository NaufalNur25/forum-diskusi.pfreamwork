<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Successful</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #10b981;
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }
        .login-button {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.2s ease;
        }
        .login-button:hover {
            transform: translateY(-2px);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .success-details {
            background-color: #d1fae5;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .success-details strong {
            color: #065f46;
        }
        .success-details p {
            margin: 5px 0;
            color: #065f46;
            font-size: 14px;
        }
        .success-details ul {
            margin: 10px 0;
            padding-left: 20px;
            color: #065f46;
            font-size: 14px;
        }
        .security-notice {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .security-notice strong {
            color: #92400e;
        }
        .security-notice p {
            margin: 5px 0;
            color: #92400e;
            font-size: 14px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #999;
            font-size: 14px;
            border-top: 1px solid #eee;
        }
        .footer p {
            margin: 5px 0;
        }
        .info-box {
            background-color: #eff6ff;
            border: 1px solid #93c5fd;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .info-box strong {
            color: #1e40af;
        }
        .info-box p {
            margin: 5px 0;
            color: #1e40af;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello {{ $user->name ?? 'User' }},
            </div>

            <div class="message">
                <p><strong>Great news!</strong> Your password has been successfully reset. Your account is now secured with your new password.</p>
            </div>

            <!-- Success Details -->
            <div class="success-details">
                <strong>✓ Password Reset Successful</strong>
                <p>Your password was changed on {{ now()->format('F d, Y \a\t g:i A') }} ({{ config('app.timezone') }}).</p>
                <p><strong>What happened:</strong></p>
                <ul>
                    <li>Your old password has been deactivated</li>
                    <li>You've been logged out from all devices for security</li>
                    <li>Your new password is now active</li>
                </ul>
            </div>

            <!-- Login Button -->
            <div class="button-container">
                <a href="{{ route('authentication.login') }}" class="login-button">Login Now</a>
            </div>

            <!-- Security Notice -->
            <div class="security-notice">
                <strong>🔐 Security Notice:</strong>
                <p>For your security, you have been automatically logged out from all devices. Please log in again using your new password.</p>
                <p>If you didn't make this change, please contact our support team immediately.</p>
            </div>

            <!-- Additional Info -->
            <div class="info-box">
                <strong>💡 Security Tips:</strong>
                <p>To keep your account secure:</p>
                <ul>
                    <li>Use a strong, unique password</li>
                    <li>Don't share your password with anyone</li>
                    <li>Enable two-factor authentication if available</li>
                    <li>Log out from public or shared devices</li>
                </ul>
            </div>

            <div class="message" style="margin-top: 30px;">
                <p>If you experience any difficulties logging in or have security concerns, please don't hesitate to contact our support team.</p>
                <p>Thank you for keeping your account secure!</p>
                <p>Best regards,<br>The {{ config('app.name') }} Security Team</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>This email was sent automatically to notify you of account changes.</p>
        </div>
    </div>
</body>
</html>
