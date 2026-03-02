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
		 class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 overflow-y-auto overflow-x-hidden"
		 style="display: none;">
		<div class="absolute inset-0 bg-gray-950/50 backdrop-blur-sm" @click.away=""></div>

		<div class="relative bg-gray-900 rounded-lg border border-gray-700 shadow-2xl max-w-2xl w-full min-w-0 max-h-[calc(100dvh-1.5rem)] md:max-h-none overflow-y-auto p-4 sm:p-6 md:p-10"
			 x-transition:enter="transition ease-out duration-300"
			 x-transition:enter-start="opacity-0 scale-95"
			 x-transition:enter-end="opacity-100 scale-100"
			 x-transition:leave="transition ease-in duration-200"
			 x-transition:leave-start="opacity-100 scale-100"
			 x-transition:leave-end="opacity-0 scale-95">
			<div class="text-center mb-4 sm:mb-6">
				<h2 class="text-xl sm:text-2xl font-bold text-white mb-2">Εμπιστευτικό Έγγραφο</h2>
				<p class="text-sm sm:text-base text-gray-400">Παρακαλούμε διαβάστε και αποδεχτείτε τους όρους</p>
			</div>

			<div class="bg-gray-800/50 rounded-lg p-4 sm:p-6 mb-6 border border-gray-700 overflow-hidden">
				<p class="text-gray-300 leading-relaxed mb-4 break-words hyphens-auto">
					Η παρούσα μελέτη αποτελεί εμπιστευτικό έγγραφο. Δεν επιτρέπεται η αναπαραγωγή, διανομή ή μεταβίβαση, εν όλω ή εν μέρει, σε οποιοδήποτε τρίτο πρόσωπο ή εταιρεία, πέραν των αρμοδίων στελεχών της εταιρείας για την οποία και έχει αποκλειστικά δημιουργηθεί. Τα πνευματικά δικαιώματα της παρούσας μελέτης ανήκουν στη <strong class="text-white">Noctua Core – Elias Kalyvas Learning & Development</strong>.
				</p>
			</div>

			<div class="flex flex-col sm:flex-row gap-3 sm:gap-4 min-w-0">
				<button @click="window.location.href = '{{ route('home') }}'"
						class="flex-1 min-w-0 px-5 py-3 sm:px-10 sm:py-4 text-base sm:text-lg font-semibold text-gray-300 bg-gray-800 rounded-lg hover:bg-gray-700 transition-all duration-200 border border-gray-700 cursor-pointer text-center">
					Απόρριψη
				</button>
				<button @click="accepting = true; fetch('{{ route('proposals.accept-terms', ['proposal' => $proposal->company_name]) }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }, body: JSON.stringify({ secret: '{{ $secret }}' }) }).then(() => { $dispatch('terms-accepted'); }).catch(() => { accepting = false; alert('Σφάλμα κατά την αποδοχή. Παρακαλώ δοκιμάστε ξανά.'); })"
						:disabled="accepting"
						class="flex-1 min-w-0 px-5 py-3 sm:px-10 sm:py-4 text-base sm:text-lg font-semibold text-white bg-gradient-to-r from-blue-600/80 to-violet-600/80 backdrop-blur-sm rounded-lg hover:from-blue-600 hover:to-violet-600 hover:border-blue-400/50 sm:hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-blue-500/20 hover:shadow-xl hover:shadow-blue-500/30 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 cursor-pointer text-center">
					<span class="sm:whitespace-nowrap" x-show="!accepting">Αποδέχομαι τους Όρους</span>
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
		 class="fixed top-20 sm:top-25 left-1/2 -translate-x-1/2 z-50 w-[min(340px,calc(100vw-2rem))] sm:w-auto sm:min-w-0 px-5 py-4 sm:px-6 rounded-lg border border-emerald-500/50 bg-emerald-950/95 backdrop-blur-sm shadow-lg shadow-emerald-500/20"
		 style="display: none;">
		<p class="text-emerald-100 font-medium flex items-center gap-2 text-sm sm:text-base">
			<svg class="size-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
			</svg>
			Σας ευχαριστούμε για την εμπιστοσύνη σας, θα επικοινωνήσουμε σύντομα μαζί σας!
		</p>
	</div>

	<div class="relative min-h-screen overflow-hidden">
		<div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-blue-950 to-violet-950 opacity-50"></div>
		<div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl animate-pulse"></div>
		<div class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-600/10 rounded-full blur-3xl animate-pulse delay-1000"></div>

		<div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-24">
			@if($proposal->status)
				@php
					$statusConfig = match (strtolower($proposal->status)) {
						'under_consideration' => ['label' => 'Υπό Εξέταση', 'classes' => 'bg-blue-600/20 text-blue-300 border-blue-500/50'],
						'accepted' => ['label' => 'Αποδοχή', 'classes' => 'bg-emerald-600/20 text-emerald-300 border-emerald-500/50'],
						default => ['label' => $proposal->status, 'classes' => 'bg-gray-700/80 text-gray-400 border-gray-600'],
					};
				@endphp
				<div class="absolute top-20 right-4 sm:right-6 lg:right-8 flex justify-end max-sm:hidden">
					<span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border {{ $statusConfig['classes'] }}">
						<span class="size-2 rounded-full bg-current shrink-0 me-2" aria-hidden="true"></span>
						{{ $statusConfig['label'] }}
					</span>
				</div>
			@endif

			<div class="text-center mb-20">
				@if($proposal->status ?? false)
					<div class="flex justify-center mb-4 sm:hidden">
						<span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border {{ $statusConfig['classes'] }}">
							<span class="size-2 rounded-full bg-current shrink-0 me-2" aria-hidden="true"></span>
							{{ $statusConfig['label'] }}
						</span>
					</div>
				@endif
				<p class="text-sm font-medium text-gray-400 mb-4 uppercase tracking-wider">Οικονομική & Τεχνική Μελέτη</p>
				<h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4 text-white leading-tight">
					Ανάπτυξη Ευέλικτου E‑Shop<br>
					σε Shopify
				</h1>
				<p class="text-xl text-gray-400">
					Πρόταση υλοποίησης από τη Noctua Core
				</p>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">1. Ποιοι Είμαστε</h2>
				<p class="text-gray-300 mb-4 leading-relaxed">
					Η <strong class="text-white">Noctua Core</strong> είναι μια δυναμικά αναπτυσσόμενη startup που εξειδικεύεται στον σχεδιασμό και την υλοποίηση <strong class="text-white">AI Agents για επιχειρήσεις</strong>.
				</p>
				<p class="text-gray-300 mb-4 leading-relaxed">
					Εστιάζουμε στη δημιουργία πρακτικών εφαρμογών τεχνητής νοημοσύνης που ενσωματώνονται στις πραγματικές λειτουργίες μιας επιχείρησης — από την εξυπηρέτηση πελατών και τις πωλήσεις έως την επιχειρησιακή αυτοματοποίηση.
				</p>
				<p class="text-gray-300 mb-8 leading-relaxed">
					Η προσέγγισή μας δεν βασίζεται σε θεωρητικές λύσεις, αλλά σε <strong class="text-white">λειτουργικά συστήματα που παράγουν μετρήσιμη αξία</strong>.
				</p>

				<h3 class="text-xl font-bold text-white mb-4">Η φιλοσοφία συνεργασίας μας</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
					<li>Δεν υπάρχουν ψιλά γράμματα ή κρυφές χρεώσεις</li>
					<li>Δεν χρεώνουμε με την ώρα</li>
					<li>Κάθε έργο αξιολογείται συνολικά και κοστολογείται ως ολοκληρωμένο project</li>
					<li>Ο πελάτης γνωρίζει εξαρχής το εύρος, το κόστος και το αποτέλεσμα</li>
				</ul>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">2. Επιχειρησιακή Κατανόηση του Έργου</h2>
				<p class="text-gray-300 mb-4 leading-relaxed">Με βάση τη συζήτηση, το προτεινόμενο e‑shop έχει ως στόχο:</p>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-6">
					<li>την ευέλικτη διάθεση προϊόντων που αποκτώνται ευκαιριακά</li>
					<li>τη γρήγορη εισαγωγή νέου αποθέματος</li>
					<li>την απλή καθημερινή διαχείριση</li>
					<li>τη δυνατότητα κλιμάκωσης χωρίς τεχνική επιβάρυνση</li>
				</ul>
				<p class="text-gray-300 mb-4 leading-relaxed">Το μοντέλο αυτό απαιτεί πλατφόρμα που να δίνει:</p>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
					<li>ταχύτητα</li>
					<li>σταθερότητα</li>
					<li>χαμηλή συντήρηση</li>
					<li>καθαρή εμπειρία χρήστη</li>
				</ul>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">3. Επιλογή Πλατφόρμας — Γιατί Shopify</h2>
				<p class="text-gray-300 mb-4 leading-relaxed">
					Το Shopify αποτελεί μία από τις πλέον ώριμες πλατφόρμες ηλεκτρονικού εμπορίου παγκοσμίως, προσφέροντας πλήρως διαχειριζόμενο περιβάλλον (fully managed SaaS).
				</p>

				<h3 class="text-xl font-bold text-white mb-4">Βασικά πλεονεκτήματα</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-8">
					<li>Ενσωματωμένο cloud hosting υψηλής διαθεσιμότητας</li>
					<li>Αυτόματη κλιμάκωση χωρίς ανάγκη server management</li>
					<li>Δωρεάν SSL και ενισχυμένη ασφάλεια</li>
					<li>Πολύ καλή απόδοση σε κινητές συσκευές</li>
					<li>Εύκολη διαχείριση προϊόντων</li>
					<li>Ενσωματωμένα εργαλεία AI (Shopify Magic & Sidekick)</li>
				</ul>

				<h3 class="text-xl font-bold text-white mb-4">3.1 Συνδρομές Shopify & Προτεινόμενο Πλάνο</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
					<li>Basic Shopify – περίπου 39 $/μήνα</li>
					<li>Shopify (mid plan) – περίπου 105 $/μήνα</li>
					<li>Advanced Shopify – περίπου 399 $/μήνα</li>
				</ul>
				<p class="text-gray-500 italic text-sm mb-8">Οι τιμές ενδέχεται να διαφοροποιούνται ανά αγορά ή προσφορές της πλατφόρμας.</p>

				<h3 class="text-xl font-bold text-white mb-4">Πρότασή μας</h3>
				<p class="text-gray-300 mb-4 leading-relaxed">Για τη συγκεκριμένη φάση προτείνουμε την έναρξη με το <strong class="text-white">Basic Shopify</strong>, καθώς:</p>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
					<li>καλύπτει πλήρως τις λειτουργικές ανάγκες του έργου</li>
					<li>προσφέρει υψηλή σταθερότητα και ταχύτητα</li>
					<li>επιτρέπει εύκολη μελλοντική αναβάθμιση</li>
					<li>διατηρεί χαμηλό λειτουργικό κόστος</li>
				</ul>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">4. Τεχνική Αρχιτεκτονική E‑Shop</h2>

				<h3 class="text-xl font-bold text-white mb-4">4.1 Υποδομή Hosting</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-8">
					<li>Cloud hosting μέσω Shopify</li>
					<li>Παγκόσμιο CDN</li>
					<li>Αυτόματη κλιμάκωση</li>
					<li>Δωρεάν SSL/TLS</li>
					<li>Υψηλή διαθεσιμότητα</li>
				</ul>

				<h3 class="text-xl font-bold text-white mb-4">4.2 Domain</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-8">
					<li>Σύνδεση υπάρχοντος domain</li>
					<li>Καθοδήγηση για αγορά νέου domain</li>
					<li>Δυνατότητα απευθείας αγοράς domain μέσα από το Shopify</li>
					<li>Πλήρης ρύθμιση DNS</li>
				</ul>

				<h3 class="text-xl font-bold text-white mb-4">4.3 Ασφάλεια</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-8">
					<li>HTTPS σε όλο το κατάστημα</li>
					<li>Managed security από Shopify</li>
					<li>Συμβατότητα με σύγχρονες πρακτικές e‑commerce</li>
				</ul>

				<h3 class="text-xl font-bold text-white mb-4">4.4 Περιβάλλον Διαχείρισης</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
					<li>εύκολη εισαγωγή προϊόντων</li>
					<li>διαχείριση παραγγελιών</li>
					<li>βασικά analytics</li>
					<li>εργαλεία AI υποστήριξης</li>
				</ul>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">5. Δομή & Λειτουργίες Καταστήματος</h2>

				<h3 class="text-xl font-bold text-white mb-4">Ενδεικτικό Sitemap</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-8">
					<li>Αρχική Σελίδα</li>
					<li>Κατηγορίες / Collections</li>
					<li>Σελίδες Προϊόντων</li>
					<li>Καλάθι & Checkout</li>
					<li>Σχετικά με Εμάς</li>
					<li>Επικοινωνία</li>
					<li>Πολιτικές (Αποστολές, Επιστροφές, GDPR)</li>
				</ul>

				<p class="text-gray-400 mb-8 leading-relaxed">Σημείωση: Δεν υπάρχει τεχνικός περιορισμός στον αριθμό σελίδων που μπορούν να δημιουργηθούν στην πλατφόρμα.</p>

				<h3 class="text-xl font-bold text-white mb-4">Βασικές Λειτουργίες</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-8">
					<li>Responsive σχεδιασμός</li>
					<li>Βελτιστοποιημένη ταχύτητα φόρτωσης</li>
					<li>Καθαρό mobile UX</li>
					<li>Βασική SEO δομή</li>
					<li>Ρυθμίσεις πληρωμών και αποστολών</li>
				</ul>

				<h3 class="text-xl font-bold text-white mb-4">5.1 Σχεδιαστική Προσέγγιση</h3>
				<p class="text-gray-300 leading-relaxed">
					Κατά την πρώτη φάση υλοποίησης θα παρουσιαστούν <strong class="text-white">τρία (3) εναλλακτικά σχεδιαστικά πλαίσια</strong> (themes/layout directions), ώστε να επιλέξετε το ύφος που ταιριάζει καλύτερα στην εμπορική σας στρατηγική.
				</p>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">6. AI‑Ready Υποδομή</h2>
				<p class="text-gray-300 mb-4 leading-relaxed">
					Η υλοποίηση θα βασιστεί σε αρχιτεκτονική που επιτρέπει σταδιακή ενσωμάτωση τεχνητής νοημοσύνης.
				</p>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-4">
					<li>Αξιοποίηση Shopify Magic</li>
					<li>Υποστήριξη Sidekick AI</li>
					<li>Δομή έτοιμη για μελλοντικό AI assistant</li>
					<li>Βάση για αυτοματισμούς marketing και εξυπηρέτησης</li>
				</ul>
				<p class="text-gray-300 leading-relaxed">
					Η προσέγγιση παραμένει ελαφριά ώστε να μη θυσιάζεται η απόδοση του καταστήματος.
				</p>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">7. Συγκριτικός Πίνακας</h2>
				<h3 class="text-xl font-bold text-white mb-4">Shopify vs WooCommerce</h3>
				<div class="overflow-x-auto">
					<table class="w-full text-sm text-gray-300 border border-gray-800">
						<thead>
							<tr class="border-b border-gray-800">
								<th class="px-4 py-3 text-left text-white font-medium">Κριτήριο</th>
								<th class="px-4 py-3 text-left text-white font-medium">Shopify</th>
								<th class="px-4 py-3 text-left text-white font-medium">WooCommerce</th>
							</tr>
						</thead>
						<tbody>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Hosting</td><td class="px-4 py-2">Ενσωματωμένο</td><td class="px-4 py-2">Απαιτείται εξωτερικό</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Συντήρηση</td><td class="px-4 py-2">Ελάχιστη</td><td class="px-4 py-2">Συχνές ενημερώσεις</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Ταχύτητα</td><td class="px-4 py-2">Προβλέψιμη</td><td class="px-4 py-2">Εξαρτάται από server</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Ασφάλεια</td><td class="px-4 py-2">Managed</td><td class="px-4 py-2">Ευθύνη ιδιοκτήτη</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Plugins</td><td class="px-4 py-2">Ελεγχόμενο οικοσύστημα</td><td class="px-4 py-2">Μεγάλη εξάρτηση</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Κλιμάκωση</td><td class="px-4 py-2">Αυτόματη</td><td class="px-4 py-2">Χειροκίνητη</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">AI εργαλεία</td><td class="px-4 py-2">Ενσωματωμένα</td><td class="px-4 py-2">Μέσω τρίτων</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Χρόνος διαχείρισης</td><td class="px-4 py-2">Χαμηλός</td><td class="px-4 py-2">Μεσαίος–υψηλός</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Κρυφές χρεώσεις apps</td><td class="px-4 py-2">Περιορισμένες και προβλέψιμες</td><td class="px-4 py-2">Συχνές μέσω πολλαπλών plugins</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Σταθερότητα οικοσυστήματος</td><td class="px-4 py-2">Υψηλή συνοχή</td><td class="px-4 py-2">Πιθανά conflicts & bugs</td></tr>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Βάρος σελίδων</td><td class="px-4 py-2">Βελτιστοποιημένο</td><td class="px-4 py-2">Συχνά βαρύτερες σελίδες</td></tr>
							<tr><td class="px-4 py-2">AI readiness</td><td class="px-4 py-2">AI‑native κατεύθυνση</td><td class="px-4 py-2">Όχι εγγενώς AI‑friendly</td></tr>
						</tbody>
					</table>
				</div>
				<p class="text-gray-300 mt-6 leading-relaxed">
					<strong class="text-white">Συμπέρασμα:</strong> Για το συγκεκριμένο επιχειρησιακό μοντέλο, το Shopify προσφέρει μεγαλύτερη λειτουργική απλότητα και προβλεψιμότητα.
				</p>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">8. Χρονοδιάγραμμα Υλοποίησης</h2>
				<p class="text-gray-300 mb-4 leading-relaxed"><strong class="text-white">Εκτιμώμενη διάρκεια:</strong> 4 εβδομάδες (20 ημέρες)</p>
				<ul class="list-decimal list-inside space-y-1 text-gray-300 ml-4">
					<li>Setup & αρχική παραμετροποίηση</li>
					<li>Δομή καταστήματος</li>
					<li>Ρυθμίσεις εμπορικής λειτουργίας</li>
					<li>Έλεγχοι & παράδοση</li>
				</ul>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">9. Οικονομική Προσφορά</h2>

				<h3 class="text-xl font-bold text-white mb-4">Συγκεντρωτική Εικόνα Κόστους</h3>
				<div class="overflow-x-auto mb-8">
					<table class="w-full text-sm text-gray-300 border border-gray-800">
						<thead>
							<tr class="border-b border-gray-800">
								<th class="px-4 py-3 text-left text-white font-medium">Σενάριο</th>
								<th class="px-4 py-3 text-left text-white font-medium">Αρχικό Κόστος</th>
								<th class="px-4 py-3 text-left text-white font-medium">Μηνιαίο Κόστος</th>
								<th class="px-4 py-3 text-left text-white font-medium">Shopify Plan</th>
							</tr>
						</thead>
						<tbody>
							<tr class="border-b border-gray-800"><td class="px-4 py-2">Με εποπτεία Noctua Core</td><td class="px-4 py-2">1.200 € + ΦΠΑ</td><td class="px-4 py-2">70 €/μήνα</td><td class="px-4 py-2">Basic Shopify (~39 $/μήνα)</td></tr>
							<tr><td class="px-4 py-2">Αυτοδιαχείριση πελάτη</td><td class="px-4 py-2">1.200 € + ΦΠΑ</td><td class="px-4 py-2">—</td><td class="px-4 py-2">Basic Shopify (~39 $/μήνα)</td></tr>
						</tbody>
					</table>
				</div>

				<h3 class="text-xl font-bold text-white mb-4">Κόστος Κατασκευής</h3>
				<p class="text-gray-300 mb-6 leading-relaxed"><strong class="text-white">1.200 € + ΦΠΑ (εφάπαξ)</strong>. Η τιμή αφορά την πλήρη υλοποίηση του e‑shop ως project και όχι ωριαία εργασία.</p>

				<h3 class="text-xl font-bold text-white mb-4">Μηνιαία Εποπτεία & Τεχνική Παρέμβαση (Προαιρετική)</h3>
				<p class="text-gray-300 mb-4 leading-relaxed">Προτείνεται προαιρετικό πλάνο υποστήριξης: <strong class="text-white">70 € / μήνα</strong>.</p>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-8">
					<li>παρακολούθηση ορθής λειτουργίας</li>
					<li>τεχνική παρέμβαση όταν απαιτείται</li>
					<li>βασική συμβουλευτική βελτιστοποίησης</li>
				</ul>

				<h3 class="text-xl font-bold text-white mb-4">Εναλλακτική Χωρίς Μηνιαία Εποπτεία</h3>
				<p class="text-gray-300 mb-4 leading-relaxed">Ο πελάτης έχει τη δυνατότητα να επιλέξει <strong class="text-white">αυτοδιαχείριση</strong> του καταστήματος.</p>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-8">
					<li>η σύμβαση αφορά μόνο την κατασκευή</li>
					<li>παρέχονται τρία (3) ωριαία sessions εκπαίδευσης</li>
					<li>γίνεται πλήρης καθοδήγηση του διαχειριστή</li>
				</ul>

				<h3 class="text-xl font-bold text-white mb-4">Τι Περιλαμβάνεται</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4 mb-8">
					<li>πλήρης παραμετροποίηση Shopify</li>
					<li>σχεδιασμός και δομή καταστήματος</li>
					<li>βασική SEO ρύθμιση</li>
					<li>ρυθμίσεις πληρωμών & αποστολών</li>
					<li>AI‑ready αρχιτεκτονική</li>
					<li>αρχική εκπαίδευση</li>
				</ul>

				<h3 class="text-xl font-bold text-white mb-4">Τι Δεν Περιλαμβάνεται</h3>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
					<li>συνδρομή Shopify</li>
					<li>premium themes (αν επιλεγούν)</li>
					<li>εφαρμογές τρίτων</li>
				</ul>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">10. Όροι Συνεργασίας</h2>
				<ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
					<li>Διάρκεια σύμβασης: 12 μήνες</li>
					<li>50% με την έναρξη</li>
					<li>50% με την παράδοση</li>
					<li>Ο λογαριασμός Shopify δημιουργείται στο όνομα του πελάτη, εξασφαλίζοντας πλήρη ιδιοκτησία και έλεγχο</li>
					<li>Δυνατότητα μελλοντικών επεκτάσεων κατόπιν συμφωνίας</li>
				</ul>
			</div>

			<div class="mb-20">
				<h2 class="text-2xl md:text-3xl font-bold text-white mb-8">11. Επόμενα Βήματα</h2>
				<ul class="list-decimal list-inside space-y-1 text-gray-300 ml-4">
					<li>Επιβεβαίωση αποδοχής</li>
					<li>Αναλυτική κατάρτιση σύμβασης εργασίας</li>
					<li>Συλλογή αρχικού υλικού</li>
					<li>Έναρξη υλοποίησης</li>
				</ul>
			</div>

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
								   class="mt-1 size-5 rounded border-gray-600 bg-gray-800 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-900 shrink-0">
							<span class="text-gray-300 leading-relaxed group-hover:text-gray-200 transition-colors">
								Αποδέχομαι την παρούσα πρόταση και το πλαίσιο εμπιστευτικότητας μεταξύ των δύο μερών.
							</span>
						</label>
						<button type="submit"
								:disabled="!acceptanceChecked"
								class="inline-flex items-center px-6 py-2 lg:px-8 lg:py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-600/80 to-violet-600/80 backdrop-blur-sm rounded-lg hover:from-blue-600 hover:to-violet-600 hover:border-blue-400/50 hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-blue-500/20 hover:shadow-xl hover:shadow-blue-500/30 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 cursor-pointer">
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

			<footer class="pt-12 border-t border-gray-800">
				<p class="text-gray-500 text-sm text-center">
					© {{ date('Y') }} Noctua Core – Elias Kalyvas Learning & Development · Εμπιστευτικό Έγγραφο – Μη Διανομή
				</p>
			</footer>
		</div>
	</div>
</div>
@endsection
