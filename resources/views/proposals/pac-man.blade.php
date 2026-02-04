@extends('layouts.proposal')

@section('content')
<div x-data="{
    showTermsModal: {{ $termsAccepted ? 'false' : 'true' }},
    accepting: false,
    acceptanceChecked: false,
    showSuccessToast: {{ session('proposal_accepted_success') ? 'true' : 'false' }}
}"
     x-init="
        if (showTermsModal) { document.body.style.overflow = 'hidden'; }
        if (showSuccessToast) { setTimeout(() => { showSuccessToast = false; }, 3000); }
     "
     @terms-accepted.window="showTermsModal = false; document.body.style.overflow = 'auto';">

    {{-- Terms Acceptance Modal --}}
    <div x-show="showTermsModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         style="display: none;">
        <div class="absolute inset-0 bg-gray-950/50 backdrop-blur-sm" @click.away=""></div>

        <div class="relative bg-gray-900 rounded-lg border border-gray-700 shadow-2xl max-w-2xl w-full p-8 md:p-10"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-white mb-2">Εμπιστευτικό Έγγραφο</h2>
                <p class="text-gray-400">Παρακαλούμε διαβάστε και αποδεχτείτε τους όρους</p>
            </div>

            <div class="bg-gray-800/50 rounded-lg p-6 mb-6 border border-gray-700">
                <p class="text-gray-300 leading-relaxed mb-4">
                    Η παρούσα μελέτη αποτελεί εμπιστευτικό έγγραφο. Δεν επιτρέπεται η αναπαραγωγή, διανομή ή μεταβίβαση, εν όλω ή εν μέρει, σε οποιοδήποτε τρίτο πρόσωπο ή εταιρεία, πέραν των αρμοδίων στελεχών της εταιρείας Pack-Man, για την οποία και έχει αποκλειστικά δημιουργηθεί. Τα πνευματικά δικαιώματα της παρούσας μελέτης ανήκουν στη <strong class="text-white">Noctua Core – Elias Kalyvas Learning & Development</strong>.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <button @click="window.location.href = '{{ route('home') }}'"
                        class="flex-1 px-10 py-4 text-lg font-semibold text-gray-300 bg-gray-800 rounded-lg hover:bg-gray-700 transition-all duration-200 border border-gray-700 cursor-pointer">
                    Απόρριψη
                </button>
                <button @click="accepting = true; fetch('{{ route('proposals.accept-terms', ['proposal' => $proposal->company_name]) }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }, body: JSON.stringify({ secret: '{{ $secret }}' }) }).then(() => { $dispatch('terms-accepted'); }).catch(() => { accepting = false; alert('Σφάλμα κατά την αποδοχή. Παρακαλώ δοκιμάστε ξανά.'); })"
                        :disabled="accepting"
                        class="flex-1 px-10 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-600/80 to-violet-600/80 backdrop-blur-sm rounded-lg hover:from-blue-600 hover:to-violet-600 hover:border-blue-400/50 hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-blue-500/20 hover:shadow-xl hover:shadow-blue-500/30 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 cursor-pointer">
                    <span class="whitespace-nowrap" x-show="!accepting">Αποδέχομαι τους Όρους</span>
                    <span x-show="accepting">Επεξεργασία...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Success toast (after proposal accepted) --}}
    <div x-show="showSuccessToast"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="fixed top-25 left-1/2 -translate-x-1/2 z-50 px-6 py-4 rounded-lg border border-emerald-500/50 bg-emerald-950/95 backdrop-blur-sm shadow-lg shadow-emerald-500/20"
         style="display: none;">
        <p class="text-emerald-100 font-medium flex items-center gap-2">
            <svg class="size-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Σας ευχαριστούμε για την εμπιστοσύνη σας, θα επικοινωνήσουμε σύντομα μαζί σας!
        </p>
    </div>

    {{-- Page with shifting background --}}
    <div class="relative min-h-screen overflow-hidden">
        {{-- Background Gradient & Animated Blobs (same as home) --}}
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-blue-950 to-violet-950 opacity-50"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-600/10 rounded-full blur-3xl animate-pulse delay-1000"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-24">
            {{-- Proposal status (top-right document metadata) --}}
            @if($proposal->status)
                @php
                    $statusConfig = match (strtolower($proposal->status)) {
                        'under_consideration' => ['label' => 'Υπό Εξέταση', 'classes' => 'bg-blue-600/20 text-blue-300 border-blue-500/50'],
                        'accepted' => ['label' => 'Αποδοχή', 'classes' => 'bg-emerald-600/20 text-emerald-300 border-emerald-500/50'],
                        default => ['label' => $proposal->status, 'classes' => 'bg-gray-700/80 text-gray-400 border-gray-600'],
                    };
                @endphp
                <div class="absolute top-20 right-4 sm:right-6 lg:right-8 flex justify-end">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border {{ $statusConfig['classes'] }}">
                        <span class="size-2 rounded-full bg-current shrink-0 me-2" aria-hidden="true"></span>
                        {{ $statusConfig['label'] }}
                    </span>
                </div>
            @endif

            {{-- Hero --}}
            <div class="text-center mb-20">
                <p class="text-sm font-medium text-gray-400 mb-4 uppercase tracking-wider">Εμπιστευτικό Έγγραφο</p>
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4 text-white leading-tight">
                    Πρόταση Υλοποίησης<br>
                    AI Customer Support Assistant
                </h1>
                <p class="text-xl text-gray-400">
                    για Εταιρεία Courier · Pack-Man
                </p>
            </div>

            {{-- Part 1 --}}
            <div class="mb-20">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-12">
                    ΜΕΡΟΣ 1 – Παρουσίαση & Περιγραφή Project
                </h2>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">1.1 Τι είναι το Project</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Το παρόν project αφορά τον σχεδιασμό και την υλοποίηση ενός <strong class="text-white">AI Customer Support Assistant</strong>, ειδικά προσαρμοσμένου στις επιχειρησιακές ανάγκες της εταιρείας courier Pack-Man.
                    </p>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Ο Agent δεν λειτουργεί ως απλό chatbot ενημέρωσης. Λειτουργεί ως <strong class="text-white">ψηφιακός operator</strong>, ο οποίος:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>αποτελεί το πρώτο και βασικό σημείο εξυπηρέτησης</li>
                        <li>εκτελεί πραγματικές ενέργειες στα συστήματα της εταιρείας</li>
                        <li>ολοκληρώνει αιτήματα end-to-end</li>
                        <li>κλείνει κάθε υπόθεση με σαφή κατάληξη</li>
                    </ul>
                    <p class="text-gray-300 leading-relaxed">
                        Η προσέγγιση αυτή μετατοπίζει το customer support από μοντέλο επικοινωνίας σε μοντέλο εκτέλεσης.
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">1.2 Ταυτότητα, Χαρακτήρας & Ρόλος του AI Agent</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Ο AI Agent θα διαθέτει συγκεκριμένο χαρακτήρα και μορφή, πλήρως ευθυγραμμισμένα με την εταιρική ταυτότητα της Pack-Man.
                    </p>
                    <p class="text-gray-300 mb-2 leading-relaxed"><strong class="text-white">Συγκεκριμένα:</strong></p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>θα χρησιμοποιεί ως οπτική αναφορά το λογότυπο της Pack-Man, όπως εμφανίζεται στο επίσημο site https://pack-man.gr</li>
                        <li>θα έχει φιλικό, σαφή και επαγγελματικό τόνο</li>
                        <li>θα λειτουργεί ως οικείο ψηφιακό σημείο επαφής για τον πελάτη</li>
                    </ul>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Παράλληλα, ο Agent θα έχει χαρτογραφημένο το σύνολο του περιεχομένου του site της Pack-Man (υπηρεσίες, συνεργασίες, δυνατότητες, διαδικασίες), ώστε:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>να απαντά άμεσα σε οποιαδήποτε ερώτηση αφορά την εταιρεία</li>
                        <li>να λειτουργεί ως ενιαίο σημείο πληροφόρησης</li>
                        <li>να μη χρειάζεται ο χρήστης να περιηγηθεί σε πολλές σελίδες</li>
                    </ul>
                    <p class="text-gray-300 leading-relaxed">
                        Η επιλογή αυτή είναι κρίσιμη, καθώς σε αντίστοιχα websites περίπου το 85% των επισκεπτών δεν πραγματοποιεί ουσιαστική περιήγηση. Ο Agent συγκεντρώνει την πληροφορία σε ένα σημείο, αυξάνοντας την εμπιστοσύνη και την πιθανότητα μετατροπής του επισκέπτη σε πελάτη.
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">1.3 Τι θα κάνει ο AI Agent</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Ο Agent, μέσω του website της Pack-Man, θα μπορεί να:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>αναγνωρίζει το αίτημα του πελάτη (intent)</li>
                        <li>συλλέγει μόνο τα απολύτως απαραίτητα στοιχεία (π.χ. αριθμό αποστολής)</li>
                        <li>διασυνδέεται με τα επιχειρησιακά συστήματα</li>
                        <li>εκτελεί αναγνώσεις, αλλαγές ή καταχωρήσεις</li>
                        <li>παρέχει σαφή και τελική απάντηση</li>
                    </ul>
                    <p class="text-gray-300 leading-relaxed">
                        Ο Agent δεν «συζητά» και δεν αφήνει αιτήματα ανοικτά. <strong class="text-white">Εκτελεί και ολοκληρώνει.</strong>
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">1.4 Πώς θα λειτουργεί</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Κάθε αίτημα ακολουθεί σταθερή λειτουργική ροή:
                    </p>
                    <ol class="list-decimal list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>Αναγνώριση intent</li>
                        <li>Συλλογή απαραίτητων στοιχείων</li>
                        <li>Εκτέλεση ενέργειας (read / write / status change)</li>
                        <li>Ενημέρωση πελάτη</li>
                        <li>Κλείσιμο αιτήματος και καταγραφή (logging)</li>
                    </ol>
                    <p class="text-gray-300 mb-8 leading-relaxed">
                        Ο πελάτης γνωρίζει τι έγινε και τι ισχύει από εδώ και πέρα, χωρίς να απαιτείται επόμενη επικοινωνία με άνθρωπο.
                    </p>

                    <h4 class="text-lg font-bold text-white mb-4">Ρόλος Τηλεφωνητή (IVR Redirect)</h4>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Παράλληλα με τη λειτουργία του AI Agent στο website, ενεργοποιείται αυτόματος τηλεφωνητής στις εισερχόμενες κλήσεις, ο οποίος καθοδηγεί τον πελάτη στο βασικό κανάλι εξυπηρέτησης (site).
                    </p>
                    <p class="text-gray-300 mb-2 leading-relaxed"><strong class="text-white">Ενδεικτικό κείμενο τηλεφωνητή:</strong></p>
                    <blockquote class="border-l-4 border-gray-600 pl-4 italic text-gray-300 mb-8">
                        «Σας ευχαριστούμε που καλέσατε την Pack-Man. Για άμεση ενημέρωση σχετικά με την αποστολή σας, αλλαγές παράδοσης ή οποιαδήποτε άλλη πληροφορία, επισκεφθείτε το pack-man.gr και συνομιλήστε με τον Pack-Man, τη νέα ψηφιακή μας υπηρεσία εξυπηρέτησης. Εκεί μπορείτε να εξυπηρετηθείτε άμεσα, εύκολα και χωρίς αναμονή. Σας ευχαριστούμε.»
                    </blockquote>

                    {{-- Demo Link --}}
                    <div class="pt-8 border-t border-gray-800">
                        <h4 class="text-lg font-bold text-white mb-4">1.4.1 Προσομοίωση Πραγματικών Σεναρίων Εξυπηρέτησης (Live Operational Simulation)</h4>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Στο πλαίσιο της παρούσας πρότασης, έχει δημιουργηθεί ενδεικτικό περιβάλλον προσομοίωσης, το οποίο αποτυπώνει με ρεαλιστικό τρόπο τη λειτουργία του AI Customer Support Assistant σε πραγματικές συνθήκες.
                        </p>
                        <p class="text-gray-300 mb-2 leading-relaxed">Η προσομοίωση δεν αποτελεί απλό demo ή concept. Παρουσιάζει:</p>
                        <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                            <li>τον τρόπο με τον οποίο ο Agent συνομιλεί με τον πελάτη</li>
                            <li>πώς αναγνωρίζει διαφορετικά αιτήματα</li>
                            <li>πώς μεταβαίνει από πληροφοριακές ερωτήσεις σε επιχειρησιακές ενέργειες</li>
                            <li>πώς κλείνει κάθε υπόθεση με σαφή κατάληξη</li>
                        </ul>
                        <p class="text-gray-300 mb-2 leading-relaxed">Στο περιβάλλον αυτό αποτυπώνονται ρεαλιστικά σενάρια εξυπηρέτησης, όπως:</p>
                        <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                            <li>αναζήτηση αποστολής</li>
                            <li>αλλαγή στοιχείων παράδοσης</li>
                            <li>ερωτήσεις για υπηρεσίες και τιμολόγηση</li>
                            <li>αναφορά προβλήματος ή φθοράς</li>
                            <li>μετάβαση από AI εξυπηρέτηση σε ανθρώπινη παρέμβαση όπου απαιτείται</li>
                        </ul>
                        <p class="text-gray-300 mb-6 leading-relaxed">
                            Στόχος της προσομοίωσης είναι να παρέχει βιωματική και κατανοητή εικόνα του τρόπου με τον οποίο ο Agent θα λειτουργεί στο πραγματικό περιβάλλον της Pack-Man, πριν τη διασύνδεση με τα παραγωγικά συστήματα.
                        </p>
                        <a href="{{ route('proposals.demo', ['proposal' => $proposal->company_name, 'secret' => $secret]) }}"
                           class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-600/80 to-violet-600/80 backdrop-blur-sm rounded-lg hover:from-blue-600 hover:to-violet-600 hover:border-blue-400/50 hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-blue-500/20 hover:shadow-xl hover:shadow-blue-500/30 cursor-pointer">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Προβολή Live Demo
                        </a>
                    </div>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">1.5 Γιατί είναι απαραίτητο</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">Στον κλάδο των courier:</p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>η πλειονότητα των αιτημάτων είναι επαναλαμβανόμενη</li>
                        <li>το τηλεφωνικό κέντρο δεν κλιμακώνεται γραμμικά</li>
                        <li>η εμπειρία πελάτη επηρεάζεται άμεσα από τον χρόνο απόκρισης</li>
                    </ul>
                    <p class="text-gray-300 leading-relaxed">
                        Ο AI Agent αντιμετωπίζει αυτά τα ζητήματα <strong class="text-white">δομικά και μόνιμα</strong>, όχι αποσπασματικά.
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">1.6 Προσδοκώμενα Αποτελέσματα & Οικονομικά Οφέλη</h3>
                    <p class="text-gray-300 mb-2 leading-relaxed"><strong class="text-white">Λειτουργικά αποτελέσματα:</strong></p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>≥60% μείωση τηλεφωνικών κλήσεων στους πρώτους μήνες λειτουργίας</li>
                        <li>στόχος: εντός 6 μηνών από την εγκατάσταση, κάλυψη και εξυπηρέτηση έως και του 90% των τηλεφωνικών αιτημάτων</li>
                        <li>σημαντική βελτίωση χρόνων απόκρισης και εμπειρίας πελάτη</li>
                        <li>αυξημένος έλεγχος και διαφάνεια των εσωτερικών ροών</li>
                    </ul>
                    <p class="text-gray-300 mb-2 leading-relaxed"><strong class="text-white">Οικονομικά οφέλη (ενδεικτικά):</strong></p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>μείωση κόστους εξυπηρέτησης πελατών κατά 40%–55%</li>
                        <li>αύξηση παραγωγικότητας ανθρώπινου δυναμικού κατά 30%–40%</li>
                        <li>έμμεση αύξηση εσόδων μέσω βελτιωμένης διατήρησης πελατών και περιορισμού παραπόνων</li>
                    </ul>
                    <p class="text-gray-300 leading-relaxed">
                        Η έμφαση μετατοπίζεται από τη διαχείριση κόστους στη δημιουργία καθαρού επιχειρησιακού κέρδους.
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">1.7 Μελλοντική Κλιμάκωση</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Η αρχιτεκτονική του Agent επιτρέπει μελλοντικά:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
                        <li>έλεγχο και επαναδημιουργία δρομολογίων οδηγών, δυναμική ανακατανομή φορτίων</li>
                        <li>διαχείριση αποθήκης</li>
                        <li>υποστήριξη τιμολόγησης και οικονομικών ροών</li>
                        <li>multi-agent σύστημα για operational λειτουργίες</li>
                    </ul>
                </div>
            </div>

            {{-- Part 2 --}}
            <div class="mb-20">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-12">
                    ΜΕΡΟΣ 2 – Τεχνική Μελέτη & Υλοποίηση
                </h2>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">2.0 Ψηφιακή Ταυτότητα & Knowledge Mapping</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Ο AI Agent θα εκπαιδευτεί πάνω στο περιεχόμενο του site pack-man.gr, συμπεριλαμβανομένων υπηρεσιών, συνεργασιών, πολιτικών και διαδικασιών.
                    </p>
                    <p class="text-gray-300 mt-4 leading-relaxed">
                        Η γνώση αυτή λειτουργεί συμπληρωματικά με τα ERP δεδομένα και επιτρέπει στον Agent να λειτουργεί ως ψηφιακός σύμβουλος της Pack-Man, χωρίς να απαιτείται περιήγηση στο site.
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">2.1 Αρχιτεκτονική Συστήματος</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Η λύση βασίζεται σε πολυεπίπεδη αρχιτεκτονική:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>Chat UI στο website</li>
                        <li>AI Agent (LLM + business logic)</li>
                        <li>Integration Layer (API wrapper)</li>
                        <li>ERP σύστημα (Pegasus)</li>
                        <li>Logging & monitoring</li>
                    </ul>
                    <p class="text-gray-300 leading-relaxed">
                        Ο Agent <strong class="text-white">δεν</strong> επικοινωνεί απευθείας με το ERP. Όλη η επικοινωνία γίνεται μέσω ελεγχόμενου integration layer.
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">2.2 Τι απαιτείται από την Pack-Man</h3>
                    <ul class="list-disc list-inside space-y-1 text-gray-300">
                        <li>Πρόσβαση ή τεκμηρίωση ERP APIs</li>
                        <li>Test / staging περιβάλλον (εφόσον υπάρχει)</li>
                        <li>Τεχνικός υπεύθυνος για συντονισμό</li>
                        <li>Έγκριση ροών και πολιτικών εξυπηρέτησης</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">2.3 Χρονοδιάγραμμα</h3>
                    <ul class="list-none space-y-2 text-gray-300">
                        <li><strong class="text-white">Συνολική διάρκεια:</strong> 25 ημέρες</li>
                        <li><strong class="text-white">Ημέρες 1–20:</strong> Ανάλυση, ανάπτυξη, διασυνδέσεις</li>
                        <li><strong class="text-white">Ημέρες 21–25:</strong> Live testing μετά την τελική παράδοση</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">2.4 Παραδοτέα</h3>
                    <ul class="list-disc list-inside space-y-1 text-gray-300">
                        <li>AI Assistant σε παραγωγικό περιβάλλον</li>
                        <li>Διασύνδεση με ERP</li>
                        <li>Τεκμηρίωση λειτουργίας</li>
                        <li>Σύστημα logging & monitoring</li>
                        <li>Pilot / live testing phase</li>
                    </ul>
                </div>
            </div>

            {{-- Part 3 --}}
            <div class="mb-20">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-12">
                    ΜΕΡΟΣ 3 – Οικονομική Πρόταση & Όροι Συνεργασίας
                </h2>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">3.1 Κόστος Υλοποίησης</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        <strong class="text-white">Δεν προβλέπεται χρέωση</strong> για την υλοποίηση του project.
                    </p>
                    <p class="text-gray-300 leading-relaxed">
                        Η πρόταση εντάσσεται στη στρατηγική της Noctua Core να επενδύει σε επιλεγμένες, υγιείς και βιώσιμες συνεργασίες, δημιουργώντας αποδείξεις αξίας και ισχυρά case studies.
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">3.2 Όροι Συνεργασίας & Marketing</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Στο πλαίσιο της συνεργασίας συμφωνείται:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
                        <li>χρήση του λογοτύπου και της συνεργασίας με την Pack-Man</li>
                        <li>αναφορά στο site της Noctua Core</li>
                        <li>παρουσίαση σε social media και διαφημιστικό υλικό</li>
                        <li>χρήση της συνεργασίας ως επίσημο showcase</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">3.3 Συνδρομή Μετά τη Σταθερή Λειτουργία</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Μετά την απρόσκοπτη και επιτυχή λειτουργία διάρκειας <strong class="text-white">τεσσάρων (4) μηνών</strong> του AI Agent:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
                        <li>υπογράφεται σύμβαση συνεργασίας 1 έτους</li>
                        <li>μηνιαία συνδρομή: <strong class="text-white">150€</strong></li>
                        <li>η συνδρομή καλύπτει αποκλειστικά πάγια λειτουργικά έξοδα</li>
                    </ul>
                    <p class="text-gray-300 leading-relaxed">
                        Η πραγματική αξία του project ανέρχεται ενδεικτικά σε <strong class="text-white">10.000€–15.000€</strong>. Η παρούσα πρόταση αποτελεί στοχευμένη marketing επένδυση.
                    </p>
                </div>
            </div>

            {{-- Confidentiality --}}
            <div class="mb-20">
                <h3 class="text-xl font-bold text-white mb-4">Πλαίσιο Εμπιστευτικότητας & Τελικό Σχόλιο</h3>
                <p class="text-gray-300 leading-relaxed">
                    Κατά την αποδοχή της παρούσας και την υπογραφή της σχετικής συμφωνίας, θα ενσωματωθεί ρητό πλαίσιο τήρησης εμπιστευτικότητας <strong class="text-white">(NDA)</strong> μεταξύ των δύο μερών, που θα καλύπτει τεχνικές, επιχειρησιακές και εμπορικές πληροφορίες.
                </p>
                <p class="text-gray-300 mt-4 leading-relaxed">
                    Η πρόταση αυτή αφορά ουσιαστική μετάβαση σε νέο μοντέλο εξυπηρέτησης πελατών, με μετρήσιμα επιχειρησιακά και οικονομικά οφέλη.
                </p>
            </div>

            {{-- Technical Annex --}}
            <div class="mb-20">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-12">
                    ΤΕΧΝΙΚΟ ANNEX – Για IT / ERP Υπεύθυνους
                </h2>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">A. Σκοπός Annex</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Το παρόν annex περιγράφει τη λογική διασύνδεσης του AI Agent με το ERP, τα επιχειρησιακά endpoints και τη συνολική αρχιτεκτονική.
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">A1. Διάγραμμα Αρχιτεκτονικής (High-Level)</h3>
                    <pre class="bg-gray-900/50 rounded-lg p-6 font-mono text-sm text-gray-400 overflow-x-auto border border-gray-800 whitespace-pre">[ Τελικός Χρήστης ]
        |
        v
[ Website Pack-Man ]
        |
        v
[ Chat UI (Pack-Man Persona) ]
        |
        v
[ AI Agent ]
        | |
        | +--> [ Knowledge Base (pack-man.gr content) ]
        |
        +--> [ Integration Layer / API Wrapper ]
        |
        v
[ Pegasus ERP ]
        |
        v
[ Operational Data ]</pre>
                    <p class="text-gray-500 mt-4 italic text-sm">
                        (Όλες οι ενέργειες καταγράφονται στο Logging & Monitoring Layer)
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">B. Ρόλος Integration Layer</h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">Το Integration Layer:</p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
                        <li>λειτουργεί ως μοναδικό σημείο επικοινωνίας με το ERP</li>
                        <li>ελέγχει permissions και validation</li>
                        <li>καταγράφει όλα τα requests</li>
                        <li>αποτρέπει απευθείας πρόσβαση του Agent στο ERP</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">C. Χαρτογράφηση Customer Intents σε ERP Endpoints</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-gray-300 border border-gray-800">
                            <thead>
                                <tr class="border-b border-gray-800">
                                    <th class="px-4 py-3 text-left text-white font-medium">Intent</th>
                                    <th class="px-4 py-3 text-left text-white font-medium">Endpoint</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-800"><td class="px-4 py-2">Tracking / Κατάσταση Αποστολής</td><td class="px-4 py-2 font-mono">GET /api/courier00/r18/{id}</td></tr>
                                <tr class="border-b border-gray-800"><td class="px-4 py-2">Αλλαγή Ημερομηνίας / Ώρας Παράδοσης</td><td class="px-4 py-2 font-mono">PUT /api/courier00/r18/{id}</td></tr>
                                <tr class="border-b border-gray-800"><td class="px-4 py-2">Αντικαταβολή / Πληρωμές</td><td class="px-4 py-2 font-mono">GET /api/courier00/r18/{id}</td></tr>
                                <tr class="border-b border-gray-800"><td class="px-4 py-2">Οδηγίες προς Οδηγό</td><td class="px-4 py-2 font-mono">PUT /api/courier00/r18/{id}</td></tr>
                                <tr class="border-b border-gray-800"><td class="px-4 py-2">Επαναπρογραμματισμός Παράδοσης</td><td class="px-4 py-2 font-mono">POST /api/courier00/change_status</td></tr>
                                <tr><td class="px-4 py-2">Καθυστέρηση / Εσωτερικές Καταστάσεις</td><td class="px-4 py-2 font-mono">GET /api/courier00/r18/all</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-bold text-white mb-4">D. Logging & Ασφάλεια</h3>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
                        <li>Κάθε ενέργεια καταγράφεται με <strong class="text-white">timestamp</strong>, <strong class="text-white">request ID</strong> και <strong class="text-white">audit trail</strong>.</li>
                        <li>Ο Agent <strong class="text-white">δεν έχει</strong> άμεση γνώση ERP credentials. Όλη η διαχείριση γίνεται server-side, με περιορισμένα scopes.</li>
                    </ul>
                </div>
            </div>

            {{-- Δήλωση Αποδοχής --}}
            @if(strtolower($proposal->status ?? '') !== 'accepted')
                <div class="mb-20 p-8 rounded-lg border border-gray-700 bg-gray-800/30">
                    <h3 class="text-xl font-bold text-white mb-6">Δήλωση Αποδοχής</h3>
                    <form action="{{ route('proposals.accept', ['proposal' => $proposal->company_name]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="secret" value="{{ $secret }}">
                        <label class="flex items-start gap-4 cursor-pointer group mb-6">
                            <input type="checkbox"
                                   name="acceptance"
                                   value="1"
                                   x-model="acceptanceChecked"
                                   class="mt-1 size-5 rounded border-gray-600 bg-gray-800 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-900">
                            <span class="text-gray-300 leading-relaxed group-hover:text-gray-200 transition-colors">
                                Αποδέχομαι την παρούσα πρόταση και το πλαίσιο εμπιστευτικότητας μεταξύ των δύο μερών.
                            </span>
                        </label>
                        <button type="submit"
                                :disabled="!acceptanceChecked"
                                class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-600/80 to-violet-600/80 backdrop-blur-sm rounded-lg hover:from-blue-600 hover:to-violet-600 hover:border-blue-400/50 hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-blue-500/20 hover:shadow-xl hover:shadow-blue-500/30 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 cursor-pointer">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Αποδέχομαι την πρόταση
                        </button>
                    </form>
                </div>
            @else
                <div class="mb-20 p-8 rounded-lg border border-emerald-500/30 bg-emerald-950/20">
                    <p class="text-emerald-200 font-medium flex items-center gap-2">
                        <svg class="size-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Η πρόταση έχει ήδη αποδεχθεί.
                    </p>
                </div>
            @endif

            {{-- Footer --}}
            <footer class="pt-12 border-t border-gray-800">
                <p class="text-gray-500 text-sm text-center">
                    © {{ date('Y') }} Noctua Core – Elias Kalyvas Learning & Development · Εμπιστευτικό Έγγραφο – Μη Διανομή
                </p>
            </footer>
        </div>
    </div>
</div>
@endsection
