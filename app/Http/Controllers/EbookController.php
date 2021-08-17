<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Auth;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $ebooks = Ebook::all()->where('user_id',$user_id);
        return view('ebooks.index')->with('ebooks', $ebooks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('ebooks.create')
            ->with('ebooks', Ebook::all())
            ->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:ebooks|max:100',
            'description' => 'required|string|max:200',
            'author' => 'required|string|max:100',
            'category_id' => 'nullable|numeric',
            'ebook_file' => 'required|mimes:pdf',
            'featured_image' => 'required|mimes:jpg,jpeg,png,gif',
        ], [
            'title.max' => 'Please add title with less than 100 characters.',
            'description.max' => 'Please add description with less than 200 characters.',
            'author.max' => 'Please add author name with less than 100 characters.',
            'title.required' => 'Please add the Ebook title.',
        ]);

        $user_id=auth()->user()->id;

        $featured_image = $request->file('featured_image');
        $featured_image_name_gen = hexdec(uniqid());
        $featured_image_ext = strtolower($featured_image->getClientOriginalExtension());
        $featured_image_name = $featured_image_name_gen . '.' . $featured_image_ext;
        $featured_image_up_location = 'assets/uploads/'.$user_id.'/featured_images/';
        $featured_image_final = $featured_image_up_location . $featured_image_name;
        $featured_image->move($featured_image_up_location, $featured_image_name);

        $ebook_file = $request->file('ebook_file');
        $ebook_file_name_gen = hexdec(uniqid());
        $ebook_file_ext = strtolower($ebook_file->getClientOriginalExtension());
        $ebook_file_name = $ebook_file_name_gen . '.' . $ebook_file_ext;
        $ebook_file_up_location = 'assets/uploads/'.$user_id.'/ebook_files/';
        $ebook_file_final = $ebook_file_up_location . $ebook_file_name;
        $ebook_file->move($ebook_file_up_location, $ebook_file_name);

        $ebook = Ebook::create([
            'user_id' => $user_id,
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'ebook_file' => $ebook_file_final,
            'featured_image' => $featured_image_final,
            'created_at' => Carbon::now(),
        ]);


        session()->flash('success', 'Ebook created successfully.');

        return redirect(route('ebooks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {
        return view('ebooks.show')
            ->with('ebook', $ebook);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        return view('ebooks.create')
            ->with('ebook', $ebook)
            ->with('categories', Category::all());//Fetch Category Type=Blogs
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Ebook $ebook)
    {
        $this->validate($request, [
            'title' => ['sometimes','required', 'string','max:100', \Illuminate\Validation\Rule::unique('ebooks')->ignore($ebook->id)],
            'description' => 'required|string',
            'author' => 'required|string|max:100',
            'category_id' => 'nullable|numeric',
            'ebook_file' => 'mimes:pdf',
            'featured_image' => 'mimes:jpg,jpeg,png,gif',
        ], [
            'title.max' => 'Please add title with less than 100 characters.',
            'description.max' => 'Please add description with less than 200 characters.',
            'author.max' => 'Please add author name with less than 100 characters.',
            'title.required' => 'Please add the blog title.',
        ]);

        $user_id=auth()->user()->id;

        $data = $request->only(['user_id'=>$user_id, 'title','description', 'author', 'category_id']);

        if ($request->hasFile('featured_image')) {
            $featured_old_image = $request->featured_old_image;
            $featured_image = $request->file('featured_image');
            $featured_image_name_gen = hexdec(uniqid());
            $featured_image_ext = strtolower($featured_image->getClientOriginalExtension());
            $featured_image_name = $featured_image_name_gen . '.' . $featured_image_ext;
            $featured_image_up_location = 'assets/uploads/'.$user_id.'/featured_images/';
            $featured_image_final = $featured_image_up_location . $featured_image_name;
            $featured_image->move($featured_image_up_location, $featured_image_name);
            unlink($featured_old_image);
            $data['featured_image'] = $featured_image_final;
        }

        if ($request->hasFile('ebook_file')) {
            $ebook_file_old = $request->ebook_file_old;
            $ebook_file = $request->file('ebook_file');
            $ebook_file_name_gen = hexdec(uniqid());
            $ebook_file_ext = strtolower($ebook_file->getClientOriginalExtension());
            $ebook_file_name = $ebook_file_name_gen . '.' . $ebook_file_ext;
            $ebook_file_up_location = 'assets/uploads/'.$user_id.'/ebook_files/';
            $ebook_file_final = $ebook_file_up_location . $ebook_file_name;
            $ebook_file->move($ebook_file_up_location, $ebook_file_name);
            unlink($ebook_file_old);
            $data['ebook_file'] = $ebook_file_final;
        }

        $ebook->update($data);

        session()->flash('success', 'Ebook updated successfully.');
        return redirect(route('ebooks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $ebook = Ebook::where('id', $id)->firstOrFail();

        $old_featured_image = $ebook->featured_image;
        $old_ebook_file = $ebook->ebook_file;

        unlink($old_featured_image);
        unlink($old_ebook_file);

        $ebook->forceDelete();

        session()->flash('error', 'Ebook deleted permanently.');

        return redirect(route('ebooks.index'));
    }
}
