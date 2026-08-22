<h1>Voice Reading</h1>

<p>読み上げたい文章を入力してください。</p>

<textarea name="text" rows="10" cols="50"></textarea>

<button type="button">読み上げる</button>

<form method="POST" action="/logout">
    @csrf

    <button type="submit">ログアウト</button>
</form>