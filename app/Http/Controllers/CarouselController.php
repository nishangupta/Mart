<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::latest()->paginate(15);
        return view('carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|min:3',
            'file' => 'required|image|max:5000'
        ]);

        if ($this->saveCarousel($request)) {
            Alert::toast('Carousel created!', 'success');
        } else {
            Alert::toast('Something went wrong!');
        }
        return redirect(route('carousel.index'));
    }

    public function edit(Carousel $carousel)
    {
        return view('carousel.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'caption' => 'required|min:3',
            'file' => 'sometimes|image|max:5000'
        ]);

        if ($this->updateCarousel($request, $carousel)) {
            Alert::toast('Carousel Updated!', 'success');
        } else {
            Alert::toast('Something went wrong!');
        }
        return redirect(route('carousel.index'));
    }


    public function destroy(Carousel $carousel)
    {
        File::delete(public_path($carousel->img));
        $carousel->delete();

        Alert::toast('Carousel deleted!', 'success');
        return redirect(route('carousel.index'));
    }

    private function updateCarousel($request, $carousel)
    {
        if ($request->hasFile('file')) {
            $basename = Str::random();
            $original = $basename . '.' . $request->file->getClientOriginalExtension();


            //delete old image
            File::delete([
                public_path($carousel->img),
            ]);

            if ($carousel->update([
                'caption' => $request->caption,
                'img' => '/images/banner/' . $original,
            ])) {
                $request->file->move(public_path('/images/banner'), $original);
                return true;
            }
        } else {
            $carousel->caption = $request->caption;
            $carousel->save();
            return true;
        }
    }

    private function saveCarousel($request)
    {
        //setting file upload
        $basename = Str::random();
        $original = $basename . '.' . $request->file->getClientOriginalExtension();

        if (Carousel::create([
            'caption' => $request->caption,
            'img' => '/images/banner/' . $original,
        ])) {
            $request->file->move(public_path('/images/banner'), $original);
            return true;
        }
    }
}
