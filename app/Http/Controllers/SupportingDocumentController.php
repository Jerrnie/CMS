<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportingDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupportingDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userFullName =Auth::user()->getFullName();

        // $validatedData = $request->validate([
        //     'title' => 'required|max:255',
        //     'description' => 'nullable',
        //     'category' => 'required',
        //     'type' => 'required|in:file,url',
        //     'attachment' => 'required_if:type,file|mimes:doc,docx,gif,jpeg,jpg,pdf,ppt,pptx,rtf,xls,xlsx,zip,zipx|max:10240',
        //     'url' => 'required_if:type,url|url',
        // ]);

        $file = $request->all();

        $attachment = new SupportingDocument;
        $attachment->user_id = Auth::user()->id;
        $attachment->category_id = $file['category'];
        $attachment->title = $file['title'];
        $attachment->description = $file['description'];
        $attachment->type = $file['type'];

        if ($file['type'] == 2) {

            $attachment->url = $file['url'];
            $attachment->file_name = null;
            $attachment->original_file_name = null;
            $attachment->save();
            return redirect()->route('profile.edit')->with('status', 'supporting-document-uploaded')->withFragment('supportingDocuments');
        }
        else{
            $attachment->url = null;

            // Get the uploaded file

            $uploadedFile = $request->file('attachment');
            // Get the original filename
            $originalFilename = $uploadedFile->getClientOriginalName();
            $attachment->original_file_name = $originalFilename;
            // Generate a unique filename for the uploaded file
            $secFileName = hash('sha256', $userFullName.'zffoundation');
            $filename = $secFileName . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();
            $attachment->file_name = $filename;
             // Get the user id
            $userId = auth()->id();

            // Generate the path
            $path = "supporting-documents/{$userId}";

            // Store the file in the storage/app/public/supporting-documents/userid directory
            Storage::putFileAs("public/{$path}", $uploadedFile, $filename);


        }

        $attachment->save();




        return redirect()->route('profile.edit')->with('status', 'supporting-document-uploaded')->withFragment('supportingDocuments');


    }

    public function downloadAttachment($attachment_id){

        $attachment = SupportingDocument::where('id', $attachment_id)->first();

        if(!$attachment){
            return redirect()->back()->with('error', 'Invalid Attachment');
        }

        $pathToFile = storage_path('app/storage/app/public/supporting-documents/1/' . $attachment->file_name);

        return response()->download($pathToFile, $attachment->orig_name);
    }

    public function deleteAttachment($attachment_id)
    {
        $attachment = SupportingDocument::where('id', $attachment_id)->first();

        if(!$attachment){
            return response()->json(['error' => 'Invalid Attachment'], 404);
        }

        // Check if the authenticated user is the owner of the document
        if (auth()->user()->id !== $attachment->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

       $pathToFile = storage_path('app/public/public/supporting-documents/' . $attachment->user_id . '/' .$attachment->file_name);

        if (file_exists($pathToFile)) {
            unlink($pathToFile);
        }

        // Delete the attachment from the database
        $attachment->delete();



        return response()->json(['status' => 'Attachment Deleted', 'debugger' => $pathToFile,]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
}
