<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class TestContentsController extends Controller
{
    public function index()
    {
        return "Hello content";
        // $contents = Content::all();
        // return view('admin.contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image upload
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        }

        Content::create($input);

        return redirect()->route('admin.contents.index')
            ->with('success','Content created successfully.');
    }

    public function show(Content $content)
    {
        return view('admin.contents.show', compact('content'));
    }

    public function edit(Content $content)
    {
        return view('admin.contents.edit',compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image upload
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        }

        $content->update($input);

        return redirect()->route('admin.contents.index')
            ->with('success','Content updated successfully');
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
        return redirect()->route('admin.contents.index')
            ->with('success','Content Delete successfully');
    }
}
