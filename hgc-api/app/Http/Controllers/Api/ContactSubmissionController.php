<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactSubmissionController extends Controller
{
    /**
     * Store a new contact submission from frontend
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $submission = ContactSubmission::create($validator->validated());

        // TODO: Send notification email to admin here

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully. We will get back to you soon.',
            'data' => $submission,
        ], 201);
    }

    /**
     * Admin: List all submissions with pagination and filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = ContactSubmission::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $submissions = $query->latest()->paginate($request->per_page ?? 20);

        return response()->json([
            'success' => true,
            'data' => $submissions,
        ]);
    }

    /**
     * Admin: Get single submission
     */
    public function show(int $id): JsonResponse
    {
        $submission = ContactSubmission::findOrFail($id);

        // Mark as read if currently new
        if ($submission->status === 'new') {
            $submission->update([
                'status' => 'read',
                'read_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $submission,
        ]);
    }

    /**
     * Admin: Update submission status
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $submission = ContactSubmission::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,archived',
            'admin_notes' => 'nullable|string|max:5000',
        ]);

        $submission->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Submission updated successfully',
            'data' => $submission,
        ]);
    }

    /**
     * Admin: Delete submission
     */
    public function destroy(int $id): JsonResponse
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();

        return response()->json([
            'success' => true,
            'message' => 'Submission deleted successfully',
        ]);
    }

    /**
     * Admin: Get statistics
     */
    public function stats(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total' => ContactSubmission::count(),
                'new' => ContactSubmission::where('status', 'new')->count(),
                'read' => ContactSubmission::where('status', 'read')->count(),
                'replied' => ContactSubmission::where('status', 'replied')->count(),
                'archived' => ContactSubmission::where('status', 'archived')->count(),
            ],
        ]);
    }
}