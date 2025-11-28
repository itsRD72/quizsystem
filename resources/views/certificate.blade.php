<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificate of Completion</title>
<style>
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background: #f7f7f7;
}

/* Certificate container */
.certificate-container {
    width: 100%;
    max-width: 700px;      /* Safe width for A4 */
    margin: 50px auto;
    padding: 30px;
    border: 8px solid #0dcaf0;
    border-radius: 15px;    /* Rounded corners */
    background: #ffffff;
    text-align: center;
    box-sizing: border-box;
}

/* Logo */
.certificate-logo {
    width: 100px;
    margin-bottom: 20px;
}

/* Title */
.certificate-title {
    font-size: 36px;
    font-weight: bold;
    color: #0dcaf0;
    margin-bottom: 20px;
}

/* Subtitle */
.certificate-subtitle {
    font-size: 18px;
    margin-bottom: 15px;
}

/* Name */
.certificate-name {
    font-size: 28px;
    font-weight: bold;
    margin: 20px 0;
}

/* Course / Quiz */
.certificate-course {
    font-size: 22px;
    margin: 15px 0;
}

/* Date */
.certificate-date {
    margin-top: 30px;
    font-size: 16px;
}

/* Buttons (browser only) */
.pdf-buttons {
    text-align: center;
    margin-top: 30px;
}
.pdf-buttons a {
    display: inline-block;
    text-decoration: none;
    padding: 12px 25px;
    font-size: 18px;
    border-radius: 5px;
    margin: 0 10px;
}
.pdf-buttons .btn-back {
    border: 2px solid #0dcaf0;
    color: #0dcaf0;
}
.pdf-buttons .btn-download {
    background: #0dcaf0;
    color: #fff;
    border: none;
}
</style>
</head>
<body>

<div class="certificate-container">

    
    <div class="certificate-title">Certificate of Completion</div>
    <div class="certificate-subtitle">This is proudly presented to</div>
    <div class="certificate-name">{{ $data['name'] }}</div>
    <div class="certificate-subtitle">for successfully completing the Quiz</div>
    <div class="certificate-course">{{ $data['quiz'] }}</div>
    <div class="certificate-date">Date: {{ $data['date'] }}</div>

    <!-- Browser buttons -->
    <div class="pdf-buttons">
        <a href="/" class="btn-back">Back</a>
        <a href="{{ url('download-certificate') }}" class="btn-download">Download PDF</a>
    </div>

</div>

</body>
</html>
