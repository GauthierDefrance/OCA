<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailCheckRequest;
use App\Http\Requests\EmailValidator;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\MyRegisterRequest;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ConnectController extends Controller
{

    /**
     * Méthode qui affiche la page d'accueil lorsqu'un utilisateur se connecte à /connect
     * @return object Renvoi une page Html
     */
    public function index() : object {
        return view('pages.connect.index');
    }

    /**
     * Méthode qui
     */
    public function login(LoginRequest $request) {

        $validatedData = $request->validated();

        $auth = Auth::attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ]);

        if (!$auth) {
            return back()->withErrors([
                'email' => 'Les informations fournies sont incorrectes.',
            ])->withInput();
        }

        // Ici, l'utilisateur est connecté
        $user = Auth::user();

        if($user->is_banned){
            Auth::logout();
            abort(403, "Your account is banned.");
        }

        if (!$user->email_verified) {
            Auth::logout();
            return redirect()->route("connect.ask_check_email")->withErrors(['email' => 'Veuillez valider votre adresse email avant de vous connecter.']);
        }

        // Email vérifié → on redirige
        return redirect()->route('home');
    }



    /**
     * Méthode qui
     */
    public function register(MyRegisterRequest $request) {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $email = EmailVerification::create([
            'user_id' => $user->id,
            'verification_code' => Str::random(10),
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new \App\Mail\WelcomeMail($email->verification_code));

        return redirect()->route('connect.check_email');

    }


    public function email_check_page(){
        return view('pages.connect.email_check');
    }
    public function email_checker(EmailCheckRequest $request) {

        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return "User doesn't exist";
        }

        $emailVerif = EmailVerification::where('user_id', $user->id)
            ->where('verification_code', $validatedData['code'])
            ->first();

        if (!$emailVerif) {
            return "Email check failed, wrong code or wrong email";
        }

        $user->email_verified = true;
        $user->email_verified_at = now();
        $user->save();

        // Suppression de la ligne de verification si le code est valide
        $emailVerif->delete();

        Auth::loginUsingId($user->id);

        return redirect()->route('home');
    }


    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }


    public function email_send_page(){
        return view('pages.connect.email_sender');
    }

    public function email_sender(EmailValidator $request){
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || $user->email_verified) {
            return back()->withErrors(['email' => 'Cet utilisateur n’existe pas ou a déjà vérifié son email.']);
        }

        $emailVerif = EmailVerification::where('user_id', $user->id)->first();

        if (!$emailVerif) {
            return back()->withErrors(['email' => 'Aucun code de vérification trouvé.']);
        }

        $emailVerif->verification_code = Str::random(10);
        $emailVerif->expires_at = now()->addMinutes(10);
        $emailVerif->save();

        Mail::to($user->email)->send(new \App\Mail\WelcomeMail($emailVerif->verification_code));

        return redirect()->route('connect.check_email');
    }



}
