<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hoa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use function Psy\debug;

class HoaController extends Controller
{
    const PATH = 'admin.products.';
    public function index()
    {
        try {
            //Lấy tất cả sản phẩm
            $products = Hoa::query()
                ->join('categories', 'hoas.category_id', '=', 'categories.id')
                ->select('hoas.*', 'name')
                ->latest('id')
                ->paginate(10);


            return view(self::PATH . __FUNCTION__, compact('products'));
        } catch (\Throwable $th) {
            //Log lỗi
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['errors' => $th->getMessage()]);
            dd($th->getMessage());

            //Lỗi hệ thống
            abort(500);
        }
    }

    public function show($id )
    {
        // Kiểm tra xem đối tượng Hoa có được truyền đúng không
         // Xóa hoặc comment dòng này sau khi kiểm tra xong


        try {
            //Lọc tất cả Hoa
            $hoa = Hoa::query()
                ->join('categories', 'hoas.category_id', '=', 'categories.id')
                ->select('hoas.*', 'name')
                ->findOrFail($id);


                

                
            return view(self::PATH . __FUNCTION__, compact('hoa'));
        } catch (\Throwable $th) {
            //Log lỗi
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['errors' => $th->getMessage()]);
            // dd($th->getMessage());

        }

    }


    public function destroy($id)
    {
        try {
            //Xóa danh mục
            DB::table('hoas')->where('id', $id)->delete();

            return redirect()->route('products.index')->with('success', true);
        } catch (\Throwable $th) {
            //Log lỗi
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['errors' => $th->getMessage()]);

            //Chuyển về trang chủ với thông báo khi có lỗi
            return redirect()->route('products.index')->with('success', 'Xóa không thành công');

            // //Kiểu tra tài nguyên tồn tại không
            // abort_if(empty($Hoa), 404);

            // //Lỗi hệ thống
            // abort(500);
        }
    }

    public function create()
    {
        $categories = Category::all();
        return view(self::PATH . __FUNCTION__);
    }

    public function store(Request $request)
    {
        $data = $request->except('image');

        try {


            //Thêm mới danh mục
            $path = '';
            if($request->hasFile('image')){
                $path = $request->file('image')->store('images');
            }
            $data['image'] = $path;
            
            Hoa::query()->create($data);
            // dd($data);


            //Chuyển về trang chủ nếu thành công
            return redirect()->route('products.index')->with('success', true);
        } catch (\Throwable $th) {
            //Log lỗi
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['errors' => $th->getMessage()]);
            // dd($th->getMessage());

            //Chuyển về trang chủ với thông báo khi có lỗi
            return back()->with('success', 'Lỗi hệ thống');
        }
    }

    public function edit( $id)
    {
        $hoa = Hoa::query()
                ->join('categories', 'hoas.category_id', '=', 'categories.id')
                ->select('hoas.*', 'name')
                ->findOrFail($id);

        // dd($id);
        return view(self::PATH . __FUNCTION__, compact('hoa'));
    }

    public function update(Hoa $hoa, Request $request)
    {
        //Kiểm tra validate
       
    
        try {
            //Thêm mới sản phẩm
             $data = $request->except( 'image');
             if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images');
                Storage::delete($hoa->image);
                $data['image'] = $path;
            }
           
            $hoa->update($data);
            dd($data);
            //Chuyển về trang chủ nếu thành công
            return redirect()->route('products.edit', $hoa)->with('success', true);
        } catch (\Throwable $th) {
            //Log lỗi
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['errors' => $th->getMessage()]);
          
            //Chuyển về trang chủ với thông báo khi có lỗi
            return back()->with('success', 'Lỗi hệ thống');
        }
    }

    public function products(Hoa $Hoa)
    {
        try {
            //lấy tất cả sản phẩm thuộc danh mục này (mối quan hệ)
            $products = $Hoa->load('products')->products()->paginate(10);

            return view(self::PATH . __FUNCTION__, compact('Hoa', 'products'));
        } catch (\Throwable $th) {
            //Log lỗi
            Log::error(__CLASS__ . '@' . __FUNCTION__, ['errors' => $th->getMessage()]);

            //Lỗi hệ thống
            abort(500);
        }
    }
}
