<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Admin\UserRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::query();

            return DataTables::of($query)
                ->addColumn('action', function ($items) {
                    return '
                    
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">
                                        Action
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="' . route('user.edit', $items->id) . '">Edit</a>

                            <form action="' . route('user.destroy', $items->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                            <button class="dropdown-item text-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("pages.admin.user.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("pages.admin.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data["password"] = bcrypt($request["password"]);

        User::create($data);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = User::findOrFail($id);

        return view('pages.admin.user.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $data = $request->all();

        $item = User::findOrFail($id);

        // Check if a new password is provided
        if ($request->password) {
            $item->password = bcrypt($request['password']);
        } else {
            unset($data['password']);
        }

        if ($request->has('email') && $request->email !== $item->email) {

            // Validate the email field for uniqueness, excluding the current user
            $request->validate([
                'email' => 'unique:users,email,' . $item->id,
            ]);
        } else {

            // If the email is not being updated, remove it from the data array
            unset($data['email']);
        }

        $item->update($data);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}
