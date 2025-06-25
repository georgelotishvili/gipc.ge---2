<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sent Successfully</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-green-500 p-4">
            <h1 class="text-white text-xl font-bold">Success!</h1>
        </div>
        
        <div class="p-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>GIPC GO!</p>
            </div>
            
            <p class="text-gray-700 mb-6">The email has been sent successfully using Mailgun. If you don't see it in the inbox, please check the spam folder.</p>
            
            <div class="mt-6 flex">
                <a href="{{ url('/send-test-email') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md mr-3">Send Another</a>
                <a href="{{ url('/') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html> 