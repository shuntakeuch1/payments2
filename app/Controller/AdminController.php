<?php
class AdminController extends AppController {


    public function generate() {
        $this->layout = 'adminLayout';

        if ($this->request->is('post'))
        {
            $this->Admin->set($this->request->data);

            $this->Admin->validates();

        }
    }

    public function generated() {
      $this->layout = 'adminLayout';


    }
}