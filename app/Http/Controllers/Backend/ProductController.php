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

use App\Models\MultiImg;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    use StoreTrait;

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
        }
        
        return redirect()
            ->back()
            ->with($res["notification"]);
    }
}
