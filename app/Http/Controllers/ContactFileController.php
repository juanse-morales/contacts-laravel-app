<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactFile;

use Carbon\Carbon;

class ContactFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_by_contact()
    {
        $contact_file_all = ContactFile::where('contact_id', $contact_id)->get();
    
        return response()->json($contact_file_all, 200);
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
  public function upload_file(Request $request, string $id) {
    if (count($request->files) > 0) {
      // If any of files exist then we save them
      $archivos = array();
      $contact_file_created = array();

      foreach ($request->files as $files) {
        $original_name  = $files->getClientOriginalName();
        
        // Split filename of its extension
        $filename = pathinfo($original_name, PATHINFO_FILENAME);
        $file_extension = $files->getClientOriginalExtension();

        // Create new file with identifier
        $date = $this->getDateFormatted();
        $new_filename = 'CONTACTFILE' . '_' . $id . '_' . $date . '.' . strtolower($file_extension);

        $tempFile = $files;
        $filepath = storage_path('contactfiles/');
        $file = $filepath . $new_filename;
        $fecha_creacion = now();
        $archivos[] = $file;

        $values = array(
          'contact_id' => $id,
          'original_filename' => $original_name,
          'new_filename' => $new_filename
        );
        
        $contact_file_created[] = ContactFile::create($values);
        
        move_uploaded_file($tempFile, $file);
      }

      $data = [
        "message" => "Uploaded files to success",
        "status" => 201,
        "files" => $archivos,
        "loaded_files" => $contact_file_created
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

  /**
   * Endpoint to visualize the saved photo
   */
  public function view_file($filename) {
    $filePath = storage_path('contactfiles/'. $filename);
    if (!file_exists($filePath)) {
      return response()->json(['error' => 'File not found'], 404);
    }
    
    // read the intire file
    $fileContents = file_get_contents($filePath);
    return $fileContents;
  }


  public function get_filename($id) {
    $contact = ContactFile::where('contact_id', $id)->get();
    if (count($contact) > 0) {
      return response()->make($contact[0]->new_filename, 200);
    } else {
      return response()->make("", 200);
    }
  }

  public function get_original_filename($id) {
    $contact = ContactFile::where('contact_id', $id)->get();
    if (count($contact) > 0) {
      return response()->make($contact[0]->original_filename, 200);
    } else {
      return response()->make("", 200);
    }
  }
}
