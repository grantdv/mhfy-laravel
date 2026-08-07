<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | May Harmony Find You</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,load"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#04405F',
                            medium: '#3483EB',
                            light: '#8AE1F0',
                            accent: '#f5771d',
                            bgLight: '#F0FCFD',
                            bgMedium: '#D2F4F9',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-brand-bg-light">
    <nav class="bg-brand-dark text-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-brand-light">May Harmony Find You</a>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('products.index') }}" class="text-brand-light hover:text-white font-medium">Products</a>
                    <a href="{{ route('contact') }}" class="text-brand-light hover:text-white font-medium">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-brand-light">
            <h1 class="text-3xl font-bold mb-2 text-brand-dark">Contact Our Concierge</h1>
            <p class="text-gray-600 mb-8">Our concierge team is here to ensure your experience is seamless. If you have any questions regarding our services or wish to discuss a bespoke request, please share your message below. We will respond promptly to assist you.</p>
            
            @if (session('success'))
                <div class="bg-brand-bg-light border border-brand-orange text-brand-orange px-4 py-3 rounded relative mb-6" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-brand-dark mb-1">Message</label>
                    <textarea name="message" rows="5" required class="w-full px-4 py-2 border border-brand-light rounded-lg focus:ring-2 focus:ring-brand-medium focus:border-brand-medium outline-none"></textarea>
                </div>
                <div class="pt-2">
                    <button type="submit" class="w-full bg-brand-medium text-white font-bold py-3 rounded-lg hover:bg-brand-light transition-colors shadow-lg shadow-brand-bg-light">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
