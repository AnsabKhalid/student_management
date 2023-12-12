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
{{--        Hello--}}
        Dear {{ $data['teacherName'] }},
    </div>
    <div class="message">
        Our student {{ $data['studentName'] }} wants to learn {{ $data['subjectsString'] }} from you.
        If you can teach this student, please contact us as soon as possible because this is on a first-come, first-serve basis.
    </div>
    <div class="footer">
        <h5>Thank You</h5>
        <h6>We would love to hear from you. Please contact us on WhatsApp at [+601137388789] at your convenience or Click below WhatsApp Button. Thank You :) </h6>
          <a href="https://wa.me/+601137388789"><img src="https://aceeducation.com.my/whatsapp.png" width="250" height="60"></a>
        
    </div>
</div>
</body>
</html>
