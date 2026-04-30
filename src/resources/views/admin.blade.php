@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin">

    <h2 class="admin__title">Admin</h2>

    {{-- 検索フォーム --}}
    <form class="admin-search" action="/search" method="get">

        <div class="admin-search__group">
            <input class="admin-search__input" type="text" name="name" placeholder="名前">
        </div>

        <div class="admin-search__group">
            <input class="admin-search__input" type="text" name="email" placeholder="メール">
        </div>

        <div class="admin-search__group">
            <select class="admin-search__select" name="gender">
                <option value="">性別</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
        </div>

        <div class="admin-search__group">
            <select class="admin-search__select" name="category_id">
                <option value="">お問い合わせ種別</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="admin-search__group">
            <input class="admin-search__input" type="date" name="date">
        </div>

        <button class="admin-search__button" type="submit">
            検索
        </button>

        <a class="admin-search__button admin-search__button--export"
            href="/export?{{ http_build_query(request()->all()) }}">
            CSV出力
        </a>

        <a class="admin-search__reset" href="/reset">
            リセット
        </a>

    </form>

    {{-- 一覧テーブル --}}
    <table class="admin-table">

        <tr class="admin-table__row">
            <th class="admin-table__header">名前</th>
            <th class="admin-table__header">メール</th>
            <th class="admin-table__header">カテゴリ</th>
            <th class="admin-table__header">操作</th>
        </tr>

        @foreach ($contacts as $contact)
        <tr class="admin-table__row">
            <td class="admin-table__data">
                {{ $contact->last_name }} {{ $contact->first_name }}
            </td>
            <td class="admin-table__data">
                {{ $contact->email }}
            </td>
            <td class="admin-table__data">
                {{ $contact->category->content }}
            </td>
            <td class="admin-table__data">
                <form class="admin-form" action="/delete/{{ $contact->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin-form__button">
                        削除
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

    {{-- ページネーション --}}
    <div class="admin__pagination">
        {{ $contacts->links() }}
    </div>

    <div id="modal" class="modal">
        <div class="modal__content">
            <span class="modal__close">&times;</span>

            <p>名前：<span id="m-name"></span></p>
            <p>性別：<span id="m-gender"></span></p>
            <p>メール：<span id="m-email"></span></p>
            <p>電話：<span id="m-tel"></span></p>
            <p>住所：<span id="m-address"></span></p>
            <p>建物：<span id="m-building"></span></p>
            <p>カテゴリ：<span id="m-category"></span></p>
            <p>内容：<span id="m-content"></span></p>
        </div>

    </div>
</div>

@endsection