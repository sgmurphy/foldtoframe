<?php

class PhotoController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('photo.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Input::hasFile('file')) {
			$id = $this->handleUpload();
		}

		// Successful upload
		if ($id) {
			return Redirect::route('photo.show', [$id]);
		}

		// Failed upload
		// TODO: include an error message
		return Redirect::back()->withInput();
	}


	/**
	 * Show the specified resource.
	 *
	 * @param  str  $id
	 * @return Response
	 */
	public function show($id)
	{
		$preview = URL::asset('uploads/' . $id . '.png');
		$download = URL::asset('uploads/' . $id . '_print.png');

		return View::make('photo.show', compact('preview', 'download'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('photo.edit', compact('photo'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$photo = Photo::findOrFail($id);

		$photo->fill(Input::all());

		if (Input::hasFile('file')) {
			$files = $this->handleUpload();

			$photo->large_file = $files['large'];
			$photo->preview_file = $files['preview'];
			$photo->thumbnail_file = $files['thumbnail'];
		}
		
		if ($photo->save()) {
			return Redirect::route('admin.photo.index')->with('success', 'Photo updated.');
		}

		return Redirect::back()->withErrors($photo->getErrors())->withInput();
	}


	private function handleUpload() {
		$upload_dir = public_path() . '/uploads/';
		$file = Input::file('file');
		$id = Uuid::generate(4);

		$filenames = [
			'preview' => $id . '.png',
			'print' => $id . '_print.png'
		];
		//'large' => Uuid::generate(4) . '_L.' . $file->getClientOriginalExtension(),

		$img = Image::make($file->getRealPath());

		// Determine max photo dimensions
		// 6 x 4 = 1800 x 1200
		$photo_w = ($img->width() > $img->height()) ? 1690 : 1300;
		$photo_h = ($img->width() > $img->height()) ? 1300 : 1690;

		// Resize original to max dimensions
		$img->resize($photo_w, $photo_h, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			})
			->save($upload_dir . $filenames['preview']);

		// Determine max canvas dimensions
		$canvas_w = ($img->width() > $img->height()) ? 3300 : 2550;
		$canvas_h = ($img->width() > $img->height()) ? 2550 : 3300;

		// Add border to print version
		$img->resizeCanvas($canvas_w, $canvas_h)
			->save($upload_dir . $filenames['print']);

		// Free up memory
		$img->destroy();

		return $id;
	}

}
