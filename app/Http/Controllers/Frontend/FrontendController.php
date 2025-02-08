<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use Carbon\Carbon;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\MultiImg;
use App\Models\Page;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Blog;
use App\Models\Vendor;
use App\Models\Supplier;
use App\Models\Contact;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Utility\CategoryUtility;


class FrontendController extends Controller
{
    /*=================== Start Index Methoed ===================*/
    public function index(Request $request)
    {
        $products = Product::where('status', 1)->where('is_featured', 1)->orderBy('id', 'DESC')->get();
        // Search Start
        $sort_search = null;
        if ($request->has('search')) {
            $sort_search = $request->search;
            $products = $products->where('name_en', 'like', '%' . $sort_search . '%');
            // dd($products);
        } else {
            $products = Product::where('status', 1)->where('is_featured', 1)->orderBy('id', 'DESC')->get();
        }
        //Top Selling Products
        $TopSellingProducts = Product::where('status', 1)->where('top_selling', 1)->orderBy('id', 'DESC')->get();

        //New Arrival Products
        // $NewArrivalProducts = Product::where('status', 1)->where('new_arrival', 1)->orderBy('id', 'DESC')->get();
        // Header Category Start
        $categories = Category::orderBy('id', 'DESC')->where('status', '=', 1)->where('is_featured', 1)->get();
        // Category Featured all
        $featured_category = Category::orderBy('name_en', 'DESC')->where('is_featured', '=', 1)->where('status', '=', 1)->get();
        // Special Category
        $special_category = Category::orderBy('name_en', 'DESC')->where('special', '=', 1)->where('status', '=', 1)->get();
        //Slider
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(10)->get();
        // Product Top Selling
        $product_top_sellings = Product::where('status', 1)->orderBy('id', 'ASC')->limit(2)->get();
        //Product Trending
        $product_trendings = Product::where('status', 1)->orderBy('id', 'ASC')->skip(2)->limit(2)->get();
        //Product Recently Added
        $product_recently_adds = Product::where('status', 1)->latest()->skip(2)->limit(2)->get();

        $product_top_rates = Product::where('status', 1)->orderBy('regular_price')->limit(2)->get();
        // Home Banner
        $home_banners = Banner::where('status', 1)->limit(3)->where('position', 1)->orderBy('id', 'DESC')->get();
        $home_banners_1 = Banner::where('status', 1)->skip(3)->limit(3)->where('position', 1)->orderBy('id', 'DESC')->get();
        $home_banners_2 = Banner::where('status', 1)->skip(6)->limit(3)->where('position', 1)->orderBy('id', 'DESC')->get();
        $home_banners_3 = Banner::where('status', 1)->skip(9)->limit(3)->where('position', 1)->orderBy('id', 'DESC')->get();
        // Daily Best Sells
        $todays_sale  = OrderDetail::where('created_at', 'like', '%' . date('Y-m-d') . '%')->get();
        $todays_sale = $todays_sale->unique('product_id');
        //dd($todays_sale);
        //Home2 featured category

        $home2_featured_categories = Category::where('is_featured', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        foreach ($home2_featured_categories as $home2_featured_category) {
            $fcat_products = [];
            $category_ids = CategoryUtility::children_ids($home2_featured_category->id);
            $category_ids[] = $home2_featured_category->id;

            // Eager load products for the current category
            $fcat_products = Product::whereIn('category_id', $category_ids)
                ->where('status', 1)
                ->limit(10)
                ->latest()
                ->get();

            $home2_featured_category->cat_products = $fcat_products;
        }

        $trending_cats = Category::where('trending', '=', 1)->where('status', '=', 1)->latest()->limit(1)->get();
        $package_books = Product::where('status', 1)->where('package_book', 1)->orderBy('id', 'DESC')->limit(6)->get();

        $categoriesIds = $trending_cats->pluck('id')->toArray();
        $trending__subcategory = Category::whereIn('parent_id', $categoriesIds)->get();

        $subcategoriesIds = $trending__subcategory->pluck('id')->toArray();
        $subcategory_trending_products = Product::whereIn('category_id', $subcategoriesIds)->get();
        $home_view = 'frontend.home';

        return view($home_view, compact('categories', 'sliders', 'featured_category', 'trending_cats', 'subcategory_trending_products', 'trending__subcategory',
        'products', 'product_top_sellings', 'product_trendings', 'product_recently_adds', 'product_top_rates', 'home_banners', 'sort_search', 'todays_sale', 'home2_featured_categories',
        'home_banners_1', 'home_banners_2', 'special_category', 'home_banners_3','TopSellingProducts', 'package_books'));
    } // end method


    public function AllBlogs(Request $request)
    {
        $blogs = Blog::latest('id', 'asc')->get();
        return view('frontend.blog.all_blogs', compact('blogs'));
    }

    public function blogDetails($slug)
    {
        $blogs = Blog::limit(15)->latest('id', 'asc')->get();
        $blog__details = Blog::where('slug', $slug)->first();
        // return $blog__details;
        return view('frontend.blog.blog__details', compact('blog__details', 'blogs'));
    }

    /* ========== Start ProductDetails Method ======== */
    public function productDetails($slug)
    {

        $product = Product::where('slug', $slug)->first();
        if ($product) {
            if ($product->id) {
                $multiImg = MultiImg::where('product_id', $product->id)->get();
            }

            /* ================= Product Color Eng ================== */
            $color_en = $product->product_color_en;
            $product_color_en = explode(',', $color_en);

            /* ================= Product Size Eng =================== */
            $size_en = $product->product_size_en;
            $product_size_en = explode(',', $size_en);

            /* ================= Realted Product =============== */
            $cat_id = $product->category_id;
            $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $product->id)->orderBy('id', 'DESC')->get();

            $categories = Category::orderBy('name_en', 'ASC')->where('status', '=', 1)->limit(5)->get();
            $new_products = Product::orderBy('name_en')->where('status', '=', 1)->limit(3)->latest()->get();
            $home_banners = Banner::where('status', 1)->limit(3)->where('position', 1)->orderBy('id', 'DESC')->get();

            $today = Carbon::now();
            $thirty_days_ago = Carbon::today()->subDays(30)->startOfDay();
            $last_30_days_sales = OrderDetail::whereBetween('created_at', [$thirty_days_ago, $today])->get()->unique('product_id');
            //dd($last_30_days_sales);


            return view('frontend.product.product_details', compact('product', 'multiImg', 'categories', 'new_products', 'product_color_en', 'product_size_en', 'relatedProduct', 'home_banners', 'last_30_days_sales'));
        }

        return view('frontend.product.productNotFound');
    }

    /* ========== Start CatWiseProduct Method ======== */
    public function CatWiseProduct(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        // Top filter Start
        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if ($brand_id != null) {
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        } elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products_sort_by = Product::where($conditions);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc')->paginate(30)->appends(request()->query());
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc')->paginate(30)->appends(request()->query());
                break;
            default:
                $products_sort_by->orderBy('id', 'desc')->paginate(30)->appends(request()->query());
                break;
        }
        // Top filter End

        $min_price = $request->get('filter_price_start');
        $max_price = $request->get('filter_price_end');

        $conditions = ['status' => 1];

        if ($request->brand_id != null && $request->brand_id > 0) {
            $conditions = array_merge($conditions, ['brand_id' => $request->brand_id]);
        }

        $products = Product::where($conditions);

        if ($min_price != null && $max_price != null) {
            $products->where('regular_price', '>=', $min_price)->where('regular_price', '<=', $max_price);
        }

        $category_ids = CategoryUtility::children_ids($category->id);
        $category_ids[] = $category->id;
        $products->whereIn('category_id', $category_ids);

        $products = $products->orderBy('created_at', 'desc')->paginate(30)->appends(request()->query());

        $categories = Category::orderBy('name_en', 'ASC')->where('status', '=', 1)->get();
        // dd($products);
        $subcategories = Category::orderBy('name_en', 'ASC')->where('status', 1)->where('parent_id', $category->id)->get();

        return view('frontend.product.category_view', compact('products', 'categories', 'category', 'sort_by', 'brand_id', 'subcategories'));
    } // end method
    /* ========== End CatWiseProduct Method ======== */

    /* ========== Start CatWiseProduct Method ======== */
    public function VendorWiseProduct(Request $request, $slug)
    {
        //dd($slug);
        $vendor = Vendor::where('slug', $slug)->first();
        //dd($vendor);

        $products = Product::where('status', 1)->where('vendor_id', $vendor->user_id)->orderBy('id', 'DESC')->paginate(30)->appends(request()->query());
        // Price Filter
        if ($request->get('filter_price_start') !== Null && $request->get('filter_price_end') !== Null) {
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start > 0 && $filter_price_end > 0) {
                $products = Product::where('status', '=', 1)->where('vendor_id', $vendor->user_id)->whereBetween('regular_price', [$filter_price_start, $filter_price_end])->paginate(30)->appends(request()->query());
                // dd($products);
            }
        }

        $categories = Category::orderBy('name_en', 'ASC')->where('status', '=', 1)->get();
        // dd($products);

        return view('frontend.product.vendor_view', compact('products', 'categories', 'vendor'));
    } // end method
    /* ========== End CatWiseProduct Method ======== */


    public function PublicationWiseProduct(Request $request, $id)
    {

        $supplier = Supplier::where('id', $id)->first();
        // dd($category);

        $products = Product::where('status', 1)->where('supplier_id', $supplier->id)->orderBy('id', 'DESC')->paginate(30)->appends(request()->query());
        // Price Filter
        if ($request->get('filter_price_start') !== Null && $request->get('filter_price_end') !== Null) {
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start > 0 && $filter_price_end > 0) {
                $products = Product::where('status', '=', 1)->where('supplier_id', $supplier->id)->whereBetween('regular_price', [$filter_price_start, $filter_price_end])->paginate(30)->appends(request()->query());
                // dd($products);
            }
        }

        $categories = Category::orderBy('name_en', 'ASC')->where('status', '=', 1)->get();
        // dd($products);

        return view('frontend.product.supplier_view', compact('products', 'categories', 'supplier'));
    }


    /* ================= Start ProductViewAjax Method ================= */
    public function ProductViewAjax($id)
    {

        $product = Product::with('category', 'brand')->findOrFail($id);
        //dd($product);
        $attribute_values = json_decode($product->attribute_values);

        $attributes = new Collection;
        foreach ($attribute_values as $key => $attribute_value) {
            $attr = Attribute::select('id', 'name')->where('id', $attribute_value->attribute_id)->first();
            // $attribute->name = $attr->name;
            // $attribute->id = $attr->id;
            $attr->values = $attribute_value->values;
            $attributes->add($attr);
        }


        return response()->json(array(
            'product' => $product,
            'attributes' => $attributes,
        ));
    }
    /* ================= END PRODUCT VIEW WITH MODAL METHOD =================== */

    /* ========== Start AllFeaturedProduct Method ======== */
    public function AllFeaturedProduct(Request $request){
        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }
        $products_sort_by = Product::where($conditions);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc');
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc');
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc');
                break;
            default:
                $products_sort_by->orderBy('id', 'desc');
                break;
        }
        // Hot deals product
        $products = Product::where('status', 1)->where('is_featured', 1)->orderBy('id','DESC')->paginate(30)->appends(request()->query());

        if ($request->has('filtercategory')) {
            $checked = $request->input('filtercategory');
            $category_filter = Category::whereIn('name_en', $checked)->get();

            $category_ids = [];
            foreach ($category_filter as $cat) {
                $category_ids = array_merge($category_ids, CategoryUtility::children_ids($cat->id));
                $category_ids[] = $cat->id;
            }

            $products = Product::where('status', 1)->whereIn('category_id', $category_ids)->orderBy('id','DESC')->paginate(30)->appends(request()->query());
        }

        return view('frontend.product.featuredproduct_view',compact('products','brand_id','sort_by'));
    } // end method
    /* ========== End AllFeaturedProduct Method ======== */


    public function pageAbout($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('frontend.settings.page.about', compact('page'));
    }

    public function orderTracking()
    {
        return view('frontend.settings.page.order_tracking');
    }

    public function privacyPolicy()
    {
        return view('frontend.settings.page.privacy_policy');
    }


    public function termsService()
    {
        return view('frontend.settings.page.terms_service');
    }


    public function termCondition()
    {
        return view('frontend.settings.page.terms_condition');
    }


    public function orderTrack(Request $request)
    {
        $this->validate($request, [
            'invoice_no' => 'required',
            'phone' => 'required',
        ]);
        $order = Order::where('invoice_no', $request->invoice_no)->where('phone', $request->phone)->first();
        if (!$order) {
            $notification = array(
                'message' => 'Required Data Not Found.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        // dd($order);
        return view('frontend.settings.page.track', compact('order'));
    }

    /* ================= Start Product Search =================== */
    public function ProductSearch(Request $request)
    {
        //dd($request);
        if($request->search == null){
            return view('frontend.product.NosearchResult');
        }else{
            // Retrieve filter parameters
            $sort_by = $request->sort_by;
            $brand_id = $request->brand;
            $conditions = ['status' => 1];
            $products_query = Product::where($conditions);

            // Retrieve search parameters
            $item = $request->search;
            $category_id = $request->searchCategory;
            $categories = Category::orderBy('name_en', 'DESC')->where('status', 1)->get();
            $writer = Vendor::where('writer_name', 'LIKE', "%$item%")->first();
            $publication = Supplier::where('name', 'LIKE', "%$item%")->first();

            // Prepare product query with search and category filters
            if ($category_id == 0) {
                $products_query->where(function ($query) use ($item, $writer, $publication) {
                    $query->where('name_en', 'LIKE', "%$item%")
                        ->orWhere('name_bn', 'LIKE', "%$item%");

                    if ($writer) {
                        $query->orWhere('vendor_id', $writer->user_id);
                    }
                    if ($publication) {
                        $query->orWhere('supplier_id', $publication->id);
                    }
                });
            } else {
                $products_query->where('category_id', $category_id)
                            ->where(function ($query) use ($item, $writer, $publication) {
                    $query->where('name_en', 'LIKE', "%$item%")
                        ->orWhere('name_bn', 'LIKE', "%$item%");

                    if ($writer) {
                        $query->orWhere('vendor_id', $writer->user_id);
                    }
                    if ($publication) {
                        $query->orWhere('supplier_id', $publication->id);
                    }
                });
            }
            $products = $products_query->paginate(30)->appends(request()->query());
            return view('frontend.product.search', compact('products', 'categories', 'sort_by', 'brand_id'));
        }
    }// end method

    /* ================= End Product Search =================== */
    public function advanceProduct(Request $request)
    {
        $request->validate(["search" => "required"]);
        $item = $request->search;
        $writers = Vendor::where('writer_name', 'LIKE', "%$item%")->where('status',1)->latest()->get();
        $publications = Supplier::where('name', 'LIKE', "%$item%")->where('status',1)->latest()->get();
        $products_query = Product::query();
        $products_query->where(function ($query) use ($item, $writers, $publications) {
            $query->where('name_en', 'LIKE', "%$item%")
                ->orWhere('name_bn', 'LIKE', "%$item%");

            if ($writers->isNotEmpty()) {
                $query->orWhereIn('vendor_id', $writers->pluck('user_id'));
            }

            if ($publications->isNotEmpty()) {
                $query->orWhereIn('supplier_id', $publications->pluck('id'));
            }
        });
        $products = $products_query->where('status', 1)->latest()->get();
        //dd($products);

        // Return the view with the results
        return view('frontend.product.advance_search', compact('products'));
    }


    /* ================= End Advance Product Search =================== */

    /* ================= Start Hot Deals Page Show =================== */
    public function hotDeals(Request $request)
    {
        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if ($brand_id != null) {
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        } elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products_sort_by = Product::where($conditions);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc')->paginate(30)->appends(request()->query());
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc')->paginate(30)->appends(request()->query());
                break;
            default:
                $products_sort_by->orderBy('id', 'desc')->paginate(30)->appends(request()->query());
                break;
        }
        // Hot deals product
        $products = Product::where('status', 1)->where('is_deals', 1)->paginate(30)->appends(request()->query());

        // Category Filter Start
        if ($request->get('filtercategory')) {

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('name_en', $checked)->get();
            $catId = [];
            foreach ($category_filter as $cat_list) {
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->where('is_deals', 1)->latest()->paginate(30)->appends(request()->query());
            // dd($products);
        }
        // Category Filter End

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        // End Shop Product //
        return view('frontend.deals.hot_deals', compact('attributes', 'products', 'sort_by', 'brand_id'));
    } // end method


    /* ================= Start Campaign Page Show =================== */
    public function Campaign(Request $request)
    {
        // Header Category Start
        $categories = Category::orderBy('name_en','DESC')->where('status', 1)->get();

        // Sort and brand filter Start
        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }elseif ($request->brand != null) {
            $brand_id = (Brand::where('id', $request->brand)->first() != null) ? Brand::where('id', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products_sort_by = Product::where($conditions);
        switch ($sort_by) {
            case 'newest':
                $products_sort_by = $products_sort_by->orderBy('created_at', 'desc')->paginate(30)->appends(request()->query());
                break;
            case 'oldest':
                $products_sort_by = $products_sort_by->orderBy('created_at', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-asc':
                $products_sort_by = $products_sort_by->orderBy('regular_price', 'asc')->paginate(30)->appends(request()->query());
                break;
            case 'price-desc':
                $products_sort_by = $products_sort_by->orderBy('regular_price', 'desc')->paginate(30)->appends(request()->query());
                break;
            default:
                $products_sort_by = $products_sort_by->orderBy('id', 'desc')->paginate(30)->appends(request()->query());
                break;
        }

        $products = Product::orderBy('name_en', 'ASC')->where('brand_id', $brand_id)->latest()->paginate(30)->appends(request()->query());

        $min_price = $request->get('filter_price_start');
        $max_price = $request->get('filter_price_end');
        //dd($min_price);
        if($min_price != null && $max_price != null){
            $products = Product::orderBy('name_en', 'ASC')->where('status', 1)->where('regular_price', '>=', $min_price)->where('regular_price', '<=', $max_price)->paginate(30)->appends(request()->query());
            // dd($products);
        }

        // Category Filter Start
        if ($request->get('filtercategory')){

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('name_en', $checked)->get();
            $catId = [];
            foreach($category_filter as $cat_list){
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->latest()->paginate(30)->appends(request()->query());
            //dd($products);
            // dd($products);
        }

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        // End Shop Product //

        return view('frontend.product.campaing', compact('categories','attributes','products','sort_by','brand_id'));
    }

    public function contact()
    {
        return view('frontend.contact');
    } // end method

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);


        Session::flash('success', 'Thank you for Contact us');
        return redirect()->back();
    }

    public function hot_deals()
    {
        $hot_deals = Product::where('status', 1)->where('is_deals', 1)->orderBy('id', 'desc')->get();
        // return $hot_deals;
        return view('frontend.deals.hot_deals', compact('hot_deals'));
    }
    public function returnPolicy(){
        return view('frontend.settings.page.return_policy');
    }

    public function refundPolicy(){
        return view('frontend.settings.page.refund_policy');
    }


    public function AuthorList()
    {
        $authors = Vendor::orderBy('id','ASC')->where('status','=',1)->paginate(48);
        return view('frontend.authors.index',compact('authors'));
    }

    public function PublicationList()
    {
        $publications = Supplier::orderBy('id','ASC')->where('status','=',1)->paginate(48);
        return view('frontend.publications.index',compact('publications'));
    }
}
