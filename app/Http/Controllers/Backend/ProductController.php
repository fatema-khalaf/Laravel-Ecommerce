<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;

use App\Models\MultiImg;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    use StoreTrait;
    use UpdateTrait;

    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view(
            "backend.product.product_add",
            compact("categories", "brands")
        );
    }

    public function ProductStore(Request $request)
    {
        $inputs = [
            "brand_id",
            "category_id",
            "subcategory_id",
            "subsubcategory_id",
            "product_name_en",
            "product_name_ar",
            "product_code",
            "product_qty",
            "product_tags_en",
            "product_tags_ar",
            "product_size_en",
            "product_size_ar",
            "product_color_en",
            "product_color_ar",
            "selling_price",
            "discount_price",
            "short_descp_en",
            "short_descp_ar",
            "long_descp_en",
            "long_descp_ar",
            "hot_deals",
            "featured",
            "special_offer",
            "special_deals",
        ];
        $slugs = [
            "product_slug_en" => "product_name_en",
            "product_slug_ar" => "product_name_ar",
        ];
        // Store trait
        $res = $this->Store([
            "request" => $request,
            "inputs" => $inputs,
            "image_path" => "upload/products/thambnail/",
            "new_image" => "product_thambnail", //Optional
            "image_width" => 917,
            "image_height" => 1000,
            "model" => "App\Models\Product",
            "slugs" => $slugs,
        ]);

        $images = $request->file("multi_img");
        foreach ($images as $img) {
            $make_name =
                hexdec(uniqid()) . "." . $img->getClientOriginalExtension();
            Image::make($img)
                ->resize(917, 1000)
                ->save("upload/products/multi-image/" . $make_name);
            $uploadPath = "upload/products/multi-image/" . $make_name;

            MultiImg::insert([
                "product_id" => $res["id"],
                "photo_name" => $uploadPath,
                "created_at" => Carbon::now(),
            ]);
        } // end foreach

        return redirect()
            ->route("all.products")
            ->with($res["notification"]);
    }

    public function ProductView()
    {
        $products = Product::latest()->get();
        return view("backend.product.product_view", compact("products"));
    }

    public function ProductEdite($id)
    {
        $multiImgs = MultiImg::where("product_id", $id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $subsubcategories = SubSubcategory::latest()->get();
        $product = product::findOrFail($id);
        return view(
            "backend.product.product_edit",
            compact(
                "brands",
                "categories",
                "subcategories",
                "subsubcategories",
                "product",
                "multiImgs"
            )
        );
    }

    public function ProductUpdate(Request $request)
    {
        $inputs = [
            "brand_id",
            "category_id",
            "subcategory_id",
            "subsubcategory_id",
            "product_name_en",
            "product_name_ar",
            "product_code",
            "product_qty",
            "product_tags_en",
            "product_tags_ar",
            "product_size_en",
            "product_size_ar",
            "product_color_en",
            "product_color_ar",
            "selling_price",
            "discount_price",
            "short_descp_en",
            "short_descp_ar",
            "long_descp_en",
            "long_descp_ar",
            "hot_deals",
            "featured",
            "special_offer",
            "special_deals",
        ];
        $slugs = [
            "product_slug_en" => "product_name_en",
            "product_slug_ar" => "product_name_ar",
        ];
        // Update trait
        $notification = $this->Update([
            "request" => $request,
            "inputs" => $inputs,
            "model" => "App\Models\Product",
            "slugs" => $slugs, //Optional
            "message" => "Product Updated successfully", //Optional
        ]);
        return redirect()
            ->route("all.products")
            ->with($notification);
    }

    // Update multi images
    public function MultiImageUpdate(Request $request)
    {
        $images = $request->multi_img; //from this input name👉<input class="form-control" type="file" name="multi_img[ $img->id ]">
        if ($images) {
            foreach ($images as $id => $image) {
                $oldImage = MultiImg::findOrFail($id);
                unlink($oldImage->photo_name);
                $make_name =
                    hexdec(uniqid()) .
                    "." .
                    $image->getClientOriginalExtension();
                Image::make($image)
                    ->resize(917, 1000)
                    ->save("upload/products/multi-image/" . $make_name);
                $uploadPath = "upload/products/multi-image/" . $make_name;
                MultiImg::where("id", $id)->update([
                    "photo_name" => $uploadPath,
                    "updated_at" => Carbon::now(),
                ]);
            }
        } // end foreach
        $imgs = $request->file("new_img");
        if($imgs){
        foreach ($imgs as $img) {
            $make_name =
                hexdec(uniqid()) . "." . $img->getClientOriginalExtension();
            Image::make($img)
                ->resize(917, 1000)
                ->save("upload/products/multi-image/" . $make_name);
            $uploadPath = "upload/products/multi-image/" . $make_name;

            MultiImg::insert([
                "product_id" => $request->product_id,
                "photo_name" => $uploadPath,
                "created_at" => Carbon::now(),
            ]);
        } // end foreach
    }

        $notification = [
            "message" => "Product Image Updated Successfully",
            "alert-type" => "info",
        ];

        return redirect()
            ->back()
            ->with($notification);
    }
    // Update thambnail image
    public function ThambnailImageUpdate(Request $request)
    {
        $image = $request->file("product_thambnail");
        if($image){
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        // unlink($oldImage);

        $name_gen =
            hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        Image::make($image)
            ->resize(917, 1000)
            ->save("upload/products/thambnail/" . $name_gen);
        $save_url = "upload/products/thambnail/" . $name_gen;

        Product::findOrFail($pro_id)->update([
            "product_thambnail" => $save_url,
            "updated_at" => Carbon::now(),
        ]);

        $notification = [
            "message" => "Product Image Thambnail Updated Successfully",
            "alert-type" => "success",
        ];
    }else{
        $notification = [
            "message" => "No Image Selected",
            "alert-type" => "error",
        ];
    }
        return redirect()
            ->back()
            ->with($notification);
    } // end method

    // Delete image from multi images
    //// Multi Image Delete ////
    public function MultiImageDelete($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);
        $oldimg->delete();

        $notification = [
            "message" => "Product Image Deleted Successfully",
            "alert-type" => "success",
        ];

        return redirect()
            ->back()
            ->with($notification);
    }

    // Activate product
    public function ActivateProduct($id)
    {
        Product::FindOrFail($id)->update(["status" => 1]);
        $notification = [
            "message" => "Product Acivated Successfully",
            "alert-type" => "success",
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    // Inactivate product
    public function InactivateProduct($id)
    {
        Product::FindOrFail($id)->update(["status" => 0]);
        $notification = [
            "message" => "Product Inacivated Successfully",
            "alert-type" => "success",
        ];
        return redirect()
            ->back()
            ->with($notification);
    }
    // Delete Product
    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where("product_id", $id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImg::where("product_id", $id)->delete();
        }

        $notification = [
            "message" => "Product Deleted Successfully",
            "alert-type" => "success",
        ];

        return redirect()
            ->back()
            ->with($notification);
    } // end method
}
