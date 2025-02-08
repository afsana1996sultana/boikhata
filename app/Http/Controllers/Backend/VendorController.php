<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\User;
use Image;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::orderBy('id', 'desc')->get();
        return view('backend.vendor.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'writer_name'   => 'required',
            // 'phone'         => ['required','regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/','min:11','max:15'],
            // 'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'address'       => 'required',
        ]);

        if($request->hasfile('writer_image')){
            $image = $request->file('writer_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/vendor/'.$name_gen);
            $writer_profile = 'upload/vendor/'.$name_gen;
        }else{
            $writer_profile = '';
        }


        if ($request->slug != null) {
            $slug = preg_replace('/[^A-Za-z0-9\p{Bengali}\-]/u', '', str_replace(' ', '-', $request->slug));
        }else {
            $slug = preg_replace('/[^A-Za-z0-9\p{Bengali}\-]/u', '', str_replace(' ', '-', $request->writer_name)) . '-' . Str::random(5);
        }

        $role = 2;
        $user = User::create([
            'name' => $request->writer_name,
            'username' => $slug,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'profile_image' => $writer_profile,
            'status' => $request->status ? 1 : 0,
            'created_by' => Auth::guard('admin')->user()->id,
            'role' => $role,
        ]);

        $user->role = 2;
        $user->save();

        Vendor::insert([
            'writer_name' => $request->writer_name,
            'writer_image' => $writer_profile,
            'slug' => $slug,
            'user_id'=> $user->id,
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->status ? 1 : 0,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        Session::flash('success','Writer Inserted Successfully');
        return redirect()->route('writer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('backend.vendor.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'writer_name'   => 'required',
            // 'phone'         => ['required','regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/','min:11','max:15'],
            // 'email'         => ['required', 'string', 'email', 'max:255'],
            // 'address'       => 'required',
        ]);

        $vendor = Vendor::find($id);
        if($request->status == Null){
            $request->status = 0;
        }

        $user = User::find($vendor->user_id);
        $user->name = $request->writer_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->status = $request->status;

        $user->save();

        // Vendor table update
        $vendor->writer_name = $request->writer_name;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->status = $request->status;
        $vendor->created_by = Auth::guard('admin')->user()->id;
        $vendor->save();

        //Writer Photo Update
        if($request->hasfile('writer_image')){
            try {
                if(file_exists($vendor->writer_image)){
                    unlink($vendor->writer_image);
                }
            } catch (Exception $e) {
                // Handle the exception (e.g., log the error)
            }

            $writer_profile = $request->writer_image;
            $writer_pro = time().$writer_profile->getClientOriginalName();
            $writer_profile->move('upload/vendor/', $writer_pro);

            $vendor->writer_image = 'upload/vendor/'.$writer_pro;

            if ($user) {
                $user->profile_image = 'upload/vendor/'.$writer_pro;
            } else {

            }
        } else {
            $writer_pro = '';
        }

        $user->save();
        $vendor->save();
        Session::flash('success','Writer Updated Successfully');
        return redirect()->route('writer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $user = $vendor->user_id;
        $users = User::where('id', $user)->first();

        try {
            if(file_exists($vendor->writer_image)){
                unlink($vendor->writer_image);
            }
        } catch (Exception $e) {

        }
        $vendor->delete();
        $users->delete();

        $notification = array(
            'message' => 'Writer Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $vendor = Vendor::find($id);
        $vendor->status = 1;
        $vendor->save();

        Session::flash('success','Writer Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $vendor = Vendor::find($id);
        $vendor->status = 0;
        $vendor->save();

        Session::flash('warning','Writer Inactive Successfully.');
        return redirect()->back();
    }

}
