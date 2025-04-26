<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Error</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-red-500 p-4">
            <h1 class="text-white text-xl font-bold">Email Sending Failed</h1>
        </div>
        
        <div class="p-6">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ $error }}</p>
            </div>
            
            <h2 class="text-lg font-semibold mb-4">How to fix this:</h2>
            
            @if(strpos($error, 'Free accounts are for test purposes only') !== false || strpos($error, 'authorized recipients') !== false)
                <div class="space-y-4">
                    <p class="text-gray-700">You're using a Mailgun sandbox domain with a free account, which has restrictions:</p>
                    
                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                        <li>Log in to your <a href="https://app.mailgun.com/app/dashboard" class="text-blue-600 hover:underline" target="_blank">Mailgun dashboard</a></li>
                        <li>Go to "Sending" → "Domains" and select your sandbox domain</li>
                        <li>Click on "Authorized Recipients"</li>
                        <li>Add <strong>{{ $to }}</strong> as an authorized recipient</li>
                        <li>Check your email for a verification message from Mailgun</li>
                        <li>After verifying, try sending the email again</li>
                    </ol>
                    
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <p class="font-medium">Alternative options:</p>
                        <ul class="list-disc list-inside space-y-1 text-gray-700 mt-2">
                            <li>Upgrade to a paid Mailgun account</li>
                            <li>Add a custom domain to your Mailgun account instead of using the sandbox</li>
                        </ul>
                    </div>
                </div>
            @else
                <p class="text-gray-700">There was an error with the email service. Please check your Mailgun configuration and try again.</p>
            @endif
            
            <div class="mt-6 flex">
                <a href="{{ url('/send-test-email') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md mr-3">Try Again</a>
                <a href="{{ url('/') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html> 