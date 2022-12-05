<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Jobs\ProcessSubscriber;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Subscriber::all();
        return view('welcome', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $fileContent = file_get_contents($data['csvFile']);
        $contentAndHeader = preg_split("/(\r\n|\r|\n)/", $fileContent, 2);
        $headers = explode(",", $contentAndHeader[0]);
        $content = $contentAndHeader[1];
        $rows = preg_split("/(\r\n|\r|\n)/", $content);
        $data = [];
        $arr = array_map(function ($value) use($headers) {
            $delimited = explode(",", $value);
            $i=0;
            $el = array_reduce($headers, function($object, $header) use($headers, $delimited, &$i) {
                if(count($delimited)-1 === count($headers)-1) {
                    $object[$header] = trim($delimited[$i], '"');
                }
                if(count($headers)-1 === $i) {
                    $i=0;
                } else {
                    $i++;
                }
                return $object;      
            });
            return $el;
        }, $rows);

        $arr = array_filter($arr);
        /*
            Aqui começa a lógica da fila
        */
        // foreach ($arr as $key => $sub) {
        //     ProcessSubscriber::dispatch($sub)->onQueue('importSubscribersQueue');
        // }

        /*
            Batches
        */
        $subArrs = array_chunk($arr, count($arr)%2=== 0 ? count($arr)/2 : (count($arr)-1)/2);

        (new Subscriber)->handleBatch($subArrs[0]);    
        (new Subscriber)->handleBatch($subArrs[1]);    
        
        return redirect()->back()->with('message', 'Lista de subscribers enviada para fila!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
