<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Comment Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            color: #333333;
        }
        .comment-box {
            background-color: #f9f9f9;
            border-left: 4px solid #4CAF50;
            padding: 15px;
            font-style: italic;
            margin-top: 10px;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="header">
            <h1>💬 New Comment Received</h1>
        </div>
        <div class="content">
            <p><strong>From:</strong> {{ $userName }}</p>
            <div class="comment-box">
                {{ $comment }}
            </div>
        </div>
        <div class="footer">
            This is an automated notification from BlogBites.
        </div>
    </div>

</body>
</html>
