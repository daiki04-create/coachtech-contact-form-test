<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }
    public function admin(Request $request)
    {
        return $this->search($request);
    }

    public function search(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
        
        $contacts = $query->get();

        $csvHeader = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容'];
        $csvData = [];

        foreach ($contacts as $contact) {
            $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
            $csvData[] = [
                $contact->first_name . ' ' . $contact->last_name,
                $gender,
                $contact->email,
                $contact->category->content,
                $contact->detail,
            ];
        }

        $response = new \Symfony\Component\HttpFoundation\StreamedResponse(function() use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
           
            fwrite($handle, "\xEF\xBB\xBF");
            
            fputcsv($handle, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_' . date('Ymd') . '.csv"',
        ]);

        return $response;
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name', 
            'last_name', 
            'gender', 
            'email', 
            'address', 
            'building', 
            'category_id', 
            'detail'
        ]);

        $contact['tell'] = $request->tell_1 . $request->tell_2 . $request->tell_3;

        $category = Category::find($request->category_id);
        $contact['category_content'] = $category->content;

        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        if ($request->input('back')) {
            return redirect('/')->withInput();
        }

        $contact = $request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tell',
            'address',
            'building',
            'detail'
        ]);

        Contact::create($contact);

        return view('thanks');
    }
}