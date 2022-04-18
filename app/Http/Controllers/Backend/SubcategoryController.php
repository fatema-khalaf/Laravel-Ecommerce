<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Category;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

class SubcategoryController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;

    // View All categories page
    public function SubcatigoryView()
    {
        $subcategories = Subcategory::latest()->get();
        $categories = Category::orderBy("category_name_en", "ASC")->get();
        return view(
            "backend.category.subcategory_view",
            compact("subcategories", "categories")
        );
    }

    // Store new category
    public function SubcategoryStore(Request $request)
    {
        $inputs = ["subcategory_name_en", "subcategory_name_ar", "category_id"];
        $slugs = [
            "subcategory_slug_en" => "subcategory_name_en",
            "subcategory_slug_ar" => "subcategory_name_ar",
        ];
        // Store trait
        $notification = $this->Store([
            "request" => $request,
            "inputs" => $inputs,
            "model" => "App\Models\SubCategory",
            "slugs" => $slugs,
            "inputs_required" => true,
        ]);
        return redirect()
            ->back()
            ->with($notification);
    }

    // View Edit category page
    public function SubcategoryEdite($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::orderBy("category_name_en", "ASC")->get();
        return view(
            "backend.category.subcategory_edit",
            compact("subcategory", "categories")
        );
    }

    // Update Edited data
    public function SubcategoryUpdate(Request $request)
    {
        $inputs = ["subcategory_name_en", "subcategory_name_ar", "category_id"];
        $slugs = [
            "subcategory_slug_en" => "subcategory_name_en",
            "subcategory_slug_ar" => "subcategory_name_ar",
        ];
        // Update trait
        $notification = $this->Update([
            "request" => $request,
            "inputs" => $inputs,
            "model" => "App\Models\Subcategory",
            "slugs" => $slugs, //Optional
            "message" => "Subcategory Updated successfully", //Optional
            "inputs_required" => false, //Optional
        ]);
        return redirect()
            ->route("all.subcategories")
            ->with($notification);
    } // end method

    // Delete category
    public function SubcategoryDelete($id)
    {
        $notification = $this->Delete(
            "App\Models\Subcategory",
            $id,
            false,
            "Subategory deleted successfully"
        );
        return redirect()
            ->back()
            ->with($notification);
    }

    ////////////////////////////////// SUB SUBCATEGORY ///////////////////////////////////////
    // View All Sub-subcategories page
    public function SubSubcatigoryView()
    {
        $subsubcategories = Subsubcategory::latest()->get();
        $categories = Category::orderBy("category_name_en", "ASC")->get();
        return view(
            "backend.category.sub_subcategory_view",
            compact("subsubcategories", "categories")
        );
    }

    //New idea get subCategory of a category
    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }


    // Store new category
    public function SubSubcategoryStore(Request $request)
    {
        $inputs = ["subsubcategory_name_en", "subsubcategory_name_ar", "category_id","subcategory_id"];
        $slugs = [
            "subsubcategory_slug_en" => "subsubcategory_name_en",
            "subsubcategory_slug_ar" => "subsubcategory_name_ar",
        ];
        // Store trait
        $notification = $this->Store([
            "request" => $request,
            "inputs" => $inputs,
            "model" => "App\Models\SubSubcategory",
            "slugs" => $slugs,
            "inputs_required" => true,
        ]);
        return redirect()
            ->back()
            ->with($notification);
    }

    // View Edit category page
    public function SubSubcategoryEdite($id)
    {
        $categories = Category::orderBy("category_name_en", "ASC")->get();
        $subcategories = Subcategory::orderBy("subcategory_name_en", "ASC")->get();
        $subsubcategory = SubSubcategory::findOrFail($id);
        return view(
            "backend.category.sub_subcategory_edit",
            compact("subsubcategory", "categories", "subcategories")
        );
    }

    // Update Edited data
    public function SubSubcategoryUpdate(Request $request)
    {
        $inputs = ["subsubcategory_name_en", "subsubcategory_name_ar", "category_id","subcategory_id"];
        $slugs = [
            "subsubcategory_slug_en" => "subsubcategory_name_en",
            "subsubcategory_slug_ar" => "subsubcategory_name_ar",
        ];
        // Update trait
        $notification = $this->Update([
            "request" => $request,
            "inputs" => $inputs,
            "model" => "App\Models\SubSubcategory",
            "slugs" => $slugs, //Optional
            "message" => "Sub-subcategory Updated successfully", //Optional
            "inputs_required" => false, //Optional
        ]);
        return redirect()
            ->route("all.subsubcategories")
            ->with($notification);
    } // end method

    // Delete category
    public function SubSubcategoryDelete($id)
    {
        $notification = $this->Delete(
            "App\Models\SubSubcategory",
            $id,
            false,
            "Sub-subategory deleted successfully"
        );
        return redirect()
            ->back()
            ->with($notification);
    }
}
