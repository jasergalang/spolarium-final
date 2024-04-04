<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User, Artist, Customer, Cart,Artwork    ,Material};
    use App\Mail\RegisterUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function customerRegister()
    {
        return view('user.cusRegister');
    }

    public function artistRegister()
    {
        return view('user.artRegister');
    }

    public function cusRegister(Request $request)
    {
        $this->validateRegistration($request, 'customer');
        $validatedData = $request->only(['fname', 'lname', 'email', 'contact', 'password']);

        // Process image upload
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images');
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        }

        // Create a new user
        $user = User::create([
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'email' => $validatedData['email'],
            'contact' => $validatedData['contact'],
            'password' => Hash::make($validatedData['password']),
            'roles' => 'customer',
            'status' => 'active',
            'image_path' => $imagePath ?? null,
        ]);

        if (!$user) {
            return redirect(route('cusregister'))->with("fail", "Registration Failed!! Please Try Again.");
        }

        $customer = new Customer(['user_id' => $user->id]);
        $customer->save();

        $cart = new Cart(['customer_id' => $customer->id]);
        $cart->save();

        $user->sendEmailVerificationNotification();

        return redirect(route('login'))->with("success", "Registration Successful!!");
    }

    function artRegister(Request $request)
    {
       $this->validateRegistration($request, 'artist');
       $validatedData = $request->only(['fname', 'lname', 'email', 'contact', 'password']);
       if ($request->hasFile('image_path')) {
           $imagePath = $request->file('image_path')->store('images');
           $imagePath = str_replace('public/', 'storage/', $imagePath);
       }

       $data = [
           'fname' => $validatedData['fname'],
           'lname' => $validatedData['lname'],
           'email' => $validatedData['email'],
           'contact' => $validatedData['contact'],
           'password' => Hash::make($validatedData['password']),
           'roles' => 'artist',
           'status' => 'active',
           'image_path' => $imagePath,
       ];
       $user = User::create($data);

       if (!$user) {
           return redirect(route('artregister'))->with("fail", "Registration Failed!! Please Try Again.");
       }

       $artist = new Artist(['user_id' => $user->id]);
       $artist->save();
       $user->sendEmailVerificationNotification();
       return redirect(route('login'))->with("success", "Registration Successful!!");
   }

   private function validateRegistration(Request $request, $roles)
   {
    //    dd($request->all());
       $request->validate([
           'fname' => 'required',
           'lname' => 'required',
           'email' => "required|email|unique:users,email,NULL,id,roles,$roles",
           'contact' => 'required|numeric|digits:11',
           'password' => 'required|min:8|max:15|confirmed',
           'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
       ]);

   }
   function loginPost(Request $request)
   {
       $request->validate([
           'email' => 'required|email',
           'password' => 'required|min:8|max:15',
       ]);

       $credentials = $request->only('email', 'password');
       if (Auth::attempt($credentials)) {
           $user = Auth::user();
           $request->session()->regenerate();
           // Check if the user's account is active and email is verified
           if ($user->status === 'active' && $user->email_verified_at !== null) {
               $request->session()->regenerate();
               switch ($user->roles) {
                   case 'artist':
                       $artist = Artist::where('user_id', $user->id)->first();
                       if ($artist) {
                           return redirect()->route('artwork.dashboard')->with('artist_id', $user->id);
                       }
                       break;
                   case 'customer':
                       $customer = Customer::where('user_id', $user->id)->first();
                       if ($customer) {
                           return redirect()->route('home')->with('customer_id', $user->id);
                       }
                       break;
                       case 'admin':

                            return redirect()->route('event.index');
                        break;
                   default:
                       return back()->withInput()->withErrors(['email' => 'Invalid user role.']);
               }
           } elseif ($user->email_verified_at === null) {
               Auth::logout();
               return back()->withInput()->withErrors(['email' => 'Please verify your email address.']);
           } elseif ($user->status === 'deactivated') {
               Auth::logout();
               return back()->withInput()->withErrors(['email' => 'Your account is deactivated.']);
        //    $request->session()->regenerate();
        //    switch ($user->roles) {
        //        case 'artist':
        //            $artist = Artist::where('user_id', $user->id)->first();
        //            if ($artist) {
        //                return redirect()->route('artwork.dashboard')->with('artist_id', $user->id);
        //            }
        //            break;
        //        case 'customer':
        //            $customer = Customer::where('user_id', $user->id)->first();
        //            if ($customer) {
        //                return redirect()->route('home')->with('customer_id', $user->id);
        //            }
        //            break;
        //        case 'admin':

        //                return redirect()->route('events.dashboard');

        //            break;
        //        default:
        //            return back()->withInput()->withErrors(['email' => 'Invalid user role.']);

           }
           return back()->withInput()->withErrors(['email' => 'Invalid user role.']);
       }

       return back()->withInput()->withErrors(['email' => 'Invalid email or password.']);
   }






   public function verify($token)
{
    $user = User::where('remember_token', '=', $token)->first();
    if(!empty($user))
    {
        // Redirect to login page with a message
        return redirect()->route('login')->with('alert', 'Email Verified! Please Login');
    }
    else
    {
        abort(404);
    }
}
function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
    public function show()
    {
        $user = auth()->user();
        return view('user.show', compact('user'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for artworks
        $artwork = Artwork::where('name', 'like', "%$query%")
                            ->orWhere('desc', 'like', "%$query%")
                            ->get();

        // Search for materials
        $material = Material::where('name', 'like', "%$query%")
                            ->orWhere('desc', 'like', "%$query%")
                            ->get();

      return redirect()->back()->with(compact('artwork', 'material'));

    }




}
