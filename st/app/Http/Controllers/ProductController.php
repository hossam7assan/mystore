<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availbleCats = Category::all();
        return view('product.create', compact('availbleCats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newProduct = new Product;
        $newProduct->name = $request->prod_name;
        $newProduct->price = $request->prod_price;
        $newProduct->description = $request->prod_desc;

        // add new photo
        // first : call method that will save photo
        $result = $this->savePhoto($request);
        if($result[0])
        {
            // photo uploaded successfully
            // insert name to the db
            $newProduct->photo = $result[1];
        }
        else
        {
            return redirect()->back()->with('message', 'Failed to Save Product');
        }
        // end of adding photo
        // add category foreign key
        $newProduct->category_id = $request->prod_cat;
       
        $newProduct->save();
        return "added succefully";
        

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // function to save photos
    private function savePhoto($request)
    {
        $output = false;
        $file = $request->file('prod_photo'); // $_FILES['prod_photo]
        $name = $file->getClientOriginalName();
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        // dd($name , $ext);
        $newName = $this->renameFile($ext);
        // call a function to make sure that 
        // new name file is not exist in old photos
        // $x = false;
        // do
        // {
        //     $res = $this->checkFileExistance($newName);
        //     if(! $res)
        //     {
        //         $newName = $this->generateRandomString();
        //         $x = true;
        //     }
        // }
        // while($x)


        // dd($newName);
        if($file->move('product',$newName))
        {
            $output = true;
            return [$output , $name ];
        }
        return $output;
    }

    private function renameFile( $ext)
    {
        $new_name = $this->generateRandomString();
        return $new_name . "." .$ext; 
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function checkFileExistance($name)
    {
        // search in file system photos
        // products folder under public

        return TRUE; // incase of file not exist
        return FALSE; // incase of file exist
    }
}
