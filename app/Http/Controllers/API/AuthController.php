<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AuthController extends Controller
{



    public function register(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'date_of_birth'=>'required|date',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'required',
            'educational_qualification'=>'required',
            'photo' =>'',
            'resume'=>''
        ]);

        // If validation fails, return error messages
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Generate a short UUID for user_id
        $shortUuid = substr(Str::uuid(), 0, rand(5, 10));

        // Create user record
        DB::transaction(function () use ($request, $shortUuid, &$user) {
            $user = User::create([
                'employee_id' => $shortUuid,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'date_of_birth' => $request->date_of_birth,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'educational_qualification' => $request->educational_qualification,
                'photo' => $request->photo,
                'resume' => $request->resume,
                'created_at' => now()

            ]);

        });

        // Return success response
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }


    public function indexUser()
    {
        // Fetch all users
        $users = User::all();

        // Return users as JSON response
        return response()->json([
            'users' => $users
        ]);
    }


    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'required',
            'educational_qualification' => 'required',
            'photo' => '',
            'resume' => ''
        ]);

        // If validation fails, return error messages
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Find the user by id
        $user = User::findOrFail($id);

        // Update user record
        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'educational_qualification' => $request->educational_qualification,
            'photo' => $request->photo,
            'resume' => $request->resume,
        ]);

        // Return success response
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }


    public function destroy($id)
{
    // Find the user by id
    $user = User::findOrFail($id);

    // Soft delete the user
    $user->delete();

    // Return success response
    return response()->json([
        'message' => 'User soft deleted successfully'
    ]);
}

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            // Ensure the type is either 'admin' or 'user'
        ]);

        $credentials = $request->only('email', 'password');



        // Generate JWT token
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Return response with user and token
        return response()->json([
            'user' => Auth::user(),
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    public function indexSorting(Request $request)
    {
        $sortBy = $request->input('sort_by', 'created_at'); // Default sorting by 'created_at'
        $sortOrder = $request->input('sort_order', 'desc'); // Default sort order is 'desc'

        $users = User::orderBy($sortBy, $sortOrder)->get();

        return response()->json([
            'users' => $users
        ]);
    }


    public function indexFiltering(Request $request)
{
    $filterBy = $request->input('filter_by');
    $filterValue = $request->input('filter_value');

    $users = User::where($filterBy, $filterValue)->get();

    return response()->json([
        'users' => $users
    ]);
}


public function indexPagination(Request $request)
{
    $perPage = $request->input('per_page', 10); // Default pagination size is 10
    $page = $request->input('page', 1);

    $users = User::paginate($perPage, ['*'], 'page', $page);

    return response()->json([
        'users' => $users
    ]);
}


public function indexSearch(Request $request)
{
    $search = $request->input('search');

    $users = User::where('firstname', 'like', '%'.$search.'%')
                 ->orWhere('email', 'like', '%'.$search.'%')
                 ->get();

    return response()->json([
        'users' => $users
    ]);
}

}
