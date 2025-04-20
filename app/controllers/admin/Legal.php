<?php

class Legal
{
    use Controller;
    public function index()
    {
        $legal = new LegalModel;

        $privacyArr = $legal->getPrivacyPolicy();         // returns array
        $termsArr = $legal->getTermsConditions();         // returns array

        $privacy = $privacyArr[0]->privacy_policy ?? '';
        $terms = $termsArr[0]->terms_and_conditions ?? '';
        // $arr['email'] = "name@example.com";

        // $result = $model->where(data_for_filtering, data_not_for_filtering);
        // $result = $model->insert(insert_data);
        // $result = $model->update(filtering_data updating_data, id_column_for_filtering);
        // $result = $model->delete(id, id_column);
        // $result = $user->findAll();

        // show($result);

        // $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $data = [
            'privacy' => $privacy,
            'terms' => $terms
        ];
        $this->view('admin/legal', $data);
    }
    public function legalEdit()
    {
        $legalModel = new LegalModel;

        // Fetch current content
        $existing = $legalModel->findAll();

        $data = [
            'privacy' => $existing[0]->privacy_policy ?? '',
            'terms' => $existing[0]->terms_and_conditions ?? ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $privacy = $_POST['privacy_policy'] ?? '';
            $terms = $_POST['terms_conditions'] ?? '';

            // Update in DB
            $legalModel->legalUpdate($privacy, $terms);

            redirect('admin/legal');
            exit();
        }

        // Load edit view
        $this->view('admin/legalEdit', $data);
    }



    // add other methods like edit, update, delete, etc.
}
