<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_code'
    ];

    public static function generateClientCode($name){
        $clientName = strtoupper($name);

        if (strlen($clientName) < 3) {
            
            $clientCode = $clientName;

            $clientNameLength = strlen($clientName);

            while ($clientNameLength < 3) {
                $clientCode .= chr(rand(65, 90)); // ASCII code for A-Z range
                $clientNameLength++;
            }
           
        } else {
            $clientCode = '';
            //dd(strpos($clientName, ' '));
            if (strpos($clientName, ' ') !== false) {
                // Split the name into words if it contains a space
                $words = explode(' ', $clientName);  
                //If only two names
                if(count($words) == 2){
                    $clientCode .= substr($words[0], 0, 1);
                    $clientCode .= substr($words[1], 0, 2);
                }else {

                    foreach ($words as $word) {
                        $clientCode .= substr($word, 0, 1);
                        
                    }
                }
                // Limit the client code to 3 characters
                $clientCode = substr($clientCode, 0, 3);
            } else {
                //For a single name
                $words = [$clientName];
                foreach ($words as $word) {
                    $clientCode .= substr($word, 0, 3);
                }
            }
            
        }
        // Check if any existing client codes start with the same initials
        $existingClientCodes = Client::where('client_code', 'like', $clientCode . '%') //e.g IMM
            ->orderBy('client_code', 'desc')
            ->pluck('client_code');
        //dd($existingClientCodes);
        if ($existingClientCodes->isEmpty()) {
            // If empty, start the numeric part from 001
            $numericPart = '001'; //e.g IMM + 001
        } else {
            
            $latestClientCode = $existingClientCodes->sortByDesc('client_code')->first(); //get latest
            //e.g IMM001
            $substratedSting = substr($latestClientCode, 3); // 001
            $numeric = (int)$substratedSting ; // 1
            $numericPart = str_pad($numeric + 1, 3, '0', STR_PAD_LEFT); //002
           //dd($numericPart);
        }
        
        
        $clientCode = $clientCode . $numericPart; //@if = IMM001, @else = IMM002
        
        return $clientCode;
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class)->withTimestamps();
    }
}
