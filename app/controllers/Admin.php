<?php

class Admin extends Controller {
    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->view('layout/admin-header', $data);
        $this->view('admin/index');
        $this->view('layout/admin-footer');
    }
}