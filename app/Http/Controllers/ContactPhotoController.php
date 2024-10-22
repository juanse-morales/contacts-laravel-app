<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactPhoto;

use Carbon\Carbon;

class ContactPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Private function to obtain current date formatted
     */
    private function getDateFormatted(){
      // Get current date
      $fechaCarbon = Carbon::now();

      // Get microsegundos and convert to milisegundos
      $microsegundos = $fechaCarbon->format('u'); // Esto da los microsegundos (ej. 123456)
      $milisegundos = substr($microsegundos, 0, 5); // Tomamos solo los primeros 5 dígitos
      
      // Format date 
      $date = $fechaCarbon->format('Y-m-d H-i-s') . '-' . $milisegundos;
      return $date;
  }

    /**
     * Endpoint for uploading contact photo file
     */
    public function upload_photo(Request $request, string $id) {
      if (count($request->files) > 0) {
        // If any of files exist then we save them
        $archivos = array();
        foreach ($request->files as $files) {
          $original_name  = $files->getClientOriginalName();
          
          // Split filename of its extension
          $filename = pathinfo($original_name, PATHINFO_FILENAME);
          $file_extension = $files->getClientOriginalExtension();

          // Create new file with identifier
          $date = $this->getDateFormatted();
          //$new_file = strtoupper($filename). ' '. $date. '.'. strtolower($file_extension);
          $new_filename = 'CONTACTPHOTO' . '_' . $id . '_' . $date . '.' . strtolower($file_extension);

          $tempFile = $files;
          $filepath = storage_path('contactphotos/');
          $file = $filepath . $new_filename;
          $fecha_creacion = now();
          $archivos[] = $file;
          
          $values = array(
            'contact_id' => $id,
            'original_filename' => $original_name,
            'new_filename' => $new_filename,
            'uploaded_date' => $fecha_creacion
          );
          
          $contact_photo = ContactPhoto::create($values);

          
          move_uploaded_file($tempFile, $file);
        }

        $data = [
          "message" => "Uploaded files to success",
          "status" => 201,
          "files" => $archivos
        ];
        
        return response()->json($data, 201);
      } else {
        $data = [
          'message'=> 'No files received',
          'status' => 400
        ];
        
        return response()->json($data, 400);
      }
    }
}
