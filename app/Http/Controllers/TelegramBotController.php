<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    //
   public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity[0]->message->from->id);
    }
 
    public function sendMessage()
    {
        return view('message');
    }
 
    public function storeMessage(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);
 
        $text = "A new contact us query\n"
            . "<b>Email Address: </b>\n"
            . "$request->email\n"
            . "<b>Message: </b>\n"
            . $request->message;

        Telegram::sendMessage([
            'chat_id' => '388593288',
            'parse_mode' => 'HTML',
            'text' => $text
        ]);
 
        return redirect()->back();
    }
 
    public function sendPhoto()
    {
        return view('photo');
    }

    public function test()
    {
    	$text = "A new contact us query\n"
            . "<b>Email Address: </b>\n"
            . "CCCP\n"
            . "<b>Message: </b>\n"
            . "Test";

        Telegram::sendMessage([
            'chat_id' => '388593288',
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return false;
    }
 
    public function storePhoto(Request $request)
    {
        $request->validate([
            'file' => 'file|mimes:jpeg,png,gif'
        ]);
 
        $photo = $request->file('file');
 
        Telegram::sendPhoto([
            'chat_id' => '388593288',
            'photo' => InputFile::createFromContents(file_get_contents($photo->getRealPath()), str_random(10) . '.' . $photo->getClientOriginalExtension())
        ]);
 
        return redirect()->back();
    }
}
