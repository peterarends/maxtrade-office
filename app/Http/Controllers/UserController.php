<?php

namespace App\Http\Controllers;

use App\Http\Resources\Users as UserResource;
use App\ProjectsUser;
use App\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class UserController extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }

    public function getUsers()
    {
        /** Get Users */
        $users = User::all();

        /** Return collection of Users as resource */
        return UserResource::collection($users);
    }

    public function getUsersByProject($id = null)
    {
        if (!empty($id)) {
            /** Get Users */
            $usersarr = ProjectsUser::where(['project_id' => $id])->get();
            $usersarr_in = [];
            foreach ($usersarr as $userarr) {
                $usersarr_in[] = $userarr->user_id;
            }
            $users = User::whereIn('id', $usersarr_in)->get();

            /** Return collection of Users as resource */
            return UserResource::collection($users);
        }
    }

    public function getUserById($id = null)
    {
        if (!empty($id)) {
            /** Get User */
            $user = User::findOrFail($id);

            return new UserResource($user);
        }
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            if (!empty($request->input('userid')) && !empty($request->input('projectid'))) {
                $projectsuser_count = ProjectsUser::where(['user_id' => $request->input('userid'), 'project_id' => $request->input('projectid')])->count();
                if ($projectsuser_count == 0) {
                    $projectsuser = new ProjectsUser();
                    $projectsuser->user_id = $request->input('userid');
                    $projectsuser->project_id = $request->input('projectid');
                    if ($projectsuser->save()) {
                        $user = User::where(['id' => $request->input('userid')])->first();
                        return new UserResource($user);
                    } else {
                        return json_encode(["result" => "unsuccess"]);
                    }
                } else {
                    return json_encode(["result" => "user exist"]);
                }
            } else {
                return json_encode(["result" => "unsuccess"]);
            }
        }
    }

    public function deleteUserByProject($user_id = null, $project_id = null)
    {
        if (!empty($user_id) && !empty($project_id)) {
            ProjectsUser::where(['user_id' => $user_id, 'project_id' => $project_id])->delete();
            return json_encode(["result" => "success"]);
        } else {
            return json_encode(["result" => "unsuccess"]);
        }
    }

    public function updateUser(Request $request)
    {
        $user = $request->isMethod('put') ? User::findOrFail($request->input('user_id')) : null;

        if (!empty($user)) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($user->save()) {
                return new UserResource($user);
            }
        }
    }

    public function deleteUser($id = null)
    {
        if (!empty($id)) {
            /** Get User */
            $user = User::findOrFail($id);
            $user->delete();
        }
    }
}
