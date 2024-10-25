<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class DropzoneController.
 */
class DropzoneController extends Controller
{
    public function storeTempStorage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,webp,heif,heic,hevc|max:2048',
        ]);

        $routeImage = $request->file('file')->store('temp', 'public');

        return response()->json($routeImage);
    }

    /**
     * Stores the image received through the request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Get path of the image
            $imagePath = $request->input('imagePath');
            // Get the file from the request
            $localRoute = 'public/'.$imagePath;
            $image = Storage::disk('local')->get($localRoute);

            // Generate a unique name for the image
            $imageName = uniqid().'/'.pathinfo($imagePath, PATHINFO_FILENAME).'.'.pathinfo($imagePath, PATHINFO_EXTENSION);

            // Store the image on the 'products' disk
            $response = Storage::disk('products')->put($imageName, $image);

            // Return the path of the stored image as a JSON response
            return response()->json(['imagePath' => $imageName]);
        } catch (\Exception $e) {
            // Handle any exception and return a JSON error response
            return response()->json(['error' => 'Error al almacenar la imagen. Detalles: '.$e->getMessage()], 500);
        }
    }

    /**
     * Deletes the image from the local file system.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        try {
            // Get the image name from the provided URL
            $imageName = $request->input('imageUrl');

            // Check if the image exists on the 'products' disk
            if (Storage::disk('products')->exists($imageName)) {
                // Delete the image
                Storage::disk('products')->delete($imageName);

                // Return the name of the deleted image as a JSON response
                return response()->json($imageName);
            }
        } catch (\Exception $e) {
            // Handle any exception and return a JSON error response
            return response()->json(['error' => 'Error al eliminar la imagen del sistema de archivos local'], 500);
        }
    }
}
