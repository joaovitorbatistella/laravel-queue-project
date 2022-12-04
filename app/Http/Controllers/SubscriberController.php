<?php

namespace App\Http\Controllers;

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
        //
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
                    $object[$header] = $delimited[$i];
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
