<?php

namespace App\Http\Controllers;
//use App\News;
use App\Branch;
use App\Work;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Settings;

class ApiController extends Controller
{
    use HelperTrait;

    public function getBranches(Request $request)
    {
        if ($request->has('id')) {
            $branch = Branch::find($request->input('id'));
            if (!$branch->active) abort(404);
            $this->data = Work::where('active',1)->where('branch_id',$branch->id)->get();
            return $this->sendData();
        } else {
            $this->data = Branch::where('active',1)->get(['id','icon','eng','rus','description']);
            return $this->sendData();
        }
    }

    private function sendData()
    {
        return response()->json(
            [
                'success' => true,
                'data' => $this->data
            ]);
    }
}
