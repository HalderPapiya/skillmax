<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Controllers\BaseController;

class BannerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::get();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|max:200',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'link' => 'required|url',
        ]);

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->link = $request->link;
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->image->extension());
            $request->image->move(public_path('uploads/banner/'), $fileName);
            $image = 'uploads/banner/' . $fileName;
        }
        $banner->image =  $image;
        $banner->save();

        // dd('done');

        return $this->responseRedirect('admin.banner.index', 'Banner has been created successfully', 'success', false, false);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $bannerId = $request->id;

        Banner::where('id', $bannerId)->update([
            'status' => $request->status,
        ]);

        return response()->json(array('message' => 'Banner status has been successfully updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'link' => 'required|url',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/banner/'), $fileName);
            $image = 'uploads/banner/' . $fileName;
            Banner::where('id', $id)->update([
                'image' => $image,
            ]);
        }


        Banner::where('id', $id)->update([
            'title' => $request->title,
            'link' => $request->link,
        ]);
        return $this->responseRedirectBack('Banner has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::where('id', $id)->delete();
        return $this->responseRedirect('admin.banner.index', 'Banner has been deleted successfully', 'success', false, false);
    }
}