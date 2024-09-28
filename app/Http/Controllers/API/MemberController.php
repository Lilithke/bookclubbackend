<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMembersRequest;
use App\Http\Requests\UpdateMembersRequest;
use App\Models\Members;
use App\Models\Payments;
use App\Http\Controllers\API\datetimes;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberIds = Members::all();
        return response()->json(["data"=> $memberIds]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMembersRequest $request)
    {
        $memberIds = new Members($request->all());
        $memberIds -> save();
        return response()->json($memberIds,201);
    }

    /**
     * Display the specified resource.
     */
    public function pay(string $id)
    {
        $memberIds = Members::find($id);
        if (is_null($memberIds)) {
            return response()->json(["message" => "Member not found with id:$id"],404);
        }

        $payment = Payments::where([
            ["members_id", $id],
            ["amount","=", 5000],
            /*["paid_at","<", date("yyyy-MM-dd'T'HH:mm:ss.SSS'Z'")]*/
            ["paid_at", ">", date("yyyy-MM-dd'T'HH:mm:ss.SSS'Z'",strtotime("-1 month"))]
                ])->get();

            if (!$payment -> isEmpty()) {
                return response()->json(["message"=>"The fee has already been paid for this month"],409);
            }
            else {
                $payment = new Payments();
                $payment -> members_id = $id;
                $payment -> amount = 5000;
                $payment -> paid_at = now();
                $payment -> save();

                return response()->json($payment,201);
            }


    }

    public function update(UpdateMembersRequest $request, string $id)
    {

       /* $memberIds = Members::find($id);
        if (is_null($memberIds)) {
            return response()->json(["message" => "Member not found with id:$id"],404);
        }
        $memberIds->fill($request->all());
        $memberIds->save();
        return $memberIds;*/
    }

}
