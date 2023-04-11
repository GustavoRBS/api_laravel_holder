<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\TransactionRequest;
use Illuminate\Http\Response;
use App\Http\Resources\TransactionResource;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransactionResource::collection(Transaction::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        try {
            $transaction = new Transaction;

            $end_date = date_create($request->end_date);
            $start_date = date_create($request->start_date);
            $result = date_diff($end_date, $start_date);
            $duration = date_interval_format($result, '%a');

            $request_end = [
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "price_buy" => $request->price_buy,
                "price_sell" => $request->price_sell,
                "description" => $request->description,
                "duration" => $duration,
                "result" => $request->price_sell-$request->price_buy
            ];

            $transaction->fill($request_end)->save();

            return new TransactionResource($transaction);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrfail($id);

        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
            $transaction = Transaction::find($id);

            $end_date = date_create($request->end_date);
            $start_date = date_create($request->start_date);
            $result = date_diff($end_date, $start_date);
            $duration = date_interval_format($result, '%a');

            $request_end = [
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "price_buy" => $request->price_buy,
                "price_sell" => $request->price_sell,
                "description" => $request->description,
                "duration" => $duration,
                "result" => $request->price_sell-$request->price_buy
            ];


            $transaction->fill($request_end)->save();

            return new TransactionResource($transaction);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrfail($id);
        $transaction->delete();

        return response()->json(null, 204);
    }
}
