<?php
namespace App\Repository;
Interface CvInterfaces{
    public function store($data);
    public function show();
    public function destroy($id);
    public function update($data,$id);
}


