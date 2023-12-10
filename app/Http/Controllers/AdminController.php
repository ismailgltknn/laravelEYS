<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function Destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
    
    public function Profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile', compact('adminData'));
    }
    
    public function EditProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }
    
    public function StoreProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;
        if ($request->file('profileImage')) {
            $file = $request->file('profileImage');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('files/profileImages'), $fileName);
            $data['profileImage'] = $fileName;
        }
        $data->save();
        
        $notification = array(
            'message' => 'Profil Güncelleme İşlemi Başarılı',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }
    
    public function ChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function UpdatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'oldPass' => 'required',
            'newPass' => 'required',
            'newPassConfirm' => 'required|same:newPass',
        ]);

        $hashedPass = Auth::user()->password;
        if (Hash::check($request->oldPass, $hashedPass)) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->newPass);
            $user->save();

            session()->flash('message', 'Şifreniz başarıyla güncellendi.');
            return redirect()->back();
        }else{
            session()->flash('message', 'Şifreniz eşleşmiyor. Lütfen tekrar deneyiniz.');
            return redirect()->back();
        }
    }
}
