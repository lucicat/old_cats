<?php 

namespace App\Controllers;
// use App\Models\ContactsModel;

class ContactsController extends Controller
{
    public function showContacts($request, $response, $args)
    {
        return $this->view->render($response, 'contacts/contacts.twig');
    }
}