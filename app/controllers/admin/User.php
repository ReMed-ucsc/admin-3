<?php

class User
{
    use Controller;
    public function index()
    {
        $user = new Patient();
        $userModel= $user->getAllPatients();

        $data=[
            'patient'=> $userModel
        ];
        // var_dump( $data );
        $this->view('admin/user', $data);
    }

    // add other methods like edit, update, delete, etc.
}
