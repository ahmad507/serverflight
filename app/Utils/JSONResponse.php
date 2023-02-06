<?php
    namespace App\Utils;
    
    
    class JSONResponse
    {
        /**
         * @param $data
         * @return \Illuminate\Http\JsonResponse
         */
        function ok_http($data)
        {
            $msg = 'success';
            $code = 200;
            $content = [
                'message' => $msg,
                'status code' => $code,
                'data' => $data
            ];
            return response()->json($content, $code);
        }
    
        /**
         * @param $data
         * @return \Illuminate\Http\JsonResponse
         */
        function failed_http($data)
        {
            $msg = 'failed';
            $code = 400;
            $content = [
                'message' => $msg,
                'status code' => $code,
                'data' => $data
            ];
            return response()->json($content, $code);
        }
    }
