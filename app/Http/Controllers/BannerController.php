<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Input;

class BannerController extends Controller
{
    public function addBanner(Request $request){

        if($request->isMethod('post')){

            $data =$request->all();
            //echo '<pre>'; print_r($data); die;

            $banner = new Banner();
            $banner->title = $data['title'];
            $banner->link = $data['link'];

            //upload image

            if($request->hasFile('image')){
                $image_tmp =Input::file('image');
                if($image_tmp->isValid()){
                    $extension =$image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,9999).'.'.$extension;
                    $banner_file_path ='images/frontend_images/banner/'.$fileName;

                    //Resize Image

                    Image::make($image_tmp)->resize(1140,340)->save($banner_file_path);

                    //Save fie name
                    $banner->image = $fileName;
                }

            }

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status =1;
            }

            $banner->status = $status;
            $banner->save();
            return redirect()->to('/admin/add-banner')->with('message','Banner has been added successfully');


        }

        return view('admin.banners.add_banner');
    }

    public function viewBanners(){
        $banners =Banner::get();

        return view('admin.banners.view_banners')->with(compact('banners'));

    }

    public function editBanner(Request $request, $id){

        if($request->isMethod('post')){
            $data =$request->all();

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status =1;
            }


            if(empty($data['title'])){
                $data['title'] = "";
            }

            if(empty($data['link'])){
                $data['link'] = "";
            }

            //upload image

            if($request->hasFile('image')){
                $image_tmp =Input::file('image');
                if($image_tmp->isValid()){
                    $extension =$image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,9999).'.'.$extension;
                    $banner_file_path ='images/frontend_images/banner/'.$fileName;

                    //Resize Image

                    Image::make($image_tmp)->resize(1140,340)->save($banner_file_path);


                }

            }elseif (!empty($data['current_image'])){
                $fileName = $data['current_image'];
            }else {
                $fileName = "";
            }

            Banner::where('id',$id)->update([
                'image' => $fileName,
                'title' => $data['title'],
                'link' => $data['link'],
                'status' => $status,
            ]);

            return redirect()->to('/admin/view-banners')->with('message','Banner updated successfully');

        }

        $banner =Banner::where('id',$id)->first();

        return view('admin.banners.edit_banner')->with(compact('banner'));

    }

    public function deleteBanner($id){
        Banner::where('id',$id)->delete();
        return redirect()->back()->with('message1','Banner deleted successfully');
    }

}
