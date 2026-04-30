@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact">
    <h2 class="contact__title">Contact</h2>

    <form action="/confirm" method="post">
        @csrf

        <table class="contact-table">

            <tr>
                <th>お名前<span class="required">※</span></th>
                <td>
                    <input type="text" name="last_name" placeholder="姓" value="{{ old('last_name') }}">
                    <input type="text" name="first_name" placeholder="名" value="{{ old('first_name') }}">
                    @error('last_name') <p class="error">{{ $message }}</p> @enderror
                    @error('first_name') <p class="error">{{ $message }}</p> @enderror
                </td>
            </tr>

            <tr>
                <th>性別<span class="required">※</span></th>
                <td>
                    <label><input type="radio" name="gender" value="1" {{ old('gender')==1?'checked':'' }}>男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender')==2?'checked':'' }}>女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender')==3?'checked':'' }}>その他</label>
                    @error('gender') <p class="error">{{ $message }}</p> @enderror
                </td>
            </tr>

            <tr>
                <th>メールアドレス<span class="required">※</span></th>
                <td>
                    <input type="email" name="email" value="{{ old('email') }}">
                    @error('email') <p class="error">{{ $message }}</p> @enderror
                </td>
            </tr>

            <tr>
                <th>電話番号<span class="required">※</span></th>
                <td>
                    <input type="text" name="tel1" value="{{ old('tel1') }}" size="5"> -
                    <input type="text" name="tel2" value="{{ old('tel2') }}" size="5"> -
                    <input type="text" name="tel3" value="{{ old('tel3') }}" size="5">

                    @error('tel1') <p class="error">{{ $message }}</p> @enderror
                    @error('tel2') <p class="error">{{ $message }}</p> @enderror
                    @error('tel3') <p class="error">{{ $message }}</p> @enderror
                </td>
            </tr>

            <tr>
                <th>住所<span class="required">※</span></th>
                <td>
                    <input type="text" name="address" value="{{ old('address') }}">
                    @error('address') <p class="error">{{ $message }}</p> @enderror
                </td>
            </tr>

            <tr>
                <th>建物名</th>
                <td>
                    <input type="text" name="building" value="{{ old('building') }}">
                </td>
            </tr>

            <tr>
                <th>お問い合わせの種類<span class="required">※</span></th>
                <td>
                    <select name="category_id">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id?'selected':'' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="error">{{ $message }}</p> @enderror
                </td>
            </tr>

            <tr>
                <th>お問い合わせ内容<span class="required">※</span></th>
                <td>
                    <textarea name="detail">{{ old('detail') }}</textarea>
                    @error('detail') <p class="error">{{ $message }}</p> @enderror
                </td>
            </tr>

        </table>

        <div class="btn-area">
            <button type="submit">確認画面</button>
        </div>

    </form>
</div>
@endsection