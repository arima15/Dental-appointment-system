<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Profile::first() ?? new Profile([
            'full_name' => 'Default User',
            'school_id' => '12345',
        ]);
        
        return view('dash.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        try {
            // Add validation
            $validated = $request->validate([
                'field' => 'required|string',
                'value' => 'required_without:photo',
                'photo' => 'nullable|image|max:2048'
            ]);

            // Add debug logging
            \Log::info('Profile update request:', $request->all());

            $profile = Profile::first() ?? new Profile();
            $field = $request->input('field');
            $value = $request->input('value');

            switch ($field) {
                case 'photo':
                    if ($request->hasFile('photo')) {
                        if ($profile->profile_picture) {
                            Storage::delete('public/profile-pictures/' . $profile->profile_picture);
                        }
                        
                        // Store new photo
                        $path = $request->file('photo')->store('public/profile-pictures');
                        $profile->profile_picture = basename($path);
                    }
                    break;

                case 'name':
                    $profile->full_name = $value;
                    break;

                case 'dob':
                    $profile->date_of_birth = $value;
                    // Recalculate age based on new DOB
                    $profile->age = \Carbon\Carbon::parse($value)->age;
                    break;

                case 'address':
                    $profile->address = $value;
                    break;

                case 'gender':
                    $profile->gender = $value;
                    break;

                case 'contact':
                    $profile->contact_number = $value;
                    break;

                case 'username':
                    $profile->username = $value;
                    break;
            }

            $profile->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => $profile
            ]);
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}