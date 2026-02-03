<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ProposalController extends Controller
{
    private function validateToken(Proposal $proposal, ?string $plaintextToken): bool
    {
        if (!$plaintextToken) {
            return false;
        }

        $accessToken = PersonalAccessToken::findToken($plaintextToken);

        if (!$accessToken) {
            return false;
        }

        return $accessToken->tokenable_type === Proposal::class
        && (string) $accessToken->tokenable_id === (string) $proposal->id;
    }

    private function getTermsAcceptedSessionKey(Proposal $proposal, string $plaintextToken): string
    {
        return "proposal_terms_accepted_{$proposal->id}_" . hash('sha256', $plaintextToken);
    }

    public function index(Proposal $proposal, Request $request)
    {
        $secret = $request->input('secret');

        if (!$this->validateToken($proposal, $secret)) {
            abort(404);
        }

        $termsAccepted = session($this->getTermsAcceptedSessionKey($proposal, $secret), false);

        return view("proposals.{$proposal->company_name}", [
            'proposal' => $proposal,
            'secret' => $secret,
            'termsAccepted' => $termsAccepted,
        ]);
    }

    public function acceptTerms(Proposal $proposal, Request $request): \Illuminate\Http\JsonResponse
    {
        $secret = $request->input('secret');

        if (!$this->validateToken($proposal, $secret)) {
            abort(404);
        }

        session([$this->getTermsAcceptedSessionKey($proposal, $secret) => true]);

        return response()->json([
            'success' => true,
            'message' => 'Terms accepted successfully',
        ]);
    }

    public function acceptProposal(Proposal $proposal, Request $request)
    {
        $request->validate([
            'secret' => 'required|string',
            'acceptance' => 'required|in:1',
        ], [
            'acceptance.required' => 'Παρακαλώ αποδεχτείτε την πρόταση και το πλαίσιο εμπιστευτικότητας.',
            'acceptance.in' => 'Παρακαλώ επιβεβαιώστε την αποδοχή της πρότασης.',
        ]);

        $secret = $request->input('secret');

        if (!$this->validateToken($proposal, $secret)) {
            abort(404);
        }

        $proposal->update(['status' => 'accepted']);

        return redirect()
            ->route('proposals.index', [
                'proposal' => $proposal->company_name,
                'secret' => $secret,
            ])
            ->with('proposal_accepted_success', true);
    }

    public function demo(Proposal $proposal, Request $request)
    {
        $secret = $request->input('secret');

        if (!$this->validateToken($proposal, $secret)) {
            abort(404);
        }

        $termsAccepted = session($this->getTermsAcceptedSessionKey($proposal, $secret), false);

        if (!$termsAccepted) {
            return redirect()->route('proposals.index', [
                'proposal' => $proposal->company_name,
                'secret' => $secret,
            ]);
        }

        return view('demos.pac-man', [
            'proposal' => $proposal,
            'secret' => $secret,
        ]);
    }
}
