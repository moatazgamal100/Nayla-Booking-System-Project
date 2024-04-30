<?php
namespace App\Http\Traits;
trait ApiHandler
{
    public function Success($data = null,$message, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
    public function Createed($data = null,$message, $code = 201)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
    public function notFound($message, $code = 404)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ], $code);
    }
    public function loginSuccess($message,$token, $user = null,$is_admin=false, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'token' => $token,
            'user' => $user,
            'is_admin' => $is_admin
        ], $code);
    }

    public function fail($message, $code = 401){
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }
    public function validationError($message,$code = 422){
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }
    public function serverError($message, $code = 500){
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }
}
?>
