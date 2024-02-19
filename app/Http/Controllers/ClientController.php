<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $client;
    protected $contact;

    public function __construct(Client $client, Contact $contact){
        $this->client = $client;
        $this->contact = $contact;
    }

    public function index(){

        $clients = $this->client->orderBy('name', 'asc')->get();
        return view('clients.index', compact('clients'));
    }

    public function create(Request $request){

        $validated = $request->validate([
            'name' => 'required|string',
            
        ]);

        $clientCode = $this->client->generateClientCode($validated['name']);

        $client = new Client();
        $client->name = $validated['name'];
        $client->client_code = $clientCode;
        $client->save();

        if($client->save()){
            return redirect()->back()->with('success', 'Client created successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function edit($id){
        $client = $this->client->findOrFail($id);
        return response()->json($client);
    }

    public function update(Request $request, $id){
        $client = $this->client->findOrFail($id);
        $client->update($request->all());
        return response()->json(['message' => 'Client updated successfully']);
    }

    public function delete($id){
        $client = $this->client->findOrFail($id);
        $client->delete($id);
        return redirect()->back()->with('success', 'Client deleted successfully');
    }

    public function createClientLink($id){
        $client = $this->client->findOrFail($id);
        $allContacts = $this->contact->whereNotIn('id', $client->contacts->pluck('id'))->get();
        $contacts = $client->contacts;
        return view('clients.create-contact-link', compact('client', 'contacts', 'allContacts'));
    }

    // public function createClientLinkInfo($id){
    //     $client = $this->client->findOrFail($id);
    //     $contacts = $client->contacts;

    //     $data = [
    //         'client' => $client,
    //         'contacts' => $contacts,
    //     ];
    //     return response()->json($data);
    // }

    public function storeClientLink(Request $request, $id){
        $client = $this->client->findOrFail($id);
        $client->contacts()->attach($request->contact_id);
        return redirect()->back()->with('success', 'Contact linked successfully');
    }

    public function deleteClientLink($clientId, $contactId){
        
        $client = $this->client->findOrFail($clientId);
        $contact = $this->contact->findOrFail($contactId);
        $client->contacts()->detach($contact);
        return redirect()->back()->with('success', 'Contact unlinked successfully');
    }
}
