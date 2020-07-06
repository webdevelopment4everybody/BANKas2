<?php 

namespace App\DB;

use App\DB\DataBase;
class JsonDb implements DataBase
{

    private $data;
    public function __construct(){
        if(!file_exists('./../db/data.json')){
        file_put_contents('./../db/data.json', json_encode([]));
    }
    $this->data =json_decode(file_get_contents('./../db/data.json'),1);
    }
    public function create(array $userData) : void{
            $data = json_decode(file_get_contents('./../db/data.json'),1);
            $data[] = $userData;
            file_put_contents('./../db/data.json', json_encode($data));

    }
 
    public function update(string $userId, array $userData) : void{
        $data = json_decode(file_get_contents('./../db/data.json'),1);

        foreach($data as $key => $user){
            if($userId == $data[$key]['id']){
                $data[$key] = $userData;
            }
        }
        file_put_contents('./../db/data.json', json_encode($data));
    }
 
    public function delete(string $userId) : void{
        $data = json_decode(file_get_contents('./../db/data.json'),1);

            foreach($data as $key => $user){
                if($userId == $data[$key]['id']){
                    array_splice($data, $key, 1);
                }
            }
            file_put_contents('./../db/data.json', json_encode($data));
    }
 
    public function show(string $userId):array{
        $data = json_decode(file_get_contents('./../db/data.json'),1);
        foreach($data as $key => $user){
            if($userId == $user['id']){

                return  $data[$key];
            }
        }

    }
    
    public function showAll() : array{
        $data = json_decode(file_get_contents('./../db/data.json'),1);
        $sorted = $this->sort($data);
        return $sorted;      
}
    private function save(){
        file_put_contents('./../db/data.json', json_encode($this->data));
    }

    private function sort(array $userData) {

        function bubleSort($array){
            $swapped;
            do{
                $swapped = false;
                for($i = 0; $i < count($array) - 1; $i++){
                    $firstElement = strnatcmp($array[$i]['lastname'], $array[$i+1]['lastname']);
                    $secondElement = strnatcmp($array[$i+1]['lastname'], $array[$i]['lastname']);

                    if($firstElement > $secondElement){
                        $temp = $array[$i];
                        $array[$i] = $array[$i + 1];
                        $array[$i + 1] = $temp;
                        $swapped = true;
                    }
                }
            }while($swapped);
            return $array;
        }
        return bubleSort($userData);
    }
    
}