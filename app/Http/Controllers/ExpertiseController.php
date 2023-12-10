<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertiseController extends Controller
{


    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            // // Delete existing expertise records for the user
            $user->expertiseList()->delete();

            $rows = $request->all();

            foreach ($rows as $row) {

               $expertise = new Expertise;
               $expertise->user_id = $user->id;
               $expertise->expertise_field_id = $row['expertise_field_id'];
               $expertise->detail = $row['detail'];
               $expertise->years_of_experience = intval($row['years_of_experience']) ?: 1;
               $expertise->is_primary = $row['is_primary']? 1:0;
               $expertise->save();

            }



            // Return a success JSON response
            return response()->json(['message' => 'Expertise updated successfully', 'success' => true, 'asd' => $rows])->header('Content-Type', 'application/json');

        } catch (\Throwable $error) {
            // Return an error JSON response
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

}
