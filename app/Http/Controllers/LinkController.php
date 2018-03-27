<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLink;
use App\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        // get all the nerds
        $links = Auth::user()->links()->paginate(15);

        return view('links.index', ['links' => $links]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('links/create');
    }

    /**
     * @param StoreLink $request
     * @return mixed
     */
    public function store(StoreLink $request)
    {
        Auth::user()->links()->save(new Link($request->validated()));
        Session::flash('message', 'Successfully created link!');
        return Redirect::to('links');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        // delete
        $link = Auth::user()->links()->findOrFail($id);
        $link->delete();
        // redirect
        Session::flash('message', 'Successfully deleted the link!');
        return Redirect::to('links');
    }

    /**
     * @param $short_url
     * @return mixed
     */
    public function go($short_url)
    {
        $link = Link::sortUrl($short_url)->firstOrFail();
        $link->increment('count');
        $link->save();
        return Redirect::to($link->url);
    }
}
