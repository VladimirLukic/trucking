<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Patients;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        $this->data = [
            'columns' => ['NAME', 'EMAIL', 'PHONE NO.', 'ROLE', 'ACTION'],
            'search' => '/users/search',
            'roles'=> ['admin'],
            'users'
        ];
    }
    
    public function index()
    {
        //iskljuciti rezultat sa id "1" jer je defaultna vrednost
        $users = User::where('id', '>', 1)->orderBy('role', 'asc')->paginate(20);

        $this->data['users'] = $users;
        return view('users.index')->with('data', $this->data);
    }

    /**
     * Check the role of the resource
     *
     * @param  string  $role
     * @return \Illuminate\Http\Response
     */

    public function role($role)
    {
        $users = User::where('role', $role)->get();

        if(count($users) == 0)
        return redirect('/users');

        $this->data['users'] = $users;
        return view('users.index')->with('data', $this->data);
    }

        /**
     * Search for the resource
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {

        $users = User::where('name','like', $request->input('search').'%')
                ->orWhere('last_name','like', $request->input('search').'%')
                ->get();

        $this->data['users'] = $users;
        return view('users.index')->with('data', $this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create')->with('data', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            //Make sure to add in fillable in Users model
            'role' => ['required', 'string', 'max:25'],
            'phone' => ['required', 'max:55'],
            'last_name' => ['required', 'string', 'max:255']
        ]);

        $user = User::where('name', $request->input('name'))
        ->where('last_name', $request->input('last_name'))->get();
        
        if(count($user) >0)
        return redirect('/users/create')->with('error', 'User with the same name already exists!');

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => strtolower($request->input('role')),
            'phone' => $request->input('phone'),
            'last_name' => $request->input('last_name'),
        ]);

        return redirect('/users')->with('success', 'User added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user == null) 
        return redirect('/users')->with('error', 'There is no such user!');

        $this->data['user'] = $user;
        return view('users.show')->with('data', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        if($user == null) 
        return redirect('/users')->with('error', 'There is no such user!');

        $this->data['users'] = $user;
        return view('users.edit')->with('data', $this->data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if($user == null) 
        return redirect('/users')->with('error', 'There is no such user!');

        if($user->email !== $request->input('email'))
        $this->validate($request, [
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],           
        ]);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            // make sure to add in fillable in Users model
            'role' => ['required', 'string'],
            'phone' => ['required'],
            'last_name' => ['required', 'string']
        ]);

        User::whereId($id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => strtolower($request->input('role')),
            'phone' => $request->input('phone'),
            'last_name' => $request->input('last_name'),
        ]);

        return redirect('/users')->with('success', 'User edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!User::whereId($id)) 
        return redirect('/users')->with('error', 'There is no such user!');

        //"1" is a default value for unassigned resource
        Patients::where('doctor_id', $id)->update(['doctor_id' => 1]);

        User::whereId($id)->delete();
        return redirect('/users')->with('success', 'User deleted');
    }
}
