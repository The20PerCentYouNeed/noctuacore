<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pack-Man AI Chatbot Demo | Noctuacore</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script
    defer
    src="https://pac-man-delivery.noctuacore.ai/build/pacman-chat-widget.js"
    data-pacman-api="https://pac-man-delivery.noctuacore.ai"
  ></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap');

    body {
      font-family: 'Roboto', sans-serif;
    }

    @keyframes fade-in {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
      animation: fade-in 0.3s ease-out;
    }

    .packman-gradient {
      background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    }

    .hero-pattern {
      background-image:
        repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);
    }
  </style>
</head>
<body>
  <div class="min-h-screen bg-white">

    {{-- Header --}}
    <header class="bg-black text-white py-4 px-6 shadow-lg">
      <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center gap-3">
          <div class="packman-gradient p-2 rounded-lg">
            <svg class="h-8 w-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
          </div>
          <div>
            <h1 class="text-2xl font-black tracking-tight">PACK-MAN</h1>
            <p class="text-xs text-gray-400">Ταχυμεταφορές</p>
          </div>
        </div>
        <nav class="hidden md:flex gap-8 text-sm font-medium">
          <a href="#" class="hover:text-yellow-400 transition">ΑΡΧΙΚΗ</a>
          <a href="#" class="hover:text-yellow-400 transition">ΑΝΑΖΗΤΗΣΗ</a>
          <a href="#" class="hover:text-yellow-400 transition">ΥΠΗΡΕΣΙΕΣ</a>
          <a href="#" class="hover:text-yellow-400 transition">ΕΠΙΚΟΙΝΩΝΙΑ</a>
        </nav>
        <button class="packman-gradient text-black px-6 py-2 rounded-lg font-bold hover:opacity-90 transition text-sm">
          ΣΥΝΔΕΣΗ
        </button>
      </div>
    </header>

    {{-- Hero --}}
    <section class="packman-gradient hero-pattern py-20 px-6">
      <div class="container mx-auto">
        <div class="max-w-4xl">
          <h2 class="text-5xl md:text-6xl font-black text-black mb-6 leading-tight">
            PACK-MAN<br>
            <span class="text-white">is here...</span>
          </h2>
          <p class="text-2xl text-black font-bold mb-4">
            Welcome to Delivery ZONE!!!
          </p>
          <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-8 shadow-2xl max-w-2xl">
            <h3 class="text-3xl font-black text-black mb-4 flex items-center gap-3">
              <svg class="h-8 w-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              Real Time Tracking
            </h3>
            <p class="text-gray-700 mb-6">
              Ζωντανή ιχνηλάτιση του οδηγού κατά τη διαδικασία παράδοσης του δέματος
            </p>
            <div class="flex flex-col sm:flex-row gap-3 min-w-0">
              <input
                type="text"
                placeholder="ΚΩΔΙΚΟΣ ΑΝΑΖΗΤΗΣΗΣ"
                class="flex-1 min-w-0 px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-orange-500 focus:outline-none"
              >
              <button class="bg-black text-white px-8 py-3 rounded-lg font-bold hover:bg-gray-800 transition shrink-0 w-full sm:w-auto">
                ΑΝΑΖΗΤΗΣΗ
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Services --}}
    <section class="py-16 px-6 bg-gray-50">
      <div class="container mx-auto">
        <h3 class="text-4xl font-black text-center mb-12 text-black">Our Services</h3>
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">

          <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
            <div class="packman-gradient w-16 h-16 rounded-full flex items-center justify-center mb-6">
              <svg class="h-8 w-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <h4 class="text-xl font-bold mb-3 text-black">Same Day Premium Service</h4>
            <p class="text-gray-600">
              Άμεση παράδοση την ίδια μέρα με εγγύηση και real-time tracking.
            </p>
          </div>

          <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
            <div class="packman-gradient w-16 h-16 rounded-full flex items-center justify-center mb-6">
              <svg class="h-8 w-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
              </svg>
            </div>
            <h4 class="text-xl font-bold mb-3 text-black">Standard Delivery</h4>
            <p class="text-gray-600">
              Παράδοση εντός 24 ωρών στο Λεκανοπέδιο Αττικής με χαμηλό κόστος.
            </p>
          </div>

          <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
            <div class="packman-gradient w-16 h-16 rounded-full flex items-center justify-center mb-6">
              <svg class="h-8 w-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h4 class="text-xl font-bold mb-3 text-black">Delivery & Results</h4>
            <p class="text-gray-600">
              90%+ επιτυχία στην πρώτη προσπάθεια με πλήρη διαφάνεια.
            </p>
          </div>

        </div>
      </div>
    </section>

  </div>
</body>
</html>
