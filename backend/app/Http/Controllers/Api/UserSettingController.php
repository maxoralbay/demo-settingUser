<?php
// Controller for UserSetting
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserSettingRepositoryInterface;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Repositories\Notificator;

class UserSettingController extends Controller
{
    protected $userSettingRepository;

    public function __construct(UserSettingRepositoryInterface $userSettingRepository)
    {
        $this->userSettingRepository = $userSettingRepository;
    }

    public function getSettingByKey(Request $request)
    {
        try {
            //validate request
            $request->validate([
                'key' => 'required'
            ]);
            // prepare data
            // sent repository
            $userId = $request->user()->id;
            $key = $request->input('key');
            $setting = $this->userSettingRepository->getSettingByKey($userId, $key);
            return response()->json([
                'setting' => $setting
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /***
     * Update or create user setting
     * example request
     * {
     *     "key": "email_verified",
     *     "value": "true"
     * }
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSetting(Request $request, int $userId)
    {
        // if not exist userid or user not found then return error
        $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        //validate request
        $request->validate([
            'key1' => 'required',
            'key2' => 'required',
            // 'code' => 'required',
            'method' => 'required',
        ]);
        // prepare data
        // sent repository
        // get user id from url
        $key1 = $request->input('key1');
        $key2 = $request->input('key2');
        //print_r([$userId, $key, $value]);
        $data = [
            'key1' => $key1,
            'key2' => $key2,
        ];
        $this->userSettingRepository->updateSetting($userId, $key1, $key2);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function sendNotification(Request $request)
    {
        try {
            // validate request
            $request->validate([
                'method' => 'required',
                'method_address' => 'required',
                'user_id' => 'required'
            ]);
            // prepare data
            $user_id = $request->input('user_id');
            $method = $request->input('method');
            $opts = ['address' => $request->input('method_address')];

            $code = Helper::generateRandomString();
            // send code
            $notificator = new Notificator($user_id, $method);
            $sent = $notificator->sendMessage($code, $opts);
            return response()->json([
                'sent' => $sent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
