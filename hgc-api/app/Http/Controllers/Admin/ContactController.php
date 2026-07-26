<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'admin']); // or whatever your admin middleware is
    // }

    /**
     * Display contact submissions list.
     */
    public function submissions(Request $request)
    {
        $query = ContactSubmission::query()->orderBy('created_at', 'desc');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $submissions = $query->paginate(10)->withQueryString();

        $counts = [
            'all' => ContactSubmission::count(),
            'new' => ContactSubmission::where('status', 'new')->count(),
            'read' => ContactSubmission::where('status', 'read')->count(),
            'replied' => ContactSubmission::where('status', 'replied')->count(),
            'archived' => ContactSubmission::where('status', 'archived')->count(),
        ];

        return view('admin.contacts.submissions.index', compact('submissions', 'counts'));
    }

    /**
     * Get a single submission (JSON — for AJAX).
     */
    public function showSubmission(ContactSubmission $submission)
    {
        return response()->json(['submission' => $submission]);
    }

    /**
     * Update submission status (JSON — for AJAX).
     */
    public function updateSubmission(Request $request, ContactSubmission $submission)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,archived',
            'admin_notes' => 'nullable|string',
        ]);

        $update = ['status' => $validated['status']];

        if ($validated['status'] === 'read' && !$submission->read_at) {
            $update['read_at'] = now();
        }

        if ($request->has('admin_notes')) {
            $update['admin_notes'] = $validated['admin_notes'];
        }

        $submission->update($update);

        return response()->json(['submission' => $submission->fresh()]);
    }

    /**
     * Mark submission as read (JSON — for AJAX).
     */
    public function markAsRead(ContactSubmission $submission)
    {
        $submission->update([
            'status' => 'read',
            'read_at' => now(),
        ]);

        return response()->json(['submission' => $submission->fresh()]);
    }

    /**
     * Display contact info edit page.
     */
    public function info()
    {
        $contactInfo = ContactInfo::first();

        if (!$contactInfo) {
            $contactInfo = ContactInfo::create([
                'address' => '',
                'phones' => '',
                'email' => '',
                'office_hours' => '',
                'address_dari' => '',
                'phones_dari' => '',
                'email_dari' => '',
                'office_hours_dari' => '',
                'address_pashto' => '',
                'phones_pashto' => '',
                'email_pashto' => '',
                'office_hours_pashto' => '',
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'telegram' => '',
                'instagram' => '',
                'youtube' => '',
                'whatsapp' => '',
                'map_embed_url' => '',
                'map_lat' => null,
                'map_lng' => null,
            ]);
        }

        return view('admin.contacts.info.edit', compact('contactInfo'));
    }

    /**
     * Update contact info.
     * 
     * FIXED: Redirects with flash message for traditional form submissions.
     * Keeps JSON response for AJAX requests.
     */
    public function updateInfo(Request $request)
    {
        $validated = $request->validate([
            'address' => 'nullable|string',
            'phones' => 'nullable|string',
            'email' => 'nullable|email',
            'office_hours' => 'nullable|string',
            'address_dari' => 'nullable|string',
            'phones_dari' => 'nullable|string',
            'email_dari' => 'nullable|email',
            'office_hours_dari' => 'nullable|string',
            'address_pashto' => 'nullable|string',
            'phones_pashto' => 'nullable|string',
            'email_pashto' => 'nullable|email',
            'office_hours_pashto' => 'nullable|string',
            'facebook' => 'nullable|string|url',
            'x' => 'nullable|string|url',
            'linkedin' => 'nullable|string|url',
            'telegram' => 'nullable|string|url',
            'instagram' => 'nullable|string|url',
            'youtube' => 'nullable|string|url',
            'whatsapp' => 'nullable|string|url',
            'map_embed_url' => 'nullable|string',
            'map_lat' => 'nullable|numeric',
            'map_lng' => 'nullable|numeric',
        ]);

        $contactInfo = ContactInfo::first();

        if (!$contactInfo) {
            $contactInfo = ContactInfo::create($validated);
        } else {
            $contactInfo->update($validated);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'contactInfo' => $contactInfo->fresh(),
            ]);
        }

        // Otherwise redirect with flash message (traditional form submission)
        return redirect()
            ->back()
            ->with('success', 'Contact information updated successfully.');
    }
}