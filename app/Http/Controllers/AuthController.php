<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class AuthController extends Controller{
  public function create()
   {
       return view('register');
   }

   public function store(Request $request)
   {
     //validation

     $this-> validate ($request,[

       'name' => 'required',
       'email' => 'required|email',
       'password' => 'required'

     ]);

     //mail
     //Mail::to($email) -> send (new)

     //flash ('message of approval has been sent') -> success (new registerMail ($user));

    // return $user;

     //insert new record in database
     $user = User::create([

       'name' =>$request -> input ('name'),
       'email' =>$request -> input ('email'),
       'password' =>$request -> input ('password')

     ]);
     //return to 123 for placeholder
      return view('login');
   }

   public function loginView(){

     return view('login');
   }

   public function login (Request $request){

     $email = $request -> input ('email');
     $password = $request -> input ('password');

     $data = User::where('email',$email)->first();

     //check whether the email true or not

     if ($data)
     {
       //if (Hash::check ($password,$data->password))

         if ($password == $data->password)
       {
         Session::put ('User',$data->email);
         Session::put('login',TRUE);

       }//else {

          //return redirect('login' -> with('alert','either Email or Password are wrong') );

       //}
     }//else {

       //return redirect('login' -> with('alert','either Email or Password are wrong') );

     //

     //return to register temporary
     return view('edit');
   }

   public function show($id)
   {



   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Session::get ('User');
      Session::get('login',TRUE);
    
         return view('edit',compact('data'));

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
      $this-> validate ($request,[
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
      ]);


      $data = data::find($id);
      $data -> name = $request->get('name');
      $data -> email = $request->get('email');
      $data -> password = $request->get('password');
      $data -> save();

      return redirect()->route('edit')->with('success','Data Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        //
    }*/
 }
