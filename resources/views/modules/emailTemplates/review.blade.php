<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .email-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .greeting {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .message {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="email-container">
     <img src="https://aceeducation.com.my/wp-content/uploads/2020/08/cropped-cropped-ACE-EDUCATION-2-2.png">
    <div class="greeting">
        <h2>
            Dear
            @if($data['status'] == 0)
                Student
            @elseif($data['status'] == 1)
                Teacher
            @endif
        </h2>
        Please provide the feedback of your class, by clicking the link below.
    </div>
    <div class="message">
        <h4>{{ $data['link'] }}</h4>
    </div>
    <div class="footer">
        <h5>Thankyou</h5>
        <h6>ACE EDUCATION</h6></h6>
    </div>
</div>
</body>
</html>

