<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ExamBox24HRS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #24292D;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            padding: 40px;
            text-align: center;
            color: #24292D;
        }
        .header img {
            max-width: 120px; /* Increased the logo size */
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 26px;
            font-weight: bold;
            margin: 15px 0 0;
        }
        .content {
            padding: 30px;
            text-align: center;
        }
        .content h2 {
            font-size: 22px;
            color: #EA3338;
            margin-top: 0;
        }
        .content p {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
            margin: 15px 0;
        }
        .btn {
            display: inline-block;
            margin: 20px 0;
            padding: 14px 36px;
            color: #ffffff;
            background-color: #EA3338;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #C6282B;
        }
        .footer {
            background-color: #f4f4f4;
            color: #777777;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
        .footer p {
            margin: 8px 0;
        }
        .footer a {
            color: #EA3338;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header with Logo -->
        <div class="header">
            <img src="https://exambox24hrs.com/public/assets/images/logoexam24.png" alt="ExamBox24HRS Logo">
           
        </div>

        <!-- Main Content -->
        <div class="content">
            @php
                var_dump($student);
            @endphp
            <h2>Hello, {{ $student['name'] ?? 'Student' }}!</h2>

            <p>We're thrilled to have you join the ExamBox24HRS community. You now have access to a wide range of government exam quizzes and resources. Start your journey with us and take your preparation to the next level!</p>
            
            <a href="{{ route('student.login') }}" class="btn">Log In to Your Account</a>
            
            <p>If you need any assistance, our support team is here for you. Let’s work together towards your success!</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} ExamBox24HRS. All rights reserved.</p>
            <p><a href="https://exambox24hrs.com">Visit our website</a> | <a href="mailto:support@exambox24hrs.com">Contact Support</a></p>
        </div>
    </div>
</body>
</html>
