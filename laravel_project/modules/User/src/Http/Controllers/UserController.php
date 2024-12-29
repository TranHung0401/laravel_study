<?php
namespace Modules\User\src\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepository;

class UserController extends Controller 
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function index() {
        $pageTitle = "Manager user";

        // $users = $this->userRepo->getUser(5);

        $check = $this->userRepo->checkPassword('123',1);

        return view('user::list', compact('pageTitle'));
    }   

    public function data() {
        $users = $this->userRepo->getAllUsers();
        return DataTables::of($users)
        ->addColumn('edit', function($users) {
            return "<a class='btn btn-warning' href='".route('admin.users.edit',$users)."'>Edit</a>";
        })
        ->addColumn('delete', function($users) {
            return '<a class="btn btn-danger">Delete</a>';
        })
        ->editColumn('created_at', function($users) {
            return Carbon::parse($users->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])
        ->toJson();
    }
    
    public function create() {
        $pageTitle = "Create user";
        return view('user::add', compact('pageTitle'));
    } 

    public function store(UserRequest $request) {
        $this->userRepo->create([
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('msg',__('user::messages.create.success'));
    }

    public function edit($id) {

        $user = $this->userRepo->find($id);
        $pageTitle = "Edit user";

        if(!$user){
            abort(404);
        }

        return view('user::edit',compact('user','pageTitle'));

    }

    public function update(UserRequest $request,$id) {
        // if(!empty($request->password)){
        //     $password = bcrypt($request->password);
        // }
        $data = $request->except('_token','password');

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $this->userRepo->update($data, $id);

        return back()->with('msg',__('user::messages.update.success'));
    }
}