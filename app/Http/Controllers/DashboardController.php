<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $client;
    protected $contact;

    public function __construct(Client $client, Contact $contact){
        $this->contact = $contact;
        $this->client = $client;
    }


    public function index(){
        $clients = $this->client->all();
        $clientsCount =  $clients->count();
        $contacts = $this->contact->all();
         
        $contactsCount =  $contacts->count();
    
        $linkedClients = 0;
        $linkedContacts = 0;
        foreach($clients as $client){
            $linkedClients += $client->contacts()->count();
        }
       
        foreach($contacts as $contact){   
            $linkedContacts += $contact->clients()->count(); 
        }
        
         $totalLinked =  ($linkedClients + $linkedContacts)/2;
        return view('dashboard.index', compact('clientsCount', 'contactsCount', 'totalLinked'));
    }
}
