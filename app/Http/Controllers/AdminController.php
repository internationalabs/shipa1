<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscribers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.index');
    }
    public function indexNewsLetter()
    {
        $newsLetter = NewsletterSubscribers::latest()->get();
        return view('dashboard.admin.news_letter.index', compact('newsLetter'));
    }

    // public function showNewsLetter(NewsletterSubscribers $newsLetter)
    // {
    //     return view('dashboard.admin.news_letter.show', compact('newsLetter'));
    // }

    public function destroyNewsLetter(NewsletterSubscribers $newsLetter)
    {
        $newsLetter->delete();

        return redirect()->route('newsLetter.index')
            ->with('success', 'Contact message deleted successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
        ]);

        // Find the user
        $user = User::find($request->user_id);

        // Check if the current password matches the one in the database
        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json([
                'message' => 'The current password is incorrect.',
            ], 400);
        }

        // Update the password
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'message' => 'Password changed successfully.',
        ], 200);
    }
}
