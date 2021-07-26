<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use \Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Api\User\StoreRequest;
use App\Http\Requests\Api\User\UpdateRequest;

class UserController extends Controller
{
    public UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Show paginated users.
     *
     * @return JsonResponse
     */
    public function paginate(): JsonResponse
    {
        $users = $this->users->paginate([], 5);

        return response()->json(['paginator' => $users]);
    }

    /**
     * Show all of the users for the application.
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $users = $this->users->get();

        return response()->json(['users' => $users]);
    }

    /**
     * Show current user data.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(['user' => Auth::user()]);
    }

    /**
     * Show selected user data.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function get(int $id): JsonResponse
    {
        $user = $this->users->findOrFail($id);

        return response()->json(['user' => $user]);
    }

    /**
     * Create user request
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws
     */
    public function store(StoreRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->users->getModel();

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return response()->json(['user' => $user]);
    }

    /**
     * Update user request
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        /** @var User $user */
        $user = $this->users->findOrFail($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');

        //If new password passed
        if ($request->get('password')) {
            //Check current user password
            if ($user->id === $id) {
                if (!Hash::check($request->get('current_password'), $user->password)) {
                    return response()->json([
                        'errors' => [
                            'current_password' => [
                                0 => 'Current password is wrong'
                            ]
                        ]
                    ], 422);
                }
            }
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();

        return response()->json(['user' => $user]);
    }

    /**
     * Delete user request
     *
     * @param int $id
     * @return JsonResponse
     * @throws
     */
    public function delete(int $id): JsonResponse
    {
        /** @var User $user */
        $user = $this->users->findOrFail($id);

        //Remove user from all departments
        $user->departments()->detach();

        //Remove user
        $user->delete();

        $users = User::query()->paginate(5);

        return response()->json(['paginator' => $users]);
    }
}
