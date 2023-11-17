<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mendapatkan semua resource
        $news = News::all();

        if ($news) {
            $data = [
                'message' => 'Get All Resource',
                'date' => '$news'
            ];
            //menampilkan kode 
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Data is empty'
            ];
            return response()->json($data, 404);
        }
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
        //menambahkan resource 
        $validateData =$request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'content' => 'required',
            'url' => 'required',
            'url_image' => 'required',
            'category' => 'required',
            'timestamp' => 'timestamp|required'
        ]);

        $news = News::created($validateData);

        //menambahkan pesan dan kode

        $data = [
            'message' => 'Resource is added seccesfully',
            'data' => $news
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //menampilkan resource by detail
        $news = News::find($id);

        if ($news){
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $news
            ];
            //menampilkan respon kode
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource not Found'
            ];
            //menampilkan kode respon
            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        //edit data
        $news = News::find($id);

        if($news) 
        {
            $input = [
                'title' => $request->title ?? $news->title,
                'author' => $request->author ?? $news->author,
                'description' => $request->description ?? $news->description,
                'content' => $request->content ?? $news->content,
                'url' => $request->url ?? $news->url,
                'url_image' => $request->url_image ?? $news->url_image,
                'category' => $request->category ?? $news->category,
                'timestamp' => $request->timestamp ?? $news->timestamp
            ];

            $news->update($input);
            // menambahkan pesan dan kode json
            $data = [
                'message' => 'Resource is Update Successfully',
                'data' => $news
            ];
            return response()->json($data, 200);
        }
         else{
            $data = [
                'message' => 'Resource not Found',
            ];
            return response()->json($data, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menghapus data
        $news = News::find($id);

        if ($news) {
            $news->delete();

            //menambahkan pesan
            $data = [
                'message' => 'Resource is Detail Succsessfully'
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource not Found'
            ];
            return response()->json($data, 404);
        }
    }
    public function search($title)
    {
        # mencari data Patients berdasarkan name
        $news = News::where("title", 'LIKE', "%$title%")->get();

        if (count($news) > 0) {
            $data = [
                'message' => 'Get Detail Searched Resource',
                'data' => $news
            ];

            #mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found ',
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        }
    }
    public function sport() {
        //menampilkan data kategori sport
        $news = News::where("category", "sport")->get();

        //menambahkan pesan 
        $data = [
            'message' => 'Get Sport Resource',
            'data' => $news
        ];
        return response()->json($data, 200);
    }
    public function finance()
    {
        //menampilkan data kategori finance
        $news = News::where("category", "finance")->get();

        //menambahkan pesan 
        $data = [
            'message' => 'Get Finance Resource',
            'data' => $news
        ];
        return response()->json($data, 200);
    }
    public function automotive()
    {
        //menampilkan data kategori automotive
        $news = News::where("category", "automotive")->get();

        //menambahkan pesan 
        $data = [
            'message' => 'Get Automotive Resource',
            'data' => $news
        ];
        return response()->json($data, 200);
    }
}
