<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Utilities\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserServiceInterface $userService) {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = $this->userService->all();
        $users = $this->userService->searchAndPaginate('name',$request->search, 3);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->password != $request->password_confirmation) {
            return back()->with('nofitication','ERROR::Confirm password doesn\'t not match');
        }

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        // Xu ly file
        if($request->hasFile('image')){
            $data['avatar'] = Common::uploadFile($request->file('image'), 'front/img/user'); 

        }

        $user = $this->userService->create($data);

        return redirect('admin/user/'.$user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = $this->userService->find($user->id);
        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Lay du lieu
        $data = $request->all();

        if($data['password'] != ''){
            if($_POST['password'] != $_POST['password_confirmation']){
                return back()->with('nofitication','ERROR::Confirm password doesn\'t not match');
            }
            $data['password'] = bcrypt($_POST['password']);
        }else {
            unset($data['password']);
        }

        // Lay hinh

        if($request->hasFile('image'))
        {
            // Them file moi
            $data['avatar'] = Common::uploadFile($request->image, 'front/img/user');

            // Xoa file cu
            $file_name_old = $request->image_old;
            if($file_name_old != ''){
                unlink('front/img/user/'.$file_name_old);
            }
        }

        $this->userService->update($data, $user->id);
        return redirect('admin/user/'.$user->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userService->delete($user->id);

        // Xoa file cu
        $file_name = $user->avatar;
        if($file_name != ''){
            unlink('front/img/user/'.$file_name);
        }

        return redirect('admin/user')->with('nofitication','Delete Successfully');
        
    }

    
}
