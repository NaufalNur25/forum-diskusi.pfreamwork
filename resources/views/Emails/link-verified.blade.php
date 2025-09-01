<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            background-color: #3b82f6;
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
        .reset-button {
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
        .reset-button:hover {
            transform: translateY(-2px);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .alternative-text {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            border-left: 4px solid #3b82f6;
        }
        .alternative-text p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }
        .alternative-text a {
            color: #3b82f6;
            word-break: break-all;
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
        .security-notice {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .security-notice strong {
            color: #856404;
        }
        .security-notice p {
            margin: 5px 0;
            color: #856404;
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
                <p>We've received a request to verified your email address. Click the button below to verified:</p>
            </div>

            <!-- Verified Button -->
            <div class="button-container">
                <a href="{{ $verifiedUrl }}" class="reset-button">Verified</a>
            </div>

            <!-- Security Notice -->
            <div class="security-notice">
                <strong>⚠️ Important to know:</strong>
                <p>This verified reset link will expire in {{ $expired }} minutes for your account security.</p>
                <p>Contact admin support to make new verification link or you can forget your password also make your email verified.</p>
            </div>

            <!-- Alternative Text Link -->
            <div class="alternative-text">
                <p><strong>Buttons not working?</strong></p>
                <p>Copy and paste the following link into your browser:</p>
                <a href="{{ $verifiedUrl }}">{{ $verifiedUrl }}</a>
            </div>

            <div class="message" style="margin-top: 30px;">
                <p>If you experience any difficulties, please contact our support team.</p>
                <p>Thank You,<br>Team {{ config('app.name') }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>This email was sent automatically, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
