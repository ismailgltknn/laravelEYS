<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function UnitAll(){
        $units = Unit::latest()->get();
        return view('backend.unit.unitAll', compact('units'));
    }

    public function UnitAdd(){
        return view('backend.unit.unitAdd');
    }

    public function UnitStore(Request $request)
    {
        $unitName = Unit::where('name', $request->unitName)->first();
        if ($unitName === null) {
            Unit::firstOrCreate([
                'name' => $request->unitName
            ],
            [
                'name' => $request->unitName,
                'createdBy' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Birim Ekleme İşlemi Başarılı',
                'alert-type' => 'success'
            );
            return redirect()->route('unit.all')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Bu isimde birim mevcut.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    
    public function UnitEdit($id){
        $unit = Unit::findOrFail($id);
        
        return view('backend.unit.unitEdit', compact('unit'));
    }
    
    public function UnitUpdate(Request $request)
    {
        $unitId = $request->id;
        Unit::findOrFail($unitId)->update(
            [
                'name' => $request->unitName,
                'updatedBy' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Birim Güncelleme İşlemi Başarılı',
                'alert-type' => 'success'
            );
            return redirect()->route('unit.all')->with($notification);
        }
        
        public function UnitDelete($id){
            Unit::findOrFail($id)->update(['updatedBy' => Auth::user()->id,]);
            Unit::findOrFail($id)->delete();
            
            $notification = array(
                'message' => 'Birim Silme İşlemi Başarılı',
                'alert-type' => 'success'
            );
            sleep(1);
            return redirect()->back()->with($notification);
        }
}
