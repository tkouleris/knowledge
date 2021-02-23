<?php


namespace Tests\Feature;


use App\Models\Knowledge;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait Helpers
{
    private function getToken()
    {
        $credentials = ['email'=>'test@email.gr','password'=>'secret'];

        $User = new User;
        $User->name = 'admin';
        $User->email = 'test@email.gr';
        $User->password = Hash::make('secret');
        $User->save();

        $response = $this->post('api/login',$credentials);

        return $response->decodeResponseJson();
    }

    public function create_single_knowledge_record($id)
    {
        $knowledge = new Knowledge();
        $knowledge->title = "Untitled knowledge";
        $knowledge->description = "No description";
        $knowledge->user_id = $id;
        $knowledge->save();
    }
}
