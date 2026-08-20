<h1>登録画面</h1>
<form method="POST" action="/register">

    @csrf

    <div>

        <label>名前</label>

        <input type="text" name="name">

    </div>

    <div>

        <label>メールアドレス</label>

        <input type="email" name="email">

    </div>

    <div>

        <label>パスワード</label>

        <input type="password" name="password">

    </div>

    <div>

        <label>パスワード確認</label>

        <input type="password" name="password_confirmation">

    </div>

    <button type="submit">登録</button>

</form>