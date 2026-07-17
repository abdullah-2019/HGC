<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\AboutCarouselSlide;
use Illuminate\Http\Request;

class CarouselSlideController extends Controller
{

    public function index()
    {
        $slides = AboutCarouselSlide::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        return view(
            'admin.about.carousel.index',
            compact('slides')
        );
    }


    public function create()
    {
        return view('admin.about.carousel.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'image_url' => [
                'nullable',
                'string',
                'max:255'
            ],

            'title_en' => [
                'nullable',
                'string',
                'max:200'
            ],

            'title_dari' => [
                'nullable',
                'string',
                'max:200'
            ],

            'title_pashto' => [
                'nullable',
                'string',
                'max:200'
            ],

            'location_en' => [
                'nullable',
                'string',
                'max:100'
            ],

            'location_dari' => [
                'nullable',
                'string',
                'max:100'
            ],

            'location_pashto' => [
                'nullable',
                'string',
                'max:100'
            ],

            'is_active' => [
                'nullable',
                'boolean'
            ],

            'sort_order' => [
                'nullable',
                'integer'
            ],

        ]);


        AboutCarouselSlide::create($validated);


        return redirect()
            ->route('admin.about.carousel.index')
            ->with('success', 'Slide created successfully.');
    }


    public function edit(
        AboutCarouselSlide $carousel
    )
    {
        return view(
            'admin.about.carousel.edit',
            [
                'slide' => $carousel
            ]
        );
    }


    public function update(
        Request $request,
        AboutCarouselSlide $carousel
    )
    {

        $validated = $request->validate([
            'image_url'=>'nullable|string|max:255',

            'title_en'=>'nullable|string|max:200',
            'title_dari'=>'nullable|string|max:200',
            'title_pashto'=>'nullable|string|max:200',

            'location_en'=>'nullable|string|max:100',
            'location_dari'=>'nullable|string|max:100',
            'location_pashto'=>'nullable|string|max:100',

            'is_active'=>'nullable|boolean',
            'sort_order'=>'nullable|integer',
        ]);


        $carousel->update($validated);


        return redirect()
            ->route('admin.about.carousel.index')
            ->with('success','Slide updated successfully.');
    }



    public function destroy(
        AboutCarouselSlide $carousel
    )
    {

        $carousel->delete();


        return redirect()
            ->route('admin.about.carousel.index')
            ->with('success','Slide deleted successfully.');
    }
}