<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function CategoryAll(){
        $categories = Category::latest()->get();
        return view('backend.category.categoryAll', compact('categories'));
    }

    public function CategoryAdd(){
        return view('backend.category.categoryAdd');
    }

    public function CategoryStore(Request $request)
    {
        $categoryName = Category::where('name', $request->categoryName)->first();
        if ($categoryName === null) {
            Category::firstOrCreate([
                'name' => $request->categoryName
            ],
            [
                'name' => $request->categoryName,
                'createdBy' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Kategori Ekleme İşlemi Başarılı',
                'alert-type' => 'success'
            );
            return redirect()->route('category.all')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Bu isimde kategori mevcut.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    
    public function CategoryEdit($id){
        $category = Category::findOrFail($id);
        
        return view('backend.category.categoryEdit', compact('category'));
    }
    
    public function CategoryUpdate(Request $request)
    {
        $categoryId = $request->id;
        Category::findOrFail($categoryId)->update(
            [
                'name' => $request->categoryName,
                'updatedBy' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Kategori Güncelleme İşlemi Başarılı',
                'alert-type' => 'success'
            );
            return redirect()->route('category.all')->with($notification);
        }
        
        public function CategoryDelete($id){
            Category::findOrFail($id)->update(['updatedBy' => Auth::user()->id,]);
            Category::findOrFail($id)->delete();
            
            $notification = array(
                'message' => 'Kategori Silme İşlemi Başarılı',
                'alert-type' => 'success'
            );
            sleep(1);
            return redirect()->back()->with($notification);
        }
}
