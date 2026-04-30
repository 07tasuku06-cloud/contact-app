<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated(); //TEl弾かれる
        $contact['tel'] =
            $request->tel1 . '-' .
            $request->tel2 . '-' .
            $request->tel3;

        $category = Category::find($contact['category_id']);

        return view('confirm', compact('contact', 'category'));
    }
    public function store(ContactRequest $request)
    {
        $contact = $request->validated();
        $contact['tel'] =
            $request->tel1 . '-' .
            $request->tel2 . '-' .
            $request->tel3;

        Contact::create($contact);

        return redirect('/thanks');
    }
    public function thanks()
    {
        return view('thanks');
    }
    public function admin(Request $request)
    {
        $contacts = Contact::with('category')
            ->nameSearch($request->name)
            ->emailSearch($request->email)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')
            ->nameSearch($request->name)
            ->emailSearch($request->email)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy(Request $request)
    {
        Contact::findOrFail($request->id)->delete();

        return redirect('/admin');
    }

    public function reset()
    {
        return redirect('/admin');
    }

    public function export(Request $request)
    {
        $contacts = Contact::with('category')
            ->nameSearch($request->name)
            ->emailSearch($request->email)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->get();

        $filename = 'contacts.csv';

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // ヘッダー
            fputcsv($handle, [
                'ID',
                '姓',
                '名',
                '性別',
                'メール',
                '電話',
                '住所',
                'カテゴリ',
                '内容'
            ]);

            foreach ($contacts as $c) {

                $gender = match ($c->gender) {
                    1 => '男性',
                    2 => '女性',
                    3 => 'その他',
                    default => '',
                };

                fputcsv($handle, [
                    $c->id,
                    $c->last_name,
                    $c->first_name,
                    $gender,
                    $c->email,
                    $c->tel,
                    $c->address,
                    $c->category->content,
                    $c->detail,
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', "attachment; filename={$filename}");

        return $response;
    }
    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);

        $gender = match ($contact->gender) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
            default => '',
        };

        return response()->json([
            'name' => $contact->last_name . ' ' . $contact->first_name,
            'gender' => $gender,
            'email' => $contact->email,
            'tel' => $contact->tel,
            'address' => $contact->address,
            'building' => $contact->building,
            'category' => $contact->category->content,
            'detail' => $contact->detail,
        ]);
    }
}
