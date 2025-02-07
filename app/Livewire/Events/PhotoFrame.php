<?php

namespace App\Livewire\Events;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class PhotoFrame extends Component
{
    use WithFileUploads;

    public $photo;
    public $framedPhotoUrl;

    protected $rules = [
        'photo' => 'required|image|max:2048', // 2MB max
    ];

    public function updatedPhoto()
    {
        $this->validate();

        // Process the photo with the frame
        $this->applyFrame();
    }

    public function applyFrame()
    {
        // Load the uploaded photo
        $uploadedPhoto = Image::make($this->photo->getRealPath());

        // Resize uploaded photo to 1000x1000
        $uploadedPhoto->fit(1000, 1000);

        // Load the frame image
        $frame = Image::make(public_path('image/BKM-Reunion-Photo-Frame.png'));

        // Resize frame to match the uploaded photo's size
        $frame->fit(1000, 1000);

        // Overlay the frame on top of the uploaded photo
        $uploadedPhoto->insert($frame, 'center');

        // ✅ Set framed photo URL (this time, after inserting the frame!)
        $this->framedPhotoUrl = $uploadedPhoto->encode('data-url')->encoded;
    }

    public function downloadFramedPhoto()
    {
        // Generate a unique filename
        $fileName = 'BKM_Reunion_2025_Profile_Photo.png';

        // Save the framed photo temporarily
        $tempPath = storage_path('app/public/' . $fileName);
        Image::make($this->framedPhotoUrl)->save($tempPath);

        // Return a downloadable response
        return response()->download($tempPath)->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.events.photo-frame');
    }
}
