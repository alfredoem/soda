<?php namespace Alfredoem\Soda\Http\Controllers;


use App\Http\Controllers\Controller;


class SodaController extends Controller
{

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('soda::contact');
    }
}