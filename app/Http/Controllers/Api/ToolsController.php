<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path = "/";
        $status ="200";
        $status_message ="OK";

        $data=$this->get_free($path);
      
        $this->jsnresponse($status,$status_message,$data);

        $data_over=$this->get_average();

        $this->xmlresponse($status,$status_message,$data_over);


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
        //
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


private function get_free($path) {

     $usage = round(disk_free_space($path) / 1024 / 1024 / 1024);

     return $usage."Gb";
}

private function get_average(){

$uptime = shell_exec("uptime");

return $uptime;

}


  private function jsnresponse($status,$status_message,$data)
{
    header("HTTP/1.1 ".$status);
    
    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data;
    $json_response = json_encode($response);
    echo $json_response;
}


  private function xmlresponse($status,$status_message,$data)
{
    header("HTTP/1.1 ".$status);
    
    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data;
    header('Content-Type: application/xml');
    $xml_output = "<root><data>$data</data></root>";
    echo $xml_output;
    
}


  private function ymlresponse($status,$status_message,$data, $server_name)
{
    header("HTTP/1.1 ".$status);
    $server_name = "my_server";
    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data; 
    $yml_output = array (
    "data"=> $data,
    "server"=>$server_name,
    );
    var_dump(yaml_emit($yml_output));
    echo $yml_output;
    
}




}
