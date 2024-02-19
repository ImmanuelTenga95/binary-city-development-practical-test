<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contact;
    protected $client;

    public function __construct(Contact $contact, Client $client){
        $this->contact = $contact;
        $this->client = $client;
    }
    
    public function index(){

        $contacts = $this->contact->orderBy('surname')->orderBy('name')->get();
        return view('contacts.index', compact('contacts'));
    }

    public function create(Request $request){
        //dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:contacts,email',
        ]);

        $this->contact->create($validated);

        return redirect()->back()->with('success', 'Contact created successfully.');
    }

    public function edit($id){
        $contact = $this->contact->findOrFail($id);
        return response()->json($contact);
    }

    public function update(Request $request, $id){
        $contact = $this->contact->findOrFail($id);
        $contact->update($request->all());
        return response()->json(['message' => 'Contact updated successfully']);
    }

    public function delete($id){
        $contact = $this->contact->findOrFail($id);
        $contact->delete($id);
        return redirect()->back()->with('success','Contact deleted successfully');
    }

    public function storeContactLink(Request $request, $id){
        $contact = $this->contact->findOrFail($id);
        $contact->clients()->attach($request->client_id);
        return redirect()->back()->with('success', 'Contact linked successfully');
    }

    public function createContactLink($id){
        $contact = $this->contact->findOrFail($id);
        $allClients = $this->client->whereNotIn('id', $contact->clients->pluck('id'))->get();
        $clients= $contact->clients;
        return view('contacts.create-client-link', compact('contact', 'clients', 'allClients'));
    }

    public function deleteContactLink($contactId, $clientId ){
        //dd($clientId, $contactId);
        $contact = $this->contact->findOrFail($contactId);
        $client =  $this->client->findOrFail($clientId);
        $contact->clients()->detach($client);
        return redirect()->back()->with('success', 'Client unlinked successfully');
    }
}
