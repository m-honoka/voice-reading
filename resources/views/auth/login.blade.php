<h1>ログイン画面</h1>
<form method="POST" action="/login">
    @csrf

    <div>
        <label>メールアドレス</label>
        <input type="email" name="email">
    </div>

    <div>
        <label>パスワード</label>
        <input type="password" name="password">
    </div>

    <button type="submit">ログイン</button>
</form>