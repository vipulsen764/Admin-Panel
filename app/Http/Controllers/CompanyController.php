<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        if(session()->has('user')){
        $companies = Company::orderBy('id','desc')->paginate(10);

            return view('admin.companydetails',['companies'=>$companies]);
        }
        return redirect('/admin_login');
    }

    public function addcompany()
    {
        if(session()->has('user')){

            return view('admin.addcompany');
        }
        return redirect('/admin_login');
  
    }



    public function addcompanydata(Request $request)
    {
        // echo "hello";die;
        $this->validate($request, [
            'Name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $filename = "";
        // if($request->hasFile('logo')){
        //     $image = $request->file('logo');
        //     $filename = time().uniqid().$image->getClientOriginalName();
        //     $image->move(public_path('storage'),$filename);

        //     // Image::make($image)->resize(300, 300)->save( storage_path('/uploads/' . $filename ) );
        // }
        
        if(!empty($request->cimage)){
            $filename = $request->cimage;
           
      
        }else{
          if(isset($request->logo)){
            
            $logo = $_FILES['logo']['tmp_name'];
            $filename = date('YmdHi').uniqid().$_FILES['logo']['name'];
            $uploadDir = public_path('storage/');
            $targetFile = $uploadDir . $filename;
            $aspectRatio = 1;
            
            // Load the uploaded image
            if(!empty(imagecreatefromjpeg($logo))){

                $image = imagecreatefromjpeg($logo);
            } else{

                $image = imagecreatefrompng($logo);
            }
            
            // Get the current width and height of the image
            $width = imagesx($image);
            $height = imagesy($image);
            
            // Calculate the new dimensions based on the desired aspect ratio
            if ($width < $height) {
                $newWidth = $width;
                $newHeight = $width / $aspectRatio;
            } else {
                $newWidth = $height * $aspectRatio;
                $newHeight = $height;
            }
            
            // Create a new image resource with the new dimensions
            $newImage = imagecreatetruecolor(100, 100);
            
            // Copy and resize the original image to the new image
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, 100, 100, $width, $height);
            
            // Save the resized image to a file
            imagejpeg($newImage, $targetFile, 80);
            
            // Destroy the image resources to free up memory
            imagedestroy($image);
            imagedestroy($newImage);
      
         
        }

    }
        

        $add = new Company;
        $add->Name = ucfirst($request->Name);
        $add->email = $request->email;
        $add->logo = $filename;
        $add->website_url = $request->website_url;
        $add->save();

    return redirect()->back()->with('success','Company Added Successfully');
    }

    public function editcompany($id)
    {
       $company = Company::find($id);
       if(session()->has('user')){

        return view('admin.editcompany',compact('company'));
    }
    return redirect('/admin_login');
    }

public function editcompanydata(Request $request)
{
    
    $this->validate($request, [
        'Name' => 'required',
        'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);


    $edit =Company::find($request->id);
    $edit->Name = ucfirst($request->Name);
    $edit->email = $request->email;

    // if($request->hasFile('logo')){
    //     $image = $request->file('logo');
    //     $filename = time().uniqid().$image->getClientOriginalExtension();
    //     // $request->logo->storeAs('public', $filename);
    //     $image->move(public_path('storage'),$filename);
    //     $edit->logo = $filename;
    // }

    if(!empty($request->cimage)){
        $filename = $request->cimage;
       $edit->logo = $filename;
  
    }else{
      if(isset($request->logo)){
        
        $logo = $_FILES['logo']['tmp_name'];
        $filename = date('YmdHi').uniqid().$_FILES['logo']['name'];
        $uploadDir = public_path('storage/');
        // $uploadDir = 'public/storage/';
        $targetFile = $uploadDir.$filename;
        $aspectRatio = 1;
        
        // Load the uploaded image
    
            $image = imagecreatefromjpeg($logo);
       
        
        
        // Get the current width and height of the image
        $width = imagesx($image);
        $height = imagesy($image);
        
        // Calculate the new dimensions based on the desired aspect ratio
        if ($width < $height) {
            $newWidth = $width;
            $newHeight = $width / $aspectRatio;
        } else {
            $newWidth = $height * $aspectRatio;
            $newHeight = $height;
        }
        
        // Create a new image resource with the new dimensions
        $newImage = imagecreatetruecolor(100, 100);
        
        // Copy and resize the original image to the new image
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, 100, 100, $width, $height);
        
        // Save the resized image to a file
        imagejpeg($newImage, $targetFile, 80);
        
        // Destroy the image resources to free up memory
        imagedestroy($image);
        imagedestroy($newImage);
        $edit->logo = $filename;
     
    }
}

    $edit->website_url = $request->website_url;
    $edit->save();

return redirect()->back()->with('success','Company Updated Successfully');
}
 public function deletecompany(Request $request,$id)
 {
   
    //  $id = $request->id;
       $company =Company::find($id);
       $company->delete();
       if(session()->has('user')){

        // return view('admin.addcompany');
        return redirect()->back()->with('success'."Deleted");
    }
    return redirect('/admin_login');
 }


 public function imagedata()
  {
      return view('cropper');
  }

  public function upload(Request $request)
  {

      // echo "hello"; die;

      $folderPath = public_path('storage/');

      // $folderPath =  "public/images/";

      $image_parts = explode(";base64,", $request->image);
      $image_type_aux = explode("image/", $image_parts[0]);
      $image_type = $image_type_aux[1];
      $image_base64 = base64_decode($image_parts[1]);

      $imageName = uniqid() . '.jpg';
      $file = $folderPath . $imageName;
      file_put_contents($file, $image_base64);

      $path = '	http://127.0.0.1:8000/storage/'.$imageName;


      return response()->json(['imageName' => $imageName, 'path' => $path]);
  }

}
