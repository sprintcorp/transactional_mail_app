<?php
 namespace App\Traits;

//use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

trait ApiResponse
{
    private function successResponse($message,$code)
    {
        return response()->json(['message' => $message],$code);
    }

    private function allResponse($data,$code=200)
    {
        return response()->json($data,$code);
    }

    protected function showModelWithMessage($model,$message,$code=200)
    {
        return response()->json(['message' => $message,'data'=>$model],$code);
    }

    protected function errorResponse($message,$code)
    {
        return response()->json(['error' => $message,'code'=>$code],$code);
    }

    protected function showAll($collection,$no = 10,$code = 200)
    {
        if($no < 1){
            $no = 10;
        }
        if($collection->isEmpty()){
            return $this->successResponse(['data' => $collection],$code);
        }
        $collection = $this->paginate($collection,$no);
        return response()->json($collection,$code);
    }


    protected function showModel($model,$message,$code = 200): JsonResponse
    {
        return response()->json(['data'=>$model,'message'=>$message],$code);
    }

    protected function showMessage($message,$code = 200)
    {
        return $this->successResponse(['message' => $message],$code);
    }


    /**
     * @param Collection $collection
     */
    protected function paginate($collection,$no)
    {
        $rules = [
          'per_page' => 'integer|min:5|max:50'
        ];
        Validator::validate(request()->all(),$rules);
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $no;
        if(request()->has('per_page')){
            $perPage = (int) request()->per_page;
        }
        $result = $collection->slice(($page - 1) * $perPage,$perPage)->values();

        $paginated = new LengthAwarePaginator($result,$collection->count(),$perPage,$page,[
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        return $paginated;
    }
}
