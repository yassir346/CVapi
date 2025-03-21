<?php
namespace App\Repository;
use App\Repository\CvInterfaces;
use Illuminate\Support\Facades\DB;
class CvRepository implements CvInterfaces{
    public function store($data){
        DB::table('cvs')->insert($data);
    }
    public function show(){
      $cvs=  DB::table('cvs')->get();
    
        return  $cvs;
    }
    public function destroy($data){
        DB::table('cvs')->where('id','=',$data)->first()->delete($data);

    }
    public function update($data,$id){
        DB::table('cvs')->where('id','=',$id)->first()->update($data);

    }
}