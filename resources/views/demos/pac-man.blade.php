<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pack-Man AI Chatbot Demo | Noctuacore</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
  <div
    x-data="pacManDemo()"
    x-init="init()"
    class="min-h-screen bg-white"
  >

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
            <div class="flex gap-3">
              <input
                type="text"
                placeholder="ΚΩΔΙΚΟΣ ΑΝΑΖΗΤΗΣΗΣ"
                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-orange-500 focus:outline-none"
              >
              <button class="bg-black text-white px-8 py-3 rounded-lg font-bold hover:bg-gray-800 transition">
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

    {{-- Demo controls --}}
    <div class="fixed top-24 left-6 bg-white p-4 rounded-xl shadow-2xl z-50 border-2 border-orange-400 max-w-xs">
      <h3 class="font-bold text-black mb-2 flex items-center gap-2">
        <svg class="h-5 w-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        Noctuacore AI Demo
      </h3>
      <p class="text-xs text-gray-600 mb-4">
        Δείτε πώς το AI chatbot απαντά σε πραγματικές ερωτήσεις πελατών.
      </p>
      <div class="flex gap-2">
        <template x-if="!isDemoPlaying">
          <button
            @click="startDemo()"
            class="flex-1 packman-gradient text-black py-2 px-3 rounded-lg text-sm font-bold hover:opacity-90 flex items-center justify-center gap-2 transition"
          >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Εκκίνηση Demo
          </button>
        </template>
        <template x-if="isDemoPlaying">
          <button
            @click="stopDemo()"
            class="flex-1 bg-red-500 text-white py-2 px-3 rounded-lg text-sm font-bold hover:bg-red-600 flex items-center justify-center gap-2 transition"
          >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Παύση
          </button>
        </template>
        <button
          @click="reset()"
          class="bg-gray-200 text-gray-700 p-2 rounded-lg hover:bg-gray-300 transition"
          title="Επαναφορά"
        >
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
        </button>
      </div>
    </div>

    {{-- Chat widget --}}
    <div
      class="fixed bottom-6 right-6 z-40 transition-all duration-500 ease-in-out flex flex-col items-end"
      :class="isOpen ? 'w-full md:w-[400px]' : 'w-auto'"
    >
      <div
        class="bg-white rounded-2xl shadow-2xl border-2 border-orange-400 w-full overflow-hidden transition-all duration-300 origin-bottom-right"
        :class="isOpen ? 'opacity-100 scale-100 h-[600px]' : 'opacity-0 scale-90 h-0 w-0'"
      >

        <div class="packman-gradient p-4 flex justify-between items-center">
          <div class="flex items-center gap-3">
            <div class="relative">
              <div class="bg-black p-2 rounded-full">
                <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <div class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 border-2 border-yellow-400 rounded-full"></div>
            </div>
            <div>
              <h3 class="font-bold text-black text-sm">Pack-Man Assistant</h3>
              <p class="text-xs text-gray-800 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                Online • AI-Powered
              </p>
            </div>
          </div>
          <button @click="isOpen = false" class="text-black hover:text-gray-700 transition">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div class="bg-gray-50 h-[460px] overflow-y-auto pt-4 px-4 pb-8 space-y-4">
          <div class="text-center text-xs text-gray-400 my-2">Σήμερα</div>

          <template x-for="msg in messages" :key="msg.id">
            <div
              class="flex"
              :class="msg.type === 'user' ? 'justify-end' : 'justify-start'"
            >
              <template x-if="msg.type === 'bot'">
                <div class="w-8 h-8 packman-gradient rounded-full flex items-center justify-center mr-2 shrink-0 mt-1">
                  <svg class="h-4 w-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                </div>
              </template>
              <div
                class="max-w-[80%] rounded-2xl px-3 py-2 text-sm shadow-sm"
                :class="msg.type === 'user' ? 'bg-black text-white rounded-br-none' : 'bg-white text-gray-800 border border-gray-200 rounded-tl-none'"
              >
                <p class="whitespace-pre-wrap leading-relaxed m-0" x-html="formatMessage(msg.text, msg.type)"></p>
              </div>
            </div>
          </template>

          <div x-show="isTyping" class="flex justify-start animate-fade-in" x-transition>
            <div class="w-8 h-8 packman-gradient rounded-full flex items-center justify-center mr-2 shrink-0">
              <svg class="h-4 w-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl rounded-tl-none p-4 shadow-sm flex gap-1 items-center h-10 w-16">
              <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
              <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
              <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
            </div>
          </div>
          <div x-ref="messagesEnd"></div>
        </div>

        <div class="p-4 bg-white border-t border-gray-200 absolute bottom-0 w-full">
          <div class="flex items-center gap-2 bg-gray-50 rounded-full px-4 py-2 border border-gray-300 focus-within:ring-2 focus-within:ring-orange-400 transition-all">
            <input
              type="text"
              :placeholder="isDemoPlaying ? 'Το AI γράφει...' : 'Γράψτε την ερώτησή σας...'"
              :disabled="isDemoPlaying"
              class="bg-transparent flex-1 outline-none text-sm text-gray-700 placeholder-gray-400"
            >
            <button class="text-gray-400 hover:text-orange-600 transition">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
              </svg>
            </button>
          </div>
          <div class="text-center mt-2">
            <span class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">Powered by Noctuacore AI</span>
          </div>
        </div>

      </div>

      <button
        @click="isOpen = !isOpen"
        class="mt-4 w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-110"
        :class="isOpen ? 'bg-black text-yellow-400' : 'packman-gradient text-black'"
      >
        <template x-if="isOpen">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </template>
        <template x-if="!isOpen">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
          </svg>
        </template>
      </button>
    </div>

  </div>

  <script>
    function pacManDemo() {
      const initialMessage = {
        id: 1,
        type: 'bot',
        text: 'Γεια σας! 👋 Είμαι ο Pack-Man AI Assistant. Πώς μπορώ να σας βοηθήσω σήμερα;'
      };

      const demoScript = [
        { type: 'user', text: 'Πού είναι το δέμα μου #PAC8829?', delay: 1000 },
        { type: 'bot', text: 'Ελέγχω το σύστημα... 🔍\n\nΤο βρήκα! Η παραγγελία #PAC8829 είναι **Σε Διανομή**. Ο οδηγός απέχει περίπου 15 λεπτά.', delay: 2000 },
        { type: 'user', text: 'Μπορώ να αλλάξω τη διεύθυνση παράδοσης;', delay: 1500 },
        { type: 'bot', text: "Ας ελέγξω την κατάσταση. 🚛\n\nΕπειδή ο οδηγός είναι ήδη κοντά, δεν μπορώ να το ανακατευθύνω αυτόματα. Ωστόσο, μπορώ να ζητήσω **'Παραμονή στο Hub'** για να το παραλάβετε αργότερα. Θέλετε να το κάνω;", delay: 2500 },
        { type: 'user', text: 'Όχι, είναι εντάξει. Ποιες είναι οι τιμές αποστολής για Θεσσαλονίκη;', delay: 1500 },
        { type: 'bot', text: 'Για αποστολή στη Θεσσαλονίκη: \n\n📦 **Standard (24ώρες):** €5.50\n🚀 **Same Day Premium:** €12.00\n\nΟι τιμές ενημερώνονται σε πραγματικό χρόνο.', delay: 3000 },
        { type: 'user', text: 'Το τελευταίο μου δέμα έφτασε κατεστραμμένο.', delay: 1500 },
        { type: 'bot', text: 'Λυπάμαι πολύ που το ακούω. 😟\n\nΜπορώ να ξεκινήσω αξίωση αμέσως. Παρακαλώ ανεβάστε φωτογραφία της ζημιάς. Δημιούργησα **Ticket #DMG-902** για άμεση επανεξέταση.', delay: 2500 },
        { type: 'user', text: 'Κάνετε αποστολές σε όλη την Ελλάδα;', delay: 1500 },
        { type: 'bot', text: 'Ναι! Καλύπτουμε όλη την Ελλάδα. 🇬🇷\n\nΣτην Αττική παραδίδουμε εντός 24 ωρών με εγγύηση 90%+ στην πρώτη προσπάθεια.', delay: 2500 },
        { type: 'user', text: 'Ποιο είναι το ωράριο εξυπηρέτησης;', delay: 1500 },
        { type: 'bot', text: 'Το κέντρο υποστήριξης είναι ανοιχτό:\n\n📅 **Δευ-Παρ:** 08:00 - 20:00\n📅 **Σάβ:** 09:00 - 17:00\n\n(Αλλά εγώ είμαι εδώ 24/7! 🤖)', delay: 2000 },
        { type: 'user', text: 'Μπορώ να μιλήσω με άνθρωπο;', delay: 1500 },
        { type: 'bot', text: 'Βεβαίως. Βλέπω ότι η Μαρία είναι διαθέσιμη. Σας συνδέω τώρα... 📞', delay: 2500 }
      ];

      return {
        isOpen: true,
        isDemoPlaying: false,
        messages: [initialMessage],
        isTyping: false,
        demoStep: 0,
        demoScript,
        timeoutId: null,

        formatMessage(text, type) {
          if (!text) return '';
          const escaped = String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
          const strongClass = type === 'user' ? 'text-yellow-400' : 'text-orange-600';
          const parts = escaped.split('**');
          let html = '';
          for (let i = 0; i < parts.length; i++) {
            html += i % 2 === 1
              ? `<strong class="${strongClass}">${parts[i]}</strong>`
              : parts[i];
          }
          return html;
        },

        startDemo() {
          this.messages = [{ ...initialMessage }];
          this.demoStep = 0;
          this.isDemoPlaying = true;
          this.isOpen = true;
        },

        stopDemo() {
          if (this.timeoutId) {
            clearTimeout(this.timeoutId);
            this.timeoutId = null;
          }
          this.isDemoPlaying = false;
          this.isTyping = false;
        },

        reset() {
          this.stopDemo();
          this.messages = [{ ...initialMessage }];
          this.demoStep = 0;
        },

        init() {
          this.$watch('[isDemoPlaying, demoStep]', ([playing, step]) => {
            if (this.timeoutId) {
              clearTimeout(this.timeoutId);
              this.timeoutId = null;
            }
            if (!playing || step >= this.demoScript.length) {
              if (step >= this.demoScript.length) {
                this.isDemoPlaying = false;
              }
              return;
            }
            const action = this.demoScript[step];
            this.timeoutId = setTimeout(() => {
              this.timeoutId = null;
              if (action.type === 'user') {
                this.messages.push({ id: Date.now(), type: 'user', text: action.text });
                this.demoStep++;
                this.isTyping = true;
              } else {
                this.isTyping = false;
                this.messages.push({ id: Date.now(), type: 'bot', text: action.text });
                this.demoStep++;
              }
            }, action.delay);
          });

          this.$watch('[messages.length, isTyping]', () => {
            this.$nextTick(() => {
              this.$refs.messagesEnd?.scrollIntoView({ behavior: 'smooth' });
            });
          });
        }
      };
    }
  </script>
</body>
</html>
