# 概要
データベースに登録した名前を操作するAPIです。

### 環境構築の流れ

1. mysqlとphpが動くサーバーを用意します。

2. phpにpdoクラスというものを使うために、ドライバをインストールしてください。(インストール済みだったら飛ばしてください)

    - ドライバがなかった時用<br>
    [PHP7+MySQL5.7でPDOを使おうとしたら「could not find driver」](https://qiita.com/saoshi/items/86808812838a84eb66ff)

3. 自身の環境でPlayer.sqlのテーブル作成、データ挿入まで行う。

4. Player.phpのPlayerクラスのコンストラクタに書いている$pdo_dsn変数のdbnameのところを自身で作成したデータベースの名前に変更する。

5. 同様に$pdo_userには自身のユーザー名、$pdo_passにはユーザーのパスワードに変更する。

6. client/RestfulEditor.htmlを開き、リストボックスにデータが反映されていると成功。