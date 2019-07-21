<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
// use LaravelFCM\Facades\FCMGroup;
// use FCMGroup;

use URL;
use Auth;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        // $user = Auth::user();
        return view('category.index', compact('categories'));
        // return response()->json([
        //     'categories' => $categories,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([ 
            'cat_name' => 'required|max:50',
        ]);

        $categoryName = $request->cat_name; // $_REQUEST['cat_name]
        $newCategory = new Category;
        $newCategory->name = $categoryName;
        $newCategory->user_id = Auth::id();
        $newCategory->save();
        // useres who are admin 
        foreach ($users as $user)
        {
            $this->sendNotification($user->token);
        }
        
        return redirect(URL::route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get category data by id
        $categoryData = Category::find($id);

        return view('category.show', compact('categoryData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryData = Category::find($id);
        return view('category.edit', compact('categoryData'));
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
        // get the old category
        $oldCat = Category::find($id);

        $validatedData = $request->validate([ 
            'cat_name' => 'required|max:50',
        ]);

        $oldCat->name = $request->cat_name; // $_REQUEST['cat_name]
        $oldCat->save();
        
        return redirect(URL::route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return redirect(URL::route('categories.index'));
    }

    private function sendNotification($token)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setBody('Hello world')
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "a_registration_from_your_database";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
    }
}


///////////////////


