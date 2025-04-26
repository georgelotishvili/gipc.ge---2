<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Custom Email</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-500 p-4">
                <h1 class="text-white text-xl font-bold">Send Custom Email</h1>
            </div>
            
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ url('/send-custom-email') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="to" class="block text-sm font-medium text-gray-700 mb-1">Recipient Email</label>
                        <input type="email" name="to" id="to" value="{{ old('to', 'jimshitashvilinika742@gmail.com') }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <p class="mt-1 text-xs text-gray-500">Note: For sandbox domains, recipient must be authorized in Mailgun</p>
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject', 'Custom Email') }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea name="message" id="message" rows="6" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('message', 'This is a custom message sent from my Laravel application using Mailgun.') }}</textarea>
                    </div>
                    
                    <div>
                        <label for="html" class="block text-sm font-medium text-gray-700 mb-1">HTML Content (Optional)</label>
                        <textarea name="html" id="html" rows="6" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('html', '<h1>Custom Email</h1><p>This is a <strong>custom message</strong> sent from my Laravel application using Mailgun.</p>') }}</textarea>
                    </div>
                    
                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Back to Home</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Send Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 